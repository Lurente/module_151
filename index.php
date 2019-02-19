<?php
    /*
    Page name : index.php
      Description : main page of the website
      Author : Luca Prudente
      */
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Doodle War - HOMEPAGE</title>
      <meta name="description" content="Description de la page" />
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="assets/scss/main.css">
      <link href="https://fonts.googleapis.com/css?family=Cabin+Sketch" rel="stylesheet">
    </head>
    <body>
      <!--mainPage-->
        <div class="page-homepage">
          <!--header-->
            <div class="header">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <img src="images/doodle_war_logo.png" alt="logo Gameology" id="logo" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pageTitle">
                                <h1>DOODLE WAR</h1>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="nav">
                            <nav>
                                <ul>
                                    <li>
                                        <a href="#" id="current" title="GAMEOLOGY homepage">HOME</a>
                                    </li>
                                    <li>
                                        <a href="news.php" title="news and update notes">NEWS</a>
                                    </li>
                                    <li>
                                        <a href="aboutme.php" title="Infos">ABOUT ME</a>
                                    </li>
                                    <li>
                                        <a href="games.php" title="Game list">GAMES</a>
                                    </li>
                                    <li>
                                        <a href="contact.php" title="Contact me !">CONTACT</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
          <!--/header-->
          <!--introduction-->
            <div class="introduction">
                <div class="container">
                    <div class="row">
                        <p>Welcome to <a href="#">DOODLE WAR </a>!</p> <br>
                        <p>Please Login or Sign-in</p>
                        <div class="connexion">
                          <div class="tab" >
                            <button class="onglet" onclick="openTab(event, 'onglet1')" id="default">login</button>
                            <button class="onglet" onclick="openTab(event, 'onglet2')">sign-in</button>
                          </div>
                          <!-- #collumn -->
                            <div id="onglet1" class="content">
                                  <h2>login</h2>
                                  <form class="LoginForm" action="traitemnet.php" method="post">
                                    <label for="email">Adresse mail:</label><br>
                                    <input type="email" name="email" value=""><br>
                                    <label for="password">Mot de passe :</label><br>
                                    <input type="password" name="password" value=""><br>
                                    <input type="button" onclick="checkFieldsLogin()" value="Login">
                                  </form>
                            </div>
                          <!-- /collumn -->

                          <!-- #collumn -->
                            <div id="onglet2" class="content">
                                  <h2>Sign-in</h2>
                                  <form class="Sign-inForm" action="index.html" method="post">
                                    <label for="email">Adresse mail:</label><br>
                                    <input type="email" name="email" value=""><br>
                                    <label for="password">Mot de passe :</label><br>
                                    <input type="password" name="password" value=""><br>
                                    <label for="confirm-password">Confirmez mot de passe :</label><br>
                                    <input type="password" name="confirm-password" value="">
                                    <input type="button" onclick="checkFieldsSingin()" value="Sign-in">
                                  </form>
                            </div>
                          <!-- /collumn -->
                        </div>
                    </div>
                </div>
            </div>
          <!--/introduction-->
          <!--content-->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">

                        </div>
                    </div>
                </div>
            </div>
          <!--/content-->
          <!-- #footer -->
          <div class="footer">
              <div class="container">
                  <div class="row">
                      <!--#collumn-->
                      <div class="col-md-2">
                          <a href="index.html"><img class="logo_footer" src="images/doodle_war_logo.png"></a>
                      </div>
                      <!--/collumn-->

                      <!--#collumn-->
                      <div class="col-md-8">
                        <div class="foot_nav">
                          <ul>
                              <li>
                                  <a href="#" id="current" title="GAMEOLOGY homepage">HOME</a>
                              </li>
                              <li>
                                  <a href="news.php" title="news and update notes">NEWS</a>
                              </li>
                              <li>
                                  <a href="aboutme.php" title="Infos">ABOUT ME</a>
                              </li>
                              <li>
                                  <a href="games.php" title="Game list">GAMES</a>
                              </li>
                              <li>
                                  <a href="contact.php" title="Contact me !">CONTACT</a>
                              </li>
                          </ul>
                        </div>
                      </div>
                      <!--#collumn-->
                      <div class="col-md-2" id="right_logo_footer">
                          <a href="index.html"><img class="logo_footer" src="images/doodle_war_logo.png"></a>
                      </div>
                      <!--/collumn-->

                  </div>
              </div>
          </div>
          <!-- /footer -->
        </div>
      <!--/mainPage-->
      <!--scripts-->
      <script>
    		// fonction javascript qui permet de recevoir un id, mettre à jour le champs du formulaire de suppression
    		// et poster le formulaire de suppression
    		function checkFieldsLogin()
    		{
    			var formCheck = true;

    			if (document.getElementById('email').value == '') {
    				document.getElementById('email').style.backgroundColor = 'red';
    				formCheck = false;
    			}

    			if (document.getElementById('password').value == '') {
    				document.getElementById('password').style.backgroundColor = 'red';
    				formCheck = false;
    			}

    			if (formCheck) {
    				document.getElementById('LoginForm').submit();
    			}
    		}

        function checkFieldsSingin()
    		{
    			var formCheck = true;

    			if (document.getElementById('email').value == '') {
    				document.getElementById('email').style.backgroundColor = 'red';
    				formCheck = false;
    			}

    			if (document.getElementById('password').value == '') {
    				document.getElementById('password').style.backgroundColor = 'red';
    				formCheck = false;
    			}

    			if (document.getElementById('confirm-password').value == '') {
    				document.getElementById('confirm-password').style.backgroundColor = 'red';
    				formCheck = false;
    			}

    			if (formCheck) {
    				document.getElementById('Sign-inForm').submit();
    			}
    		}
    	</script>
        <script>
          function openTab(evt, onglet) {
              var i, content, tab;
              content = document.getElementsByClassName("content");
              for (i = 0; i < content.length; i++) {
                  content[i].style.display = "none";
              }
              tab = document.getElementsByClassName("onglet");
              for (i = 0; i < tab.length; i++) {
                  tab[i].className = tab[i].className.replace(" active", "");
              }
              document.getElementById(onglet).style.display = "block";
              evt.currentTarget.className += " active";
          }
        document.getElementById("default").click();
        </script>
      <!--/scripts-->
    </body>
</html>
