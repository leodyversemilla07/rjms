<?php

namespace App\Core;

class Response
{
    private $content;
    private int $statusCode;
    private array $headers = [];

    public function __construct($content = '', int $statusCode = 200)
    {
        $this->content = $content;
        $this->statusCode = $statusCode;
    }

    /**
     * Set the status code
     */
    public function setStatusCode(int $code): self
    {
        $this->statusCode = $code;
        return $this;
    }

    /**
     * Add a header
     */
    public function header(string $name, string $value): self
    {
        $this->headers[$name] = $value;
        return $this;
    }

    /**
     * Send the response to the browser
     */
    public function send(): void
    {
        // 1. Send status code
        http_response_code($this->statusCode);

        // 2. Send headers
        foreach ($this->headers as $name => $value) {
            header("{$name}: {$value}");
        }

        // 3. Send content
        if ($this->content !== null) {
            if (is_array($this->content) || is_object($this->content)) {
                header('Content-Type: application/json');
                echo json_encode($this->content);
            } else {
                echo $this->content;
            }
        }
    }

    /**
     * Create a JSON response
     */
    public static function json($data, int $statusCode = 200): self
    {
        return new self($data, $statusCode);
    }

    /**
     * Create a redirect response
     */
    public static function redirect(string $url, int $statusCode = 302): self
    {
        $response = new self(null, $statusCode);
        $response->header('Location', $url);
        return $response;
    }
}
