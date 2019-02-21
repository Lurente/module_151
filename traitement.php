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
      echo "signIn";
      // préparation de la requete préparée (Prepared Statment)
      $stmt = $db->query("SELECT email FROM compte WHERE email = '$email'");
      $stmt2 = $db->query("SELECT pseudo FROM compte WHERE pseudo = '$pseudo'");
      //$stmt = $db->query("SELECT password FROM compte WHERE password = '$encryptedpassword'");

      $result = $stmt->fetch(PDO::FETCH_OBJ);
      $result2 = $stmt2->fetch(PDO::FETCH_OBJ);

      if ($result->email != $email AND $result2->pseudo != $pseudo)
      {
        $requete = $db->prepare("INSERT INTO compte (email, pseudo, password) VALUES (:email, :pseudo, :password)" );

          $requete->bindParam(":email", $email);
          $requete->bindParam(":pseudo", $pseudo);
          $requete->bindParam(":password", $encryptedpassword);

          $requete->execute();

          header('location:index.php');
      }
      elseif ($result->email = $email)
      {
        echo "email taken";
        //header('location:index.php?error="emailtaken"');
      }
      elseif ($result2->pseudo = $pseudo)
      {
        //header('location:index.php?error="pseudotaken"');
        echo "pseudo taken";
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
        echo "queue";
    	}
    }
    catch(PDOException $e)
    {
      echo "stringficelle";
    	die('Une erreur est survenue ! ' . $e->getMessage());
    }
  }
?>
