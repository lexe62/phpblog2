﻿ <?php
 
/****************************************************/
/* fichier : bas.inc.php							*/
/* chemin : maquette/includes/bas.inc.php  			*/
/* auteur : Sinnaeve Alexis       					*/
/****************************************************/
 
 // connexion qui permet a l'utilisateur d'avoir un sid unique pour sécuriser la connexion
$connecte = false;
if (isset($_COOKIE['sid']))
{
	$sql="SELECT * FROM utilisateurs WHERE  sid='".$_COOKIE['sid']."'"; // on stock le sid dans le cookie
	$resultat = mysql_query($sql);
	$util = mysql_fetch_array($resultat);
	
	if(mysql_num_rows($resultat))
	{
		$connecte = true; // connexion reussit
	}
}
?>

 </div>
          <nav class="span4">
		  <?php // if (isset($connecte)) echo "<h4> L'adresse '".$util['email']."' est connectée.</h4>"; ?>
            <h2>Menu</h2>
			
			<form action="index.php" method="get">
				<label for="rech">Recherche : </label>
				<input type="text" name ="r" id="rech" placeholder = "Roux, dragon, bébéte" class="span3" <?php if($rech) echo "value=".$rech; ?>>&nbsp;
				<input type="submit" value="OK" class="btn btn-primary">
			</form>
			
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="article.php">Rédiger un article</a></li>
                <li><a href="connexion.php">Connexion</a></li>
            </ul>
			
			
            
          </nav>
        </div>
        
      </div>

      <footer>
        <p>&copy; Nilsine & ULCO 2012</p>

      </footer>

    </div>
	<script type="text/javascript">
		$(function(){
			function cacherNotif(){
				$('.alert').slideUp('slow');
			};
			setTimeout(cacherNotif,10000);
			$(".cacher-notif").click(function(){
				cacherNotif();	
			});
		});	
		
	</script>
  </body>
</html>