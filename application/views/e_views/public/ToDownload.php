<?php


if ( true )
{
  

?>
  
  <!DOCTYPE html>
  <html>
  <head>
    <style type="text/css">
    table
    {
    border-collapse: collapse;
    width: 100%;
      height: 100%;

    }
    td, th /* Mettre une bordure sur les td ET les th */
    {
    border: 1px solid black;
    }
    .table{
      padding: 20px;
    }
    body{
      
    }

    </style>

    <title>Telechager</title>
  </head>
  <body>
  
  <img src="logo.png" alt="Photo de montagne" />

  <div class="col-sm-10 col-lg-10">
    

  <h2 class="sub-header">Voici l'ensemble de vos quizz Ajoutés</h2>
  <div class="">
  <h2 class="sub-header"> Mes quizz Ajoutés<span class="badge">
      
  </span></h2>

<?php

  if (isset($liste))
  {

?>
    
    <div class="table-responsive">
      <table class="">
        <thead>
          <tr>
            <th>Questions</th>
            <th>Reponse</th>
            <th>Prop1</th>
            <th>Prop2</th>
            <th>Prop3</th>
            <th>Catégorie</th>
            <th>Date d'ajout</th>
            <th>Validé par/Le</th>
          </tr>
        </thead>
        <tbody>

<?php
  


?>

        </tbody>
      </table>
    </div>

<?php
  }
  else
  {
    echo '<p>vous n\'avez pas encore ajouté de Quizz ou acun n\'a été validé!!!</p>';
  }
?>

    </div>
    </div>

<?php

}
else
{
  
}

?>

</body>
  </html>