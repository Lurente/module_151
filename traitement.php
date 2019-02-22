<?php
  session_start();

  require_once('includes/config.php');

  $email = isset($_POST['email'])?$_POST['email']:'';
  $pseudo = isset($_POST['pseudo'])?$_POST['pseudo']:'';
  $password = isset($_POST['password'])?$_POST['password']:'';
  $encryptedpassword = md5($password);


  echo "<pre>";
  print_r($_POST);
  echo "</pre>";

  if(isset($_POST['signIn'])){
    try
    {
      echo $pseudo;

      // préparation de la requete préparée (Prepared Statment)

      $emailcheck = $db->prepare("SELECT *  FROM compte WHERE email=:email");
      $emailcheck->bindParam(":email", $email);
      $emailcheck->execute();

      $usernamecheck = $db->prepare("SELECT * FROM compte WHERE pseudo=:pseudo");
      $usernamecheck->bindParam(":pseudo", $pseudo);
      $usernamecheck->execute();
      //$stmt = $db->query("SELECT password FROM compte WHERE password = '$encryptedpassword'");

      if ($emailcheck->rowCount() > 0){
        header('location:index.php?error=emailtaken');
      }
      elseif ($usernamecheck->rowCount() > 0){
        header('location:index.php?error=pseudotaken');
      }elseif ($password != $encryptedpassword){
        header('location:index.php?error=passwordNonSimilaire');
      }else{
        $requete = $db->prepare("INSERT INTO compte (email, pseudo, password) VALUES (:email, :pseudo, :password)" );

        $requete->bindParam(":email", $email);
        $requete->bindParam(":pseudo", $pseudo);
        $requete->bindParam(":password", $encryptedpassword);

        $requete->execute();

        header('location:index.php');
      }

    }
    catch(PDOException $e){
      die('Une erreur est survenue ! ' . $e->getMessage());
    }
  }

  if(isset($_POST['login']))
  {
    try
    {
    	// préparation de la requete préparée (Prepared Statment)
    	$requete = "SELECT * FROM utilisateur WHERE (pseudo=? OR email=?) AND password=?";
    	$stmt = $db->prepare($requete);
    	$stmt->bindParam(1, $pseudo);
      $stmt->bindParam(2, $email);
    	$stmt->bindParam(3, $encryptedpassword);   // ATTENTION on bind en convertissant en MD5 ce qui est reçu

    	$stmt->execute();

    	if ($stmt->rowCount() > 0) {
    		// login effectué avec succès ! on a trouvé un utilisateur correspondant
    		// mise en session
    		$curUsr = $stmt->fetch(PDO::FETCH_OBJ);
    		$_SESSION['id_compte'] = $curUsr->id_compte;
    		$_SESSION['email'] = $curUsr->email;
    		$_SESSION['pseudo'] = $curUsr->pseudo;
    		$_SESSION['password'] = $curUsr->password;

        header('location:session.php');
    	}
    	else
    	{
    		// erreur de login, pas trouvé d'utilisateur...on repart sur le login...
    	}
    }
    catch(PDOException $e)
    {
    	die('Une erreur est survenue ! ' . $e->getMessage());
    }
  }
?>
