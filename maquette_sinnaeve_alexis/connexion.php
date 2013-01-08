<?php 
/************************************/
/* fichier : connexion.php			*/
/* chemin : maquette/connexion.php 	*/
/* auteur : Sinnaeve Alexis       	*/
/************************************/

	include('includes/connexion.inc.php'); // on inclut le fichier de connexion à la base de données
	include('includes/haut.inc.php'); // on inclut le fichier contenant la structure supérieure du site
	include('includes/fonctions.inc.php'); // inclusion des fonctions php crée
	
	$rech=mysql_real_escape_string(var_get('r'));

	If (isset($_POST['post']))//vérification des valeurs entrées
	{
		$email=mysql_real_escape_string(var_post('email'));// on protege les caracteres speciaux du champ email
		$mdp=mysql_real_escape_string(var_post('mdp'));// on protege les caracteres speciaux du champ mdp
		
		If (!$email || !$mdp) echo "<div class='alert alert-error'>Veuillez saisir tous les champs.</div>"; //données non remplies ?
		
		else
		{
				$sql="SELECT * FROM utilisateurs WHERE email='$email' AND mdp='$mdp'";
				$res = mysql_query($sql);
				$data=mysql_fetch_array($res);
				
				if (/*mysql_num_rows($res==1)*/$data == true)
					{//si bon
						$sid=md5($email.time());
						requete_notif("UPDATE utilisateurs SET sid='$sid' WHERE id='".$data['id']."'",'utilisateur','connecté'); //fonction qui modifie et teste
						setcookie('sid',$sid,time()+15*60); //crée le cookie
						
			
						header('Location:index.php'); 
						exit();
					}
				else {
					//notification 
					requete_notif("SELECT * FROM utilisateurs WHERE email=$email AND mdp=$mdp",'utilisateur','invalide');
					header('Location:connexion.php'); 
					exit();
					}
		}
	
	}
	
?>

<h2>Connexion</h2>

<p> Saisissez les identifiants choisis lors de votre inscription.</p>

<form action="connexion.php" method="post" id="form_connexion">
	<fieldset>
	
		<div class="clearfix"> <!-- Plusieurs div pour les espacements -->
			<label  for="email">Email</label><!-- le label pour email -->
			<div class="input"><input type="email" id="email" size="30" name="email" value="" placeholder="Email"/></div>
		</div>
		
		<div class="clearfix">
			<label  for="mdp">Mot de passe</label> <!-- le label pour le mot de passe -->
			<div class="input"><input type="password" size="15" name="mdp" id="mdp" placeholder="Mot de passe"/></div>
		</div>
		
    	<div class="form-actions"> 
			<input type="hidden" name='post' value=""> <!-- Permet de savoir si on se trouve en traitement -->
			<input type="submit" class="btn large primary" id="submit" value="Se connecter"/><!-- bouton pour se connecter -->
		</div>
		
   	</fieldset>
</form>


<!-- script de connexion qui permet de voir si les champs son bien ou remplis ou ne le sont pas-->
<script type="text/javascript">
	$(function()
	{
		$("#form_connexion").submit(function()
		{
			var email=$("#email").val();
			var mdp=$("#mdp").val();
			if(!email || !mdp)
			{
				$("#notif").hide();
				$("#notif > span").html('Veuillez saisir tous les champs.');
				$("#notif").removeClass()
						   .addClass('alert alert-error')
				           .slideDown('slow');
				return false;
			}
			return true;
		})
	});	
</script>


<?php
	include('includes/bas.inc.php');