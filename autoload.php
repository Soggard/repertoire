<?php

/*function inclusionAutomatique($nomDeLaClasse) {
    include_once($nomDeLaClasse.".class.php");
}*/

class Autoload {
    public static function className($className) {
        require __DIR__. '/' .str_replace('\\', '/', $className . '.php');
    }

}

spl_autoload_register(array('Autoload', 'className'));