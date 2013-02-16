<?php
spl_autoload_register(function($className) {
    if (strpos($className, 'Example') !== 0) {
        return;
    }
    $className = ltrim($className, '\\');
    $classPath = '';
    $lastNamespacePos = strrpos($className, '\\');
    if ($lastNamespacePos !== false) {
        $namespace = substr($className, 0, $lastNamespacePos);
        $className = substr($className, $lastNamespacePos + 1);
        $classPath = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $classPath .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
    require $classPath;
});
