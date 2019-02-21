<?php
  session_start();

  require_once('includes/config.php');


  $usrLogin = isset($_POST['email'])?$_POST['email']:'';
  $usrPasword = isset($_POST['password'])?$_POST['password']:'';

    if(isset($_POST['login'])){
      try
      {
      	// préparation de la requete préparée (Prepared Statment)
      	$requete = "SELECT * FROM utilisateur WHERE pseudo=? AND password=?";
      	$stmt = $db->prepare($requete);
      	$stmt->bindParam(1, $usrLogin);
      	$stmt->bindParam(2, md5($usrPasword));   // ATTENTION on bind en convertissant en MD5 ce qui est reçu

      	$stmt->execute();

      	if ($stmt->rowCount() > 0) {
      		// login effectué avec succès ! on a trouvé un utilisateur correspondant
      		// mise en session
      		$curUsr = $stmt->fetch(PDO::FETCH_OBJ);
      		$_SESSION['usr_id'] = $curUsr->id_utilisateur;
      		$_SESSION['usr_nom_prenom'] = $curUsr->nom_utilisateur . ' ' . $curUsr->prenom_utilisateur;
      		$_SESSION['usr_level'] = $curUsr->level_utilisateur;

      		header('location:etudiant_liste.php');
      	}
      	else
      	{
      		// erreur de login, pas trouvé d'utilisateur...on repart sur le login...
      		header('location:login.php?msg=1');
      	}
      }
      catch(PDOException $e)
      {
      	die('Une erreur est survenue ! ' . $e->getMessage());
      }
    }

    if(isset($_POST['signIn'])){
      try
      {
      	// préparation de la requete préparée (Prepared Statment)
      	$requete = "INSERT INTO 'compte' (`email`, `pseudo`, `password`) VALUES ($_POST['email'], $_POST['pseudo'], $_POST['password']);";
      	$stmt = $db->prepare($requete);
      	$stmt->bindParam(1, $usrLogin);
      	$stmt->bindParam(2, md5($usrPasword));   // ATTENTION on bind en convertissant en MD5 ce qui est reçu

      	$stmt->execute();

      	if ($stmt->rowCount() > 0) {
      		// login effectué avec succès ! on a trouvé un utilisateur correspondant
      		// mise en session
      		$curUsr = $stmt->fetch(PDO::FETCH_OBJ);
      		$_SESSION['usr_id'] = $curUsr->id_utilisateur;
      		$_SESSION['usr_nom_prenom'] = $curUsr->nom_utilisateur . ' ' . $curUsr->prenom_utilisateur;
      		$_SESSION['usr_level'] = $curUsr->level_utilisateur;

      		header('location:etudiant_liste.php');
      	}
      	else
      	{
      		// erreur de login, pas trouvé d'utilisateur...on repart sur le login...
      		header('location:login.php?msg=1');
      	}
      }
      catch(PDOException $e)
      {
      	die('Une erreur est survenue ! ' . $e->getMessage());
      }
    }
?>
