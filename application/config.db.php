<?php
return array(
    'host' => 'localhost',
    'user' => 'mysql',
    'password' => 'mysql',
    'dbname' => 'frameon',
    'dbprefix' => 'fron_', // префикс для всех таблиц фреймворка
	'charset' => 'utf8',
	'errmode'   => 'exception', //or 'error'
	'exception' => 'Exception', //Exception class name
	'parts_table' => "#__parts"
);