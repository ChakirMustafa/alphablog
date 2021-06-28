<?php
session_start();
require __DIR__.'/../helpers/functions.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

function loadClass($className){
	
    $filename1 = str_replace(['App','Controllers','Models','DB\\'],
       ['app','controllers','models','db\\'], $className
    ).'.php';
 
    $filename2 =  str_replace('app\\','', $filename1);

    $filename3 = "core/$className.php";

     if(file_exists($filename1)){
        require $filename1;
     } elseif (file_exists($filename2)){
        require $filename2;
     }else {
        require $filename3;
     }
}
spl_autoload_register('loadClass');