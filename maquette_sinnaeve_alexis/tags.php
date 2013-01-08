Les tags

Code dans article.php


<?php
		if(isset($_POST['tags'])&&$_POST['tags']!="")
		{
			$tags=$_POST['tags'];
		}
		else
		{
			$tags="";
		}
		
		$id=var_post('id');
		
		if($id) // si id existe
		{
			if (mysql_query("UPDATE articles SET titre='$titre', texte='$texte', publie='$publie' WHERE id=$id")) //requête pour modifier un article avec un tag
			{
				if($tags!="") //Si l'article contient un tag
				{
					if(isset($_GET['tags']))
					{
						requete_notif("UPDATE tags SET tags='$tags' WHERE articles_id='$id'", 'articles', 'modifié'); //requête permettant la modification de l'article
						header("location: index.php");
					}
					else 
					{
						requete_notif("INSERT INTO tags(tags,articles_id) VALUES ('$tags','$id')", 'articles', 'modifié'); //requête permettant l'ajout de l'article
						header("location: index.php");
					}
				}
				else
				{
					requete_notif("DELETE FROM tags WHERE articles_id=$id", 'articles', 'modifié');
					header("location: index.php");	
				}
			}
		}
		else
		{
			requete_notif("INSERT INTO articles (titre, texte, date, publie) VALUES('$titre','$texte',UNIX_TIMESTAMP(),'$publie')", 'articles', 'ajouté'); //requête permettant de créer un article
			$id_art = mysql_insert_id(); // récupère l'id de l'article que l'on a créé
			requete_notif ("INSERT INTO tags (tags, articles_id) VALUES ('$tags', '$id_art')", 'articles', 'ajouté'); //requête associant le tags au nouvel article				header("location: index.php");
			header("location: index.php");	
		}
	}
	else
	{
		$id=var_get('id');
		//dans le cas où on modifie
		if($id)
		{
			$selectAll="SELECT * FROM articles WHERE id='$id'";   // requête selectionnant tous les articles
			$result=mysql_query($selectAll);					// on effectue la requête
			$data=mysql_fetch_row($result);						// résultat de la requête
			extract($data);										// fonction permettant de vérifier si le nom de la variable est valide
		}
	}
	?>
	
	
	Code dans article.phtml
	<div class="clearfix">
				<label for="tags">Tags</label>
				<div class="input"><input type="text" name="tags" id="tags" value="<?php if(isset($tags))echo $tags;?>"></div> <!-- affichage des tags -->
			</div>
			
			
	
	Code dans index.php
	<?php
	if($recherche)
	{
		$rech=mysql_query("SELECT * FROM articles 
		INNER JOIN tags ON articles.id=tags.articles_id 
		WHERE titre LIKE '%$recherche%' WHERE publie = 1 ORDER BY date DESC LIMIT $index, $app"); //requête qui sélectionnel les articles correspondant à la requête
	}
	else
	{
		$rech=mysql_query("SELECT * FROM articles 
		INNER JOIN tags ON articles.id=tags.articles_id
		WHERE publie=1 ORDER BY date DESC LIMIT $index, $app"); // requête qui sélectionne tous les articles
	}
	?>