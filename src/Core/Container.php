<?php

namespace App\Core;

use ReflectionClass;
use ReflectionException;
use ReflectionNamedType;

class Container
{
    private static ?Container $instance = null;
    
    /**
     * @var array<string, mixed>
     */
    private array $bindings = [];

    /**
     * @var array<string, mixed>
     */
    private array $instances = [];

    /**
     * Get the globally available instance of the container (Singleton).
     */
    public static function getInstance(): Container
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Bind a class or interface to a resolver.
     * 
     * @param string $abstract
     * @param mixed $concrete
     * @param bool $shared
     */
    public function bind(string $abstract, $concrete = null, bool $shared = false): void
    {
        if ($concrete === null) {
            $concrete = $abstract;
        }

        $this->bindings[$abstract] = [
            'concrete' => $concrete,
            'shared' => $shared
        ];
    }

    /**
     * Bind a shared instance (singleton) to the container.
     */
    public function singleton(string $abstract, $concrete = null): void
    {
        $this->bind($abstract, $concrete, true);
    }

    /**
     * Resolve the given type from the container.
     * 
     * @param string $abstract
     * @return mixed
     * @throws \Exception
     */
    public function resolve(string $abstract)
    {
        // 1. Return existing shared instance if available
        if (isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }

        // 2. Get the concrete implementation or fallback to abstract
        $binding = $this->bindings[$abstract] ?? [
            'concrete' => $abstract, 
            'shared' => false
        ];
        
        $concrete = $binding['concrete'];
        $isShared = $binding['shared'];

        // 3. Build the object
        if ($concrete instanceof \Closure) {
            $object = $concrete($this);
        } else {
            $object = $this->build($concrete);
        }

        // 4. Store if shared
        if ($isShared) {
            $this->instances[$abstract] = $object;
        }

        return $object;
    }

    /**
     * Build an instance of the given class using Reflection.
     */
    private function build(string $className)
    {
        if (!class_exists($className)) {
             throw new \Exception("Target class [$className] does not exist.");
        }

        $reflector = new ReflectionClass($className);

        if (!$reflector->isInstantiable()) {
            throw new \Exception("Class [$className] is not instantiable.");
        }

        $constructor = $reflector->getConstructor();

        // If no constructor, just instantiate
        if (is_null($constructor)) {
            return new $className;
        }

        $parameters = $constructor->getParameters();
        $dependencies = $this->getDependencies($parameters);

        return $reflector->newInstanceArgs($dependencies);
    }

    /**
     * Resolve dependencies for the constructor.
     */
    private function getDependencies(array $parameters): array
    {
        $dependencies = [];

        foreach ($parameters as $parameter) {
            $type = $parameter->getType();

            if ($type === null) {
                // No type hint? Check default value
                if ($parameter->isDefaultValueAvailable()) {
                    $dependencies[] = $parameter->getDefaultValue();
                } else {
                    throw new \Exception("Cannot resolve class dependency {$parameter->name}");
                }
                continue;
            }

            if (!$type instanceof ReflectionNamedType || $type->isBuiltin()) {
                // Built-in type (string, int, array)? Check default value
                if ($parameter->isDefaultValueAvailable()) {
                    $dependencies[] = $parameter->getDefaultValue();
                } else {
                    throw new \Exception("Cannot resolve built-in dependency {$parameter->name}");
                }
                continue;
            }

            // It's a class/interface type, resolve it recursively
            $dependencies[] = $this->resolve($type->getName());
        }

        return $dependencies;
    }
}
