<?php

require_once "src/db/connection.php";
require_once "src/entities/user.php";
require_once "src/logger/logger.php";

class UserRepository {

    public static $instance;
    // private $logger;

    public static function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new UserRepository();

        // self::$instance->logger = new LoggerManeiro();

        return self::$instance;
    }

    public function store(User $user) {
        try {
            $sql = "INSERT INTO users (
                name,
                email,
                password)
                VALUES (
                :name,
                :email,
                :password)";

            $p_sql = Connection::getInstance()->prepare($sql);

            $p_sql->bindValue(":name", $user->getName());
            $p_sql->bindValue(":email", $user->getEmail());
            $p_sql->bindValue(":password", $user->getPassword());


            return $p_sql->execute();
        } catch (Exception $e) {
            echo $e;
            // self::$instance->logger->error("Erro: Código: " . $e->getCode() . " Mensagem: " . $e->getMessage());
        }
    }

    public function findByEmail($email) {
        try {
            $sql = "SELECT * FROM users WHERE email = :email";
            $p_sql = Connection::getInstance()->prepare($sql);
            $p_sql->bindValue(":email", $email);
            $p_sql->execute();
            return $p_sql->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo $e->getMessage();

            // self::$instance->logger->error("Erro: Código: " . $e->getCode() . " Mensagem: " . $e->getMessage());
        }
    }

}

?>