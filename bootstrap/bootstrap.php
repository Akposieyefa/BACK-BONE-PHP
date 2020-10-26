<?php
    /***
     * This is the root autoload file
     */
    spl_autoload_register(function ($classname) {

        $classPath  = ROOT_PATH . "/App/Classes/". $classname . ".class.php";
        $authPath  = ROOT_PATH . "/App/Classes/Auth/". $classname . ".class.php";
        $modelPath  = ROOT_PATH . "/App/Model/". $classname . ".model.php";
        $configPath = ROOT_PATH . "/App/Config/". $classname . ".config.php";

        if (file_exists($classPath)) {
            include_once("$classPath");
        } else if (file_exists($modelPath)) {
            include_once("$modelPath");
        } else if (file_exists($configPath)) {
            include_once("$configPath");
        } else if (file_exists($authPath)) {
            include_once("$authPath");
        } else {
            return  false;
        }

    });

