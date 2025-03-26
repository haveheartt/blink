<?php

namespace App\Entities;

class User {
    private $id;
    private $name;
    private $email;
    private $password;

    public function __construct(array $data) {
        $this->id = $data['id'] ?? 0;
        $this->name = $data['user'];
        $this->email = $data['content'];
        $this->password = $data['timestamp'] ?? date('Y-m-d H:i:s');
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = strtolower($email);
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = strtolower($password);
    }


}

?>