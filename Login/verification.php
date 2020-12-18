<?php
session_start();
if(isset($_POST['pseudo']) && isset($_POST['mot de passe']))
{

    $db_username = 'root';
    $db_password = '';
    $db_name     = 'la_boutique_tech';
    $db_host     = 'localhost';
    $db = mysqli_connect($db_host, $db_nom_complet, $db_mot_de_passe, $db_pseudo, $db_adresse_mail)
           or die('impossible de se connecter à la bdd');
    
 
    $pseudo = mysqli_real_escape_string($db,htmlspecialchars($_POST['pseudo'])); 
    $mot_de_passe = mysqli_real_escape_string($db,htmlspecialchars($_POST['mot_de_passe']));
    
    if($pseudo !== "" && $mot_de_passe !== "")
    {
        $requete = "SELECT count(*) FROM user where 
              pseudo = '".$pseudo."' and mot_de_passe = '".$mot_de_passe."' ";
        $exec_requete = mysqli_query($db,$requete);
        $reponse      = mysqli_fetch_array($exec_requete);
        $count = $reponse['count(*)'];
        if($count!=0) // nom d'utilisateur et mot de passe correctes
        {
           $_SESSION['pseudo'] = $pseudo;
           header('Location: principale.php');
        }
        else
        {
           header('Location: login.php?erreur=1'); // utilisateur ou mot de passe incorrect
        }
    }
    else
    {
       header('Location: login.php?erreur=2'); // utilisateur ou mot de passe vide
    }
}
else
{
   header('Location: login.php');
}
mysqli_close($db); // fermer la connexion
?>