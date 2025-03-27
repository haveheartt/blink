<?php

namespace Utils;

class Password {
    private static Bcrypt $bcrypt = new Bcrypt(15);

    public static function compare($password, $accountPassword) {
        return $this->bcrypt->verify($password, $accountPassword);
    }

    public static function hashPassword($password) {
        return $this->bcrypt->hash($password);
    }

}