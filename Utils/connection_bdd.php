<?php

try
			{
   				 // On se connecte à MySQL
    			$bdd = new PDO('mysql:host=localhost;dbname=projet_quiz;charset=utf8', 'root', '',
    			array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
    				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));
			}
			catch(Exception $e)
			{
    			// En cas d'erreur, on affiche un message et on arrête tout
       			die('Erreur : '.$e->getMessage());
			}