<?php

function load_lib($base) {
    echo "Base:  " . var_dump($base);
    $baseName = explode( '\\', $base );
    echo "BaseName:  " . var_dump($baseName);
    $class = end( $baseName ); 
    echo "Class:  " . var_dump($class);
    include 'lib/'.$class . '.php';
    //echo var_dump($class);
};
spl_autoload_register('load_lib');