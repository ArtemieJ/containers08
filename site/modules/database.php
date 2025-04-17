<?php
class Database {
    private $db;

    public function __construct($path) {
        $this->db = new PDO("sqlite:$path");
    }

    public function Execute($sql) {
        return $this->db->exec($sql);
    }

    public function Fetch($sql) {
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Create($table, $data) {
        $keys = implode(", ", array_keys($data));
        $values = implode(", ", array_map(function ($v) { return "'$v'"; }, array_values($data)));
        $sql = "INSERT INTO $table ($keys) VALUES ($values)";
        $this->Execute($sql);
        return $this->db->lastInsertId();
    }

    public function Read($table, $id) {
        $sql = "SELECT * FROM $table WHERE id = $id";
        return $this->db->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    public function Update($table, $id, $data) {
        $set = implode(", ", array_map(function ($k, $v) { return "$k = '$v'"; }, array_keys($data), $data));
        $sql = "UPDATE $table SET $set WHERE id = $id";
        return $this->Execute($sql);
    }

    public function Delete($table, $id) {
        $sql = "DELETE FROM $table WHERE id = $id";
        return $this->Execute($sql);
    }

    public function Count($table) {
        $sql = "SELECT COUNT(*) as count FROM $table";
        return $this->db->query($sql)->fetch(PDO::FETCH_ASSOC)['count'];
    }
}
