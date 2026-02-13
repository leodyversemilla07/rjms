<?php

namespace App\Core;

class Validator
{
    private array $data;
    private array $errors = [];

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Validate the data against provided rules.
     * 
     * @param array $rules  e.g., ['email' => 'required|email|max:255']
     * @return bool
     */
    public function validate(array $rules): bool
    {
        foreach ($rules as $field => $fieldRules) {
            $value = $this->data[$field] ?? null;
            $rulesArray = explode('|', $fieldRules);

            foreach ($rulesArray as $rule) {
                $params = [];
                if (strpos($rule, ':') !== false) {
                    [$rule, $paramString] = explode(':', $rule, 2);
                    $params = explode(',', $paramString);
                }

                $this->applyRule($field, $value, $rule, $params);
            }
        }

        return empty($this->errors);
    }

    /**
     * Apply a specific rule to a field.
     */
    private function applyRule(string $field, $value, string $rule, array $params): void
    {
        $label = ucfirst(str_replace('_', ' ', $field));

        switch ($rule) {
            case 'required':
                if (empty($value) && $value !== '0' && $value !== 0) {
                    $this->addError($field, "{$label} is required.");
                }
                break;

            case 'email':
                if (!empty($value) && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($field, "{$label} must be a valid email address.");
                }
                break;

            case 'min':
                if (!empty($value) && strlen($value) < $params[0]) {
                    $this->addError($field, "{$label} must be at least {$params[0]} characters.");
                }
                break;

            case 'max':
                if (!empty($value) && strlen($value) > $params[0]) {
                    $this->addError($field, "{$label} must not exceed {$params[0]} characters.");
                }
                break;

            case 'numeric':
                if (!empty($value) && !is_numeric($value)) {
                    $this->addError($field, "{$label} must be numeric.");
                }
                break;

            case 'confirmed':
                $confirmationField = $field . '_confirmation';
                if ($value !== ($this->data[$confirmationField] ?? null)) {
                    $this->addError($field, "{$label} confirmation does not match.");
                }
                break;

            case 'unique':
                if (empty($value)) break;
                
                $table = $params[0];
                $column = $params[1] ?? $field;
                $exceptId = $params[2] ?? null;

                $sql = "SELECT COUNT(*) as count FROM {$table} WHERE {$column} = ?";
                $queryParams = [$value];

                if ($exceptId) {
                    $sql .= " AND id != ?";
                    $queryParams[] = $exceptId;
                }

                $result = Database::fetchOne($sql, $queryParams);
                if ($result['count'] > 0) {
                    $this->addError($field, "{$label} has already been taken.");
                }
                break;

            case 'in':
                if (!empty($value) && !in_array($value, $params)) {
                    $this->addError($field, "The selected {$field} is invalid.");
                }
                break;
        }
    }

    /**
     * Add error message.
     */
    private function addError(string $field, string $message): void
    {
        $this->errors[$field][] = $message;
    }

    /**
     * Get all validation errors.
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Get validated data (only fields present in rules).
     */
    public function validated(array $rules): array
    {
        return array_intersect_key($this->data, $rules);
    }
}
