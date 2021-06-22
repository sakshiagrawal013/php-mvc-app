<?php

namespace App\Models;

use App\Database\Database;

/**
 * Class Model
 * @package App\Models
 */
class Model
{
    public \mysqli $db;

    protected string $table;

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();

        if (isset($this->table)) {
            $this->setTable($this->table);
        }
    }

    /**
     * @return string
     */
    public function getTable(): string
    {
        return $this->table;
    }

    /**
     * @param string $table
     */
    public function setTable(string $table): void
    {
        $this->table = $table;
    }

    /**
     * @param array $data
     * @return int|null
     */
    public function create(array $data): ?int
    {
        $query = "INSERT INTO {$this->table} (email, password) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $data['email'], $data['password']);
        $stmt->execute();
        return $stmt->insert_id;
    }

    /**
     * @param array $data
     * @param int $id
     * @return int
     */
    public function update(array $data, int $id): int
    {
        $query = "UPDATE {$this->table} SET ";

        foreach (array_keys($data) as $i => $field) {
            $query .= ($i) ? ", " : "";
            $query .= "$field = ?";
        }
        $query .= " WHERE id = ?";
        $types = str_repeat('s', count($data));

        $data[] = $id;
        $types .= 'i';

        $stmt = $this->db->prepare($query);

        $stmt->bind_param($types, ...array_values($data));
        $stmt->execute();

        return $stmt->affected_rows;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        if (!$id || empty($this->get($id))) {
            return false;
        }

        $sql = "DELETE FROM {$this->table} WHERE id=?"; // SQL with parameters
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        return true;
    }

    /**
     * @param $id
     * @return object|null
     */
    public function get($id): ?object
    {
        $sql = "SELECT * FROM {$this->table} WHERE id=?"; // SQL with parameters
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_object();
    }

    /**
     * @param array $data
     * @return object|null
     */
    public function fetch(array $data): ?object
    {
        $name = key($data);
        $value = "$data[$name]";

        $sql = "SELECT * FROM {$this->table} WHERE $name LIKE ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $value);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_object();
    }

    /**
     * @return array
     */
    public function all(): array
    {
        $sql = "SELECT * FROM {$this->table}";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = [];
        while ($obj = $result->fetch_object()) {
            $data[] = $obj;
        }
        return $data;
    }

    protected function setAttribute($class, ?object $object): ?Model
    {
        if (is_null($object)) {
            return null;
        }

        $attributes = get_class_vars($class);

        foreach ($attributes as $attribute => $v) {
            if (isset($object->{$attribute})) {
                $this->{$attribute} = $object->{$attribute};
            }
        }

        return $this;
    }
}
