<?php 
session_start();
include("php/fonction.php");
 ?>
<html>
<head>
	<title>twitter</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/profil2.css">
</head>
<body>
	 <header>
         <?php getheaderparutilisateur($_GET['util']) ?>
	 </header>
	 <aside>
             <div class="aside-header">
                <?php getinfosutilisateur($_GET['util']); ?>
             </div>
             <div class="aside-body">
              <h3>amis</h3> <br>
                   <?php  
                            getlistamisParprofil($_GET['util']);
                   ?>
             </div>

	 </aside>
	 <section>
          	 	<div class="section-header">
                    <a href="index.php" class="btn btn-primary">Acceuil</a>
                    <a href="publier.php" class="btn btn-primary">publier</a>
          	 	</div>
                   <div class="section-body">       
                   <?php getpubparutilisateur($_GET['util']); ?>
          	 	</div>
	 </section>
    
</body>
</html>