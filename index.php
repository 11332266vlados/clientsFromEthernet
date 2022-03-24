<?php include_once('system/MainController.php');
spl_autoload_register(function ($class) {
    if ($class != 'mysqli') {
        $class = str_replace('\\', '/', $class);
        include $_SERVER['DOCUMENT_ROOT'].'/'.$class.'.php';
    }
});
new \system\MainController();
