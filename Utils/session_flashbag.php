<?php

session_start();

function addFlash($message) 
{ 
    $_SESSION['flashbag'] = $message;
}

// Fonction qui renvois le message 'succés'

function getFlash() 
{
	return ($_SESSION['flashbag']);
    unset($_SESSION['flashbag']);
}

function verifFlash()
{
	if(!empty($_SESSION['flashbag']))
	{
		echo getFlash();
		unset($_SESSION['flashbag']);
	}
}