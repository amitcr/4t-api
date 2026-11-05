<?php
namespace App\Traits;

trait SingletonTrait {
    private static $instance;
    public static function getInstance() {
        if (null === static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;
    }
    private function __clone() {}
    public function __wakeup() {}
}
