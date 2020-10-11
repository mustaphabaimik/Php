<?php 
include("php/fonction.php");
session_start();

     $bdd= new PDO('mysql:host=localhost;dbname=tweetemsi','root','');
     $requete = $bdd ->prepare ('SELECT * FROM utilisateurs where login=?');
     $requete -> execute(array($_SESSION['utilisateur_login']));
     
      while($donnees=$requete->fetch())
      {
            $imgProfil=$donnees['img_profil'];
            $utili=$donnees['id_util'];

      }
 ?>



<html>
<head>
  <title>twitter</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  

  <script src=""></script>
  <link rel="stylesheet" type="text/css" href="css/styleee.css" />

</head>
<body>
        <header>
                <span class="logo">tweetemsi</span>
                <div class="navbar">
                      <div class="navbar-right">
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
        <aside class="main-sidebar">
          <h3 style="background-color:#5D8CAE;text-align:center;color:black;">amis</h3>
          <ul>
              <?php getlistamis($utili) ;?>
          </ul>
        </aside>
        <section> 
                 <a href="index.php"><button class="btn btn-primary">acceuil</button></a>
                 <button class="btn btn-primary">les pub de vos amis</button>
                 <div class="section-body"> 
                      <form method="POST" action="" enctype="multipart/form-data">
                                    <div class="form-group">
                                          <label>titre</label>
                                          <input type="text" name="titre" class="form-control" placeholder="titre" required/>
                                    </div>
                                    <div class="form-group">
                                          <label>description</label>                                      
                                    <textarea name="desc" class="form-control" placeholder="description" required></textarea>
                                    </div>
                                      <div class="form-group">
                                          <label>image</label>
                                          <input type="file" name="video">
                                      </div>
                                     <input type="submit" name="publier" value="publier" class="btn btn-primary" />
                                     <input type="reset" name="annuler" value="annuler" class="btn btn-primary" />

                      </form>
                </div>
        </section>
      
<script src="js/jquery.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>      
</body>
</html>

 <?php 

if(isset($_POST['publier']))
{    
      $c_img=$_FILES["video"]["name"];
      $c_img_tmp=$_FILES['video']['tmp_name'];
      move_uploaded_file($c_img_tmp,"img/".$c_img);
      $bdd= new PDO('mysql:host=localhost;dbname=tweetemsi','root','');
      $requete = $bdd ->prepare ('INSERT INTO publications(titre,description,pub_date,image,utilisateur) values(?,?,?,?,?)');
      $requete -> execute(array($_POST['titre'],$_POST['desc'],'NOW()',$c_img,$utili));
      echo "<script>alert('bien ajouter')</script>";
}



 ?>