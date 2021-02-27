
<?php 
 
session_start();
 if(isset($_POST['cnx']))
  {
  	
		  
  	 $errors=array();
  	$bdd= new PDO('mysql:host=localhost;dbname=tweetemsi','root','');
      $requete = $bdd ->prepare ('SELECT * FROM utilisateurs where login=? and password=?');
      $requete -> execute(array($_POST['login'],$_POST['pass']));
     $cpt=0;
    

			      while($donnees=$requete->fetch())
			      {
			          
			          	$cpt++;
			         
			      }
			     if($cpt==0)
			     {
			     	 $errors['erreur']="invaliiid";
			     }
			     
       
     if(count($errors)==0)
     {
     	    $l=$_POST['login'];
		     	$_SESSION['utilisateur_login']=$l;
		      header("location:index.php");
     }
  }

?>


<html>
<head>
	<title>twitter</title>
	 <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/auth.css">
</head>
<body>
  <center>
     <h1>authentification</h1>
    <form action="" method="POST">
       <div class="form-group">

            <label>login :</label>
            <input type="text" name="login" class="form-control" required/>
           
       </div>
       <div class="form-group">

            <label>mot de pass :</label>
            <input type="password" name="pass" class="form-control" required/>
            
       </div>
       <?php if(isset($errors['erreur'])){ echo "<p style='color:red;'>" . $errors['erreur'] . "</p>" ;  } ?>
       
       
       <input type="submit" name="cnx" value="connexion" class="btn btn-primary"/>

    </form>
   <h3><a href="inscription.php">inscription</a></h3> 
  </center>
     
	
      
</body>
</html>

