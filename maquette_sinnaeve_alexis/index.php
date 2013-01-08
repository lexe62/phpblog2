<?php
/************************************/
/* fichier : index.php				*/
/* chemin : maquette/index.php 		*/
/* auteur : Sinnaeve Alexis       	*/
/************************************/

include('includes/fonctions.inc.php');// inclusion des fonctions php crée
include('includes/connexion.inc.php');// on inclut le fichier de connexion à la base de données
require("smarty/smarty.class.php"); // On inclut la classe Smarty

$smarty = new Smarty();

	$app=3;//nombre d'articles par page
	$page=(int)var_get('p');
	if(!$page) $page=1; //si var_get de p existe, on le met dans la variable $page sinon on met 1
	$debut=($page-1)*$app;// nombre de pages par rapport au nombre d'articles
	$rech=mysql_real_escape_string(var_get('r'));//variable pour la recherche

	
	
	$where=isset($rech)?"WHERE texte LIKE '%$rech%'":''; //condition si recherche
	$sql=("SELECT COUNT(*) AS total FROM articles $where");//cas d'une recherche d'article
	$result = mysql_query($sql);
	$data = mysql_fetch_array($result); // retourne les lignes SQL correspondant à la requête de la variable $rech
	$total=$data['total'];// retourne le nombre d'article
	$nbpages=ceil($total/$app); // retourne le nombre de page

	
	$sql="SELECT * FROM articles $where ORDER BY date DESC LIMIT $debut,$app";
	$result = mysql_query($sql);

	//titre h2
	$h2=($rech)?'Résultats de la recherche "'.$rech.'"':'Derniers articles';

$articles=array();
	while($data = mysql_fetch_array($result))
	{ //boucle pour la liste d'articles 
		$articles[]=$data;
	}

	$rech=urlencode($rech);
	$rech=htmlspecialchars($rech);
	$pager=($rech)?'&r='.$rech.'':'';
	
	
//	Tous les assign
$smarty->assign("articles",$articles);//articles
$smarty->assign("h2",$h2);//titre
$smarty->assign("page",$page);//page
$smarty->assign("pager",$pager);//pager
$smarty->assign("nbpages",$nbpages);//nbpages
//$smarty->assign("i",$i);//i


include('includes/haut.inc.php'); 
$smarty->display("templates/index.phtml"); //affiche la vue index.phtml
include('includes/bas.inc.php');

?>