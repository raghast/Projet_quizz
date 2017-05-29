<?php

session_start();

// Fonction qui ajoute un message au flashbag
function addFlash($message) 
{ 
    $_SESSION['flashbag'] = $message;
}

// Fonction qui renvois le message ajouté
function getFlash() 
{
	return ($_SESSION['flashbag']);
}

// Fonction qui affiche le message si la variable $_SESSION['flashbag'] n'est pas vide et qui la vide ensuite
function verifFlash()
{
	if(!empty($_SESSION['flashbag']))
	{
		echo getFlash();
		unset($_SESSION['flashbag']);
	}
}
