<?php

class LoggingAction extends Enum {
    const CR_PROD = "Create product";
    const ED_PROD = "Edit product";
    const DEL_PROD = "Delete product";
}

abstract class Enum {
    static function getKeys(){
        $class = new ReflectionClass(get_called_class());
        return array_keys($class->getConstants());
    }
}
