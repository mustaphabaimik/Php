<?php 
include("php/fonction.php");
session_start();

     $bdd= new PDO('mysql:host=localhost;dbname=tweetemsi','root','');
     $requete = $bdd ->prepare ('SELECT * FROM utilisateurs where login=?');
     $requete -> execute(array($_SESSION['utilisateur_login']));
     
      while($donnees1=$requete->fetch())
      {
            $imgProfil=$donnees1['img_profil'];
            $id_util=$donnees1['id_util'];
      }

       $requete2 = $bdd ->prepare ('SELECT * FROM publications where id_pub=?');
       $requete2 -> execute(array($_GET['id']));

        while($donnees2=$requete2->fetch())
      {
            $ami=$donnees2['utilisateur'];
      }


       $requete3 = $bdd ->prepare ('SELECT * FROM amis where ami=? and utilisateur=?');
       $requete3 -> execute(array($ami,$id_util));
       $cpt=0;
        while($donnees2=$requete3->fetch())
      {
            $cpt++;
      }
     
    if($cpt==0 and $id_util!=$ami)
    {
      $requete4 = $bdd ->prepare ('INSERT INTO amis(utilisateur,ami) values(?,?)');
     $requete4 -> execute(array($id_util,$ami));
    }
      

    
 ?>
<html>
<head>
  <title>twitter</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
  <link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap-grid.min.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/styleee.css" />
  <link rel="stylesheet" type="text/css" href="css/details2.css" />

</head>
<body>
        <header>
                <span class="logo">twitter</span>
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
        <aside>
          <h3 style="background-color:#5D8CAE;text-align:center;color:black;">amis</h3>
               <ul>                 
                    <?php getlistamis($id_util) ;?>                    
               </ul>
        </aside>
        <section>
                
                 <a href="publier.php"><button class="btn btn-primary">publier</button></a>
                 <button class="btn btn-primary">les pub de vos amis</button>        
                 <div class="section-body"> 
                   <?php 
                           getdetails($_GET['id']);
                   ?>
                 </div>
        </section>
 <script src="js/jquery.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>      
</body>
</html>