<?php

namespace CT275\Labs;

use PDO;

class Contact
{
    private ?PDO $db;

    private int $id = -1;
    public $name;
    public $phone;
    public $notes;
    public $created_at;
    public $updated_at;
    private array $errors = [];

    public function getId(): int
    {
        return $this->id;
    }

    public function __construct(?PDO $pdo)
    {
        $this->db = $pdo;
    }

    public function fill(array $data): Contact
    {
        $this->name = $data['name'] ?? '';
        $this->phone = $data['phone'] ?? '';
        $this->notes = $data['notes'] ?? '';
        return $this;
    }


    public function getValidationErrors(): array
    {
        return $this->errors;
    }

    public function validate(): bool
    {
        $name = trim($this->name);
        if (!$name) {
            $this->errors['name'] = 'Invalid name.';
        }

        $phone = preg_replace('/[^0-9]+/', '', $this->phone);
        if (
            strlen($phone) != strlen($this->phone) ||
            strlen($phone) < 10 ||
            strlen($phone) > 11
        ) {
            $this->errors['phone'] = 'Invalid phone number.';
        }

        $notes = trim($this->notes);
        if (strlen($notes) > 255) {
            $this->errors['notes'] = 'Notes must be at most 255 characters.';
        }

        return empty($this->errors);
    }
}
