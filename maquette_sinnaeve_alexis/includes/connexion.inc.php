<?php

/****************************************************/
/* fichier : connexion.inc.php						*/
/* chemin : maquette/includes/connexion.inc.php  	*/
/* auteur : Sinnaeve Alexis       					*/
/****************************************************/

mysql_connect('localhost','root','');
mysql_select_db('blog'); // selection de la base de données
mysql_query("SET NAMES 'utf8'"); // fonction permettant l'encodage des données en utf8
SESSION_start();
