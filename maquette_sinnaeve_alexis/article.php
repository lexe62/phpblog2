
<?php
/************************************/
/* fichier : article.php			*/
/* chemin : maquette/article.php  	*/
/* auteur : Sinnaeve Alexis       	*/
/************************************/

	include('includes/connexion.inc.php'); // on inclut le fichier de connexion à la base de données
	include('includes/fonctions.inc.php'); // inclusion des fonctions php crée
	require("smarty/Smarty.class.php"); // On inclut la classe Smarty
	
	$smarty = new Smarty();

	//pour la modification d'un article
	$id =(int)var_get('id');
	$action_label=($id)?'Modifier':'Ajouter';
	$rech=mysql_real_escape_string(var_get('r'));
	 
	$rep=array();
	
		If ($id)
		{
			$resultat = mysql_query("SELECT * FROM articles WHERE id='$id'"); 
			$rep= mysql_fetch_array($resultat);
		}


		If (isset($_POST['post']))
		{
	//vérification des valeurs entrées
		$titre= var_post('titre'); // on utilise la fonction crée
		$texte= var_post('texte');
		
		$date=time();
		$erreur=0;
		
			If (!$titre || !$texte)
			{ //données non remplies ?
			$erreur=1;
			$smarty->assign("erreur",$erreur);
			}
			
			Else 
			{
		//var_dump($_FILES[image]);
		//pour l'ajout
			$titre = mysql_real_escape_string($titre);// on protege les caracteres speciaux du champ titre
			$texte = mysql_real_escape_string($texte);// on protege les caracteres speciaux du champ texte
		
			$id=(int)var_post('id');
			
				If ($id)
					requete_notif("UPDATE articles SET titre='$titre', texte='$texte', date=$date WHERE id='$id' ",'article','modifié'); //fonction qui met à jour la base de données
				else
				{
					requete_notif("INSERT INTO articles (titre, texte, date) VALUES ('$titre','$texte',$date)",'article','ajouté'); //fonction ajoute dans la bdd
			
		
				
			
						//bloc qui permet d'upload une image
						$id = mysql_insert_id();
						
						$nom = $_FILES["image"]["tmp_name"];
						//$dossier = "fichiers/".$_FILES["image"]["name"]."";	
							
						//$_FILES['image']['name'] = $id.".jpg";
						//$fichier = basename($_FILES['image']['name']);
						$fichier = "fichiers/".$id.".jpg";	
						move_uploaded_file($nom,$fichier);
		
						//redirection
						header('Location:index.php'); 
						exit();

					
				}
			}
		}



//tous les assign utile pour que smarty fonctionne
$smarty->assign("action_label",$action_label);
$smarty->assign("rep",$rep);
$smarty->assign("id",$id);






include('includes/haut.inc.php'); // on inclut le fichier contenant la structure supérieure du site
$smarty->display("templates/article.phtml"); //affiche la vue article.phtml
include('includes/bas.inc.php');// on inclut le fichier contenant la structure inférieur du site