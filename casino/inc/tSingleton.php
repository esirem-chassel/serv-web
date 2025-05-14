<?php
    trait tSingleton {
        protected static $instance = null;
        public static function getInstance() {
            if(null === static::$instance) {
                $cls = get_called_class();
                static::$instance = new $cls();
            }
            return static::$instance;
        }
        protected function __construct(){}
    }
