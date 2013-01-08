<?php

/****************************************************/
/* fichier : fonction.inc.php						*/
/* chemin : maquette/includes/fonction.inc.php  	*/
/* auteur : Sinnaeve Alexis       					*/
/****************************************************/

// fonction permettant l'obtention de données via la méthode post
function var_post($champ) {
	return (isset($_POST[$champ]))? $_POST[$champ]:false; //retourne la valeur du champ s'il existe, si non : false
}

// fonction permettant l'obtention de données via la méthode get
function var_get($champ) {
	return (isset($_GET[$champ]))? $_GET[$champ]:false;//retourne la valeur du champ s'il existe, si non : false
}

//fonction permettant de gérer les notifications :
function requete_notif($sql,$var,$val){
//possibilité de la faire en ternaire
	if (mysql_query($sql)) $_SESSION[$var]=$val;
	else $_SESSION[$var]='erreur';
}