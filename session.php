<?php
session_start()
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
        <?php
        $usrname = isset($_SESSION['pseudo'])?$_SESSION['pseudo']:'';
        echo "Bienvenue dans votre session $usrname";
        ?>
        <!--chat-->
        <div class="chat">
          <div class="container">
            <div class="row">
              <div class="col-md-8">
              </div>
              <div class="col-md-4">
                <div class="col-md-2">
                  <p>chat</p>
                </div>
                <div class="col-md-8">
                  <form id="sendChat" action="traitement.php" method="post">
                    <input type="text" id="chat"name="chat" value="">
                    <input type="name" name="sendChat" value="1" hidden>
                  </form>
                </div>
                <div class="col-md-2">
                  <input type="button" onclick="checkChatField()" value="chat">
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--/chat-->
      </div>
      <script type="text/javascript">
        function checkChatField() {
          var formCheck = true;

          if (document.getElementById('chat').value == '') {
    				formCheck = false;
    			}
        
          if (formCheck) {
            document.getElementById('sendChat').submit();
          }
        }
      </script>
    </body>
</html>
