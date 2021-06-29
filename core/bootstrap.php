<?php
session_start();
require __DIR__.'/../helpers/functions.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

function loadClass($className){
	$dir = realpath(dirname(__DIR__));
    $filename1 = str_replace(['App','Controllers','Models','DB\\'],
       ['app','controllers','models','db\\'], $className
    ).'.php';
    $filename1 = str_replace('\\', DIRECTORY_SEPARATOR, $filename1);
     #die($dir.DIRECTORY_SEPARATOR.$filename1);
    $filename2 = str_replace('app','', $filename1);
    #die($dir.DIRECTORY_SEPARATOR.$filename2);
    $filename3 = $dir.DIRECTORY_SEPARATOR.'core'.DIRECTORY_SEPARATOR.$filename2;

    #die($filename3);
    $filename2 = $dir.DIRECTORY_SEPARATOR.$filename2;

    $filename1 = $dir.DIRECTORY_SEPARATOR.$filename1;
    #var_dump($filename1, $filename2, $filename3);

     if(file_exists($filename1)){
        require $filename1;
     } elseif (file_exists($filename2)){
        require $filename2;
     }elseif(file_exists($filename3))  {
        require $filename3;
     }
}
spl_autoload_register('loadClass');