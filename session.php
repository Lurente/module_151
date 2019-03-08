<?php
session_start();
    /*
    Page name : index.php
    Description : main page of the website
    Author : Luca Prudente
    */

      require_once('includes/config.php');

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Doodle War - SESSION</title>
      <meta name="description" content="Description de la page" />
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="assets/scss/main.css">
      <link href="https://fonts.googleapis.com/css?family=Cabin+Sketch" rel="stylesheet">
    </head>
    <body>
      <div class="page-session">
        <!--gameBackground-->
          <div class="gameBackground">
            <!--textAccueil-->
              <div class="textAccueil">
                  <?php
                  $usrname = isset($_SESSION['pseudo'])?$_SESSION['pseudo']:'';
                  echo "<parameter id='pseudo' value=" . $usrname .">";
                  echo "Bienvenue dans votre session $usrname";
                  ?>
              </div>
            <!--/textAccueil-->
            <!--chat-->
              <div class="chat">
                </form>
                <h1>Chat</h1>
                <div class="container">
                  <div  class="chatOutput">
                    <div class="row">
                      <div class="col-md-4">
                        <div id="messages">
                          <?php
                            $allMsg = $db->query("SELECT message, pseudo FROM chat INNER JOIN compte ON chat.id_compte = compte.id_compte ORDER BY id_chat ASC");
                              while ($msg = $allMsg->fetch()) {
                                echo "<b>".$msg['pseudo'] . " : </b>";
                                echo $msg['message'];
                                echo "<br><br>";
                              }
                              if(isset($_POST['refreshChat'])){
                                try{
                                  $requete = "SELECT * FROM chat ORDER BY id_chat ASC";
                                  $refreshChat = $db->query($requete);

                                  $_SESSION['allMsg'] = $refreshChat;

                                }
                                catch(PDOException $e){
                                  die('Une erreur est survenue ! ' . $e->getMessage());
                                  echo "string";
                                }
                              }
                          ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="chatInput">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="col-md-2">
                          <p>chat</p>
                        </div>
                        <div class="col-md-8">
                          <form id="sendChat" action="traitement.php" method="post">
                            <input type="text" id="chat" name="chat" value="">
                          </form>
                        </div>
                        <div class="col-md-2">
                          <input type="button" name="sendChat" id="envoi" value="chat">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <!--/chat-->
          </div>
        <!--/gameBackground-->
      </div>
      <script type="text/javascript">

        $('#envoi').click(function(){

            var formCheck = true;

            var message = $('#chat').val();

            if (document.getElementById('chat').value == '') {
      				formCheck = false;
      			}

            if (formCheck) {
              $.ajax({
                  url : "traitement.php", // on donne l'URL du fichier de traitement
                  type : "POST", // la requête est de type POST
                  data : {message:message} // et on envoie nos données
              });
            }
        });

        chatRefresh(20000);

        function chatRefresh(refreshTime) {
          $.ajax({
            url: 'session.php',
            type: 'POST',
            success : function( html ) {
              $('#messages').prepend( html ); // data came back ok, so display it
              }
          });
        }

      </script>
    </body>
</html>
