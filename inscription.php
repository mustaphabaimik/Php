<?php 
  if(isset($_POST['cnx']))
  {
    $errors=array();
    $bdd= new PDO('mysql:host=localhost;dbname=tweetemsi','root','');
    $requete = $bdd ->prepare ('SELECT * FROM utilisateurs where login=?');
    $requete -> execute(array($_POST['login']));
    $cpt=0;
    while($donnees=$requete->fetch())
    {
                
              $cpt++;
               
    }
    if($cpt==1)
    {
             $errors['erreur']="login exist deja";
    }
           
     if(count($errors)==0)
     {
          
              $profil=$_FILES["profil"]["name"];
             $profil_tmp=$_FILES['profil']['tmp_name'];
             move_uploaded_file($profil_tmp,"img/".$profil);

             $couverture=$_FILES["couvert"]["name"];
             $couverture_tmp=$_FILES['couvert']['tmp_name'];
             move_uploaded_file($couverture_tmp,"img/".$couverture);
            $bdd= new PDO('mysql:host=localhost;dbname=tweetemsi','root','');
             $requete = $bdd ->prepare ('INSERT INTO utilisateurs(login,password,email,img_profil,img_couverture) values(?,?,?,?,?)');
             $requete -> execute(array($_POST['login'],$_POST['pass'],$_POST['email'],$profil,$couverture));
             
             header("location:auth.php");
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
     <h1>inscription</h1>
    <form action="" method="POST" enctype="multipart/form-data">
       <div class="form-group">

            <label>login :</label>
            <input type="text" name="login" class="form-control" required/>
           
       </div>
       <?php if(isset($errors['erreur'])){ echo "<p style='color:red;'>" . $errors['erreur'] . "</p>" ;  } ?>
       <div class="form-group">

            <label>mot de pass :</label>
            <input type="password" name="pass" class="form-control" required/>
            
       </div>
       <div class="form-group">

            <label>email :</label>
            <input type="email" name="email" class="form-control" required/>
            
       </div>
        <div class="form-group">
            <label>image de profil</label>                                
            <input type="file" name="profil" required>
       </div>
       <div class="form-group">
            <label>image de couverture :</label>                                
            <input type="file" name="couvert" required>
       </div>
      
       
       
       <input type="submit" name="cnx" value="s'inscrir" class="btn btn-primary"/>
       <input type="reset" name="annuler" value="annuler" class="btn btn-primary"/>

    </form>
  
  </center>
     
	
      
</body>
</html>



