<?php

/********************************************************/
/* fichier : notifitions.inc.php						*/
/* chemin : maquette/includes/notifications.inc.php  	*/
/* auteur : Sinnaeve Alexis       						*/
/********************************************************/


//notifications pour l'article appelées dans le haut.inc
$croix ='<a class="cacher-notif" href="#null">X</a>';

if(isset($_SESSION['article']))
{
	switch ($_SESSION['article'])
	{
		case 'ajouté':
			echo ("<div class='alert alert-success' id='notif'><span>L'article a été ajouté. </span>".$croix."</div>"); // cas de l'ajout d'un article
			break;
		case 'modifié':
			echo ("<div class='alert alert-success' id='notif'><span>L'article a été modifié. </span>".$croix."</div>"); // cas de la modification d'un article
			break;
		case 'supprimé':
			echo ("<div class='alert alert-success' id='notif'><span>L'article a été supprimé. </span>".$croix."</div>"); // cas de la suppression d'un article
			break;
		case 'erreur':
			echo ("<div class='alert alert-error' id='notif'><span>Il y a une erreur. </span>".$croix."</div>"); // cas ou il y a une erreur
			break;
	}
	unset($_SESSION['article']);
}
else if (isset($_SESSION['utilisateur']))
{
	switch ($_SESSION['utilisateur'])
	{
		case 'connecté':
			echo ("<div class='alert alert-success' id='notif'><span>Vous êtes bien connecté. </span>".$croix."</div>"); // cas ou la connexion est reussit
			break;
		case 'déconnecté':
			echo ("<div class='alert alert-success' id='notif'><span>Vous êtes bien déconnecté. </span>".$croix."</div>"); // cas pour une deconnexion
			break;
		case 'invalide':
			echo ("<div class='alert alert-error' id='notif'><span>Vos identifiants sont invalides. </span>".$croix."</div>"); // cas ou l'identifiant est incorrect
			break;
		case 'erreur':
			echo ("<div class='alert alert-error' id='notif'><span>Il y a une erreur. </span>".$croix."</div>"); // cas d'une erreur
			break;
			
	}
	
unset($_SESSION['utilisateur']);
}
else
{
	echo ("<div class='alert hide' id='notif'><span></span>".$croix."</div>");
}