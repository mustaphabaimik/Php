<?php 
include("php/fonction.php");
session_start();
 $bdd= new PDO('mysql:host=localhost;dbname=tweetemsi','root','');
     $requete = $bdd ->prepare ('SELECT * FROM utilisateurs where login=?');
     $requete -> execute(array($_SESSION['utilisateur_login']));
     
      while($donnees=$requete->fetch())
      {
            $imgProfil=$donnees['img_profil'];
            $id=$donnees['id_util'];
      } 
 ?>
<html>
<head>
  <title>twitter</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/styleee.css" />
</head>
<body>
        <header>
                <span class="logo">tweetemsi</span>
                <div class="navbar">   
                            <div class="navbar-right">
                                  <div class="dropdown">
                                            <span class="dropdown-toggle" data-toggle="dropdown">
                                               <span class="glyphicon glyphicon-envelope"></span> 
                                            </span>
                                            <div class="dropdown-menu list_messages">
                                              <?php getmessages($id) ?>   
                                            </div>
                                  </div>
                                   <div class="dropdown">
                                              <span class="dropdown-toggle" data-toggle="dropdown">
                                                    <?php echo " <img src='img/$imgProfil' class='user-img-top'>    "; ?>
                                                   
                                                    <span class="user-name-top"><b><?php echo $_SESSION['utilisateur_login']; ?></b></span>
                                              </span>
                                            <div class="dropdown-menu user">
                                                  <div class="user-header">
                                                    <?php echo " <img src='img/$imgProfil' class='img-circle'> " ;?>
                                                         
                                                         <p><?php echo $_SESSION['utilisateur_login']; ?></p>
                                                         
                                                  </div>
                                              
                                                  <div class="user-footer">
                                                        <div class="pull-right">
                                                              <a href="profil.php?util=<?php echo $_SESSION['utilisateur_login']; ?>" class="btn btn-default">profil</a>
                                                        </div> 
                                                         <div class="pull-left">
                                                              <a href="deconnection.php" class="btn btn-default">deconnetcter</a>
                                                        </div>        

                                                  </div>     
                                            </div>
                                  </div>
                        </div>
              </div>
        </header>
        <aside>
               <h3 style="background-color:#5D8CAE;text-align:center;color:black;">amis</h3>
               <ul>
                  <?php getlistamis($id) ;?>
               </ul>
        </aside>
        <section>  
                <a href="publier.php"><button class="btn btn-primary">publier</button></a>
                <button class="btn btn-primary">les pub de vos amis</button>
                 <div class="section-body">        
                   <?php getpub(); ?>
                 </div>
        </section>
 <script src="js/jquery.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>      
</body>
</html>