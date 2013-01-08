<?php

/********************************************/
/* fichier : supprimer_article.php			*/
/* chemin : maquette/supprimer_article.php 	*/
/* auteur : Sinnaeve Alexis       			*/
/********************************************/

include('includes/connexion.inc.php');// on inclut le fichier permettant la connexion à la base de données
include('includes/fonctions.inc.php');// on inclut le fichier contenant les différentes fonctions php 

$id =(int)var_get('id');

//si id existe
if($id) requete_notif("DELETE FROM articles WHERE id='$id'",'article','supprimé');//requête permettant de supprimer tous les champs de la la base de données

header('Location:index.php');//redirection vers la page d'accueil (index.php)