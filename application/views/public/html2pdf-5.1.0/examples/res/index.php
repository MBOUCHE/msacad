<?php

function chargerClasse ($classe)
{
require $classe .'.class.php'; 
// On inclue la classe correspondante au paramètre passé
}
spl_autoload_register ('chargerClasse'); 
// On enregistre la
//fonction en autoload pour qu'elle soit appelée dès qu'on instanciera

session_start(); // On appelle session_start() APRÈS avoir enregistré l'autoload
echo '<p> session_start ... OK</p>';

//s'il clique sur deconnection...
       try {
         $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
         $bd=new PDO('mysql:host=localhost; dbname=test2', 'root','',  $pdo_options );
         
       } catch (\Exception $e) {
         die ('ERREUR!! : '. $e->getMessage());
       }

  $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  //On émet une alerte à chaque fois qu'une requête a échouer...


  $manager = new Manager($bd);

  if(!$_SESSION)
  {

    if (isset($_POST['pseudo']) && isset($_POST['mdp']))
    {
      $id = $manager->exists($_POST['pseudo']);

      if ($id == -1)
      {
        $message="PSEUDO OU MOT DE PASSE INCORRECT";
        //header('Location:index.php');
      }
      elseif(!$manager->verifier( $id , $_POST['mdp'] )) 
      {
        $message="PSEUDO OU MOT DE PASSE INCORRECT";
        //header('Location:index.php');
      }
      else
      {
        $joueur = $manager->get($_POST['pseudo']);
        
        $_SESSION['joueur'] = $joueur;

        header('Location:../jouer/tesst.php');
      }
    }
  }
  elseif($_SESSION['joueur'])
  {

  }

?>


<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from getbootstrap.com/examples/signin/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 01 Aug 2016 08:55:39 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Se connecter</title>

    <script src="../../../script_control_login.js">
    </script>

    <!-- Bootstrap core CSS -->
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            
          </button>
          <a class="navbar-brand" href="#">Project name</a>
        </div>

        <?php

        if (!isset($_SESSION['joueur']))
        {

        ?>
          <div id="navbar" class="navbar-collapse collapse">
            <a class="navbar-brand navbar-right active" href="../creation"> <label>Je veux créer mon compte!!</label></a>
          </div><!--/.navbar-collapse -->

        <?php

        }else
        {

        ?>

          <div id="navbar" class="navbar-collapse collapse">
            <a class="navbar-brand navbar-right active" href="../deconnection.php"> <label>La session @<?php echo $_SESSION['joueur']->pseudo(); ?> est ouverte, La deconnecter!!</label></a>
          </div>

        <?php

        }

        ?>
      </div>
    </nav>

    <img src="../2.png">

    <input type="file" name="olala" />

    <input type="image" src="../2.png" name="olala" />

    <div class="container">

      <?php
      if(!isset($_SESSION['joueur']))
      {

      ?>

      <form class="form-signin" name="form" action="index.php" onsubmit = "return verifFormConnexion (this)" method="POST">
        
        <h2 class="form-signin-heading">Athentification</h2>
        
        <label for="inputEmail" class="sr-only">Pseudo</label>
        <input type="texte" name="pseudo" id="" class="form-control" onblur="verifPseudo(this)" placeholder="Pseudo" required autofocus>
        
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="mdp" id="inputPassword" class="form-control" onblur="verifCle(this)" placeholder="Password" required>
        
        <div class="checkbox">
          <label>
            <input type="checkbox" name="case" onclick="(voir())();"/><em>voir le mot de passe</em>
          </label>
        </div>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Se connecter</button>

        <?php 
          if (isset($message)) // On a un message à afficher ?
          {
            echo '<p>', $message, '</p>'; // Si oui, on l'affiche
          }          
        ?>

      </form>

      <?php
      }
      else
      {

      ?>
        <div class="container">
        <div class="alert alert-danger">
        <fieldset>
          <legend><label><h1>Une session est en cour...</h1></label></legend>
        
      <?php
          echo '<label><h3>La session de <strong>@'.$_SESSION['joueur']->pseudo().'</strong> est connecté!!</h3></label>';
      ?>
        <p><h4><a class="alert-link" href="../deconnection.php">Veuillez la deconnecter avant...</a></h4></p>

        </fieldset>
        </div>
        </div>
      <?php

      }

      ?>

    </div> <!-- /container -->

    <pre>
      <?php

      print_r($_SESSION);

      ?>
    </pre>


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>

<!-- Mirrored from getbootstrap.com/examples/signin/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 01 Aug 2016 08:55:39 GMT -->
</html>