<?php 
//Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=gestion','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

// var_dump($pdo);
// creation de la session permet de stocker des informations sur les'internautes
session_start();

//POUR wampp
//definition de constante 
define('RACINE_SITE',$_SERVER['DOCUMENT_ROOT'].'/');
define('URL','/');

//POUR xampp
//definition de constante 
// define('RACINE_SITE',$_SERVER['DOCUMENT_ROOT'].'/php/firstProjectPhp/');
// define('URL','http://localhost/php/firstProjectPhp/');

$content = '';
?>