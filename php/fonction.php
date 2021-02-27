
<!-- add comentaire -->
<?php 

 function getpub()
{

  // heey
	                                       
	 $bdd= new PDO('mysql:host=localhost;dbname=tweetemsi','root','');
      $requete = $bdd ->prepare ('SELECT * FROM publications order by pub_date desc');
     $nbligne= $requete -> execute(array());
                  
             if($nbligne>0)
             {

             	           while($donnees=$requete->fetch())
                           {
	                        $pub_id=$donnees['id_pub'];
	                        $pub_titre=$donnees['titre'];
	                        $pub_description=$donnees['description'];
	                        $pub_image=$donnees['image'];
	                        $pub_date=$donnees['pub_date'];
	                        $pub_utilisateur=$donnees['utilisateur'];
			                                 $util = $bdd ->prepare ('SELECT * FROM utilisateurs where id_util=?');
			     						     $util -> execute(array($pub_utilisateur));
			     						      while($infos=$util->fetch())
			                           		  {
			                                          $login=$infos['login'];
			                                          $img_util=$infos['img_profil'];
			                           		  }
                              

                           
                              echo "

                                        <div class='publication'>
                                              <img src='./img/$img_util' class='img-pers'>
                                              <a href='profil.php?util=$login'><h3>$login</h3></a>
                                             <h6>$pub_date</h6>
                                              <img src='./img/$pub_image'><br>
                                               
                                               <a href='details.php?id=$pub_id'>voir plus</a>
                                               
                                               <form></form>              

                                         </div>
                                          
                              
                             
                            </button>


                              ";

          

                           }
             }
             else
             {
                 echo "pas de publications";

             }
                       

}


function getpubparutilisateur($var)
{

     $bdd= new PDO('mysql:host=localhost;dbname=tweetemsi','root','');
     $requete = $bdd ->prepare ('SELECT p.*,u.* FROM publications p inner join utilisateurs u on p.utilisateur=u.id_util where u.login=? order by p.pub_date desc');
     $nbligne= $requete -> execute(array($var));
                  
               
                          while($donnees=$requete->fetch())
                           {
                                 $pub_id=$donnees['id_pub'];
                                  $pub_titre=$donnees['titre'];
                                  $pub_description=$donnees['description'];
                                  $pub_image=$donnees['image'];
                                  $pub_date=$donnees['pub_date'];
                                  $pub_utilisateur=$donnees['utilisateur'];
                                  $img_util=$donnees['img_profil'];
                      
                                    echo "

                                            <div class='publication'>
                                           <img src='./img/$img_util' class='img-pers'>
                                           <h3>$var</h3>
                                           <h6>$pub_date</h6>
                                           <img src='./img/$pub_image'><br>
                                           
                                             <a href='details.php?id=$pub_id'>voir plus</a>
                                           </div>







                                    ";
                           }
}

function getheaderparutilisateur($var)
{
            $bdd= new PDO('mysql:host=localhost;dbname=tweetemsi','root','');
     $requete = $bdd ->prepare ('SELECT * FROM utilisateurs where login=?');
     $nbligne= $requete -> execute(array($var));
     while($donnees=$requete->fetch())
    {
      $img_profil=$donnees['img_profil'];
      $img_couvert=$donnees['img_couverture'];

              echo "
                       <img src='./img/$img_couvert' class='img-couvert'>
          <img src='./img/$img_profil' class='img-profil'>
          <span class='login'>$var</span>


              ";
    }

}
function getdetails($var)
{ 
      $bdd= new PDO('mysql:host=localhost;dbname=tweetemsi','root','');
     $requete = $bdd ->prepare ('SELECT p.*,u.* FROM publications p inner join utilisateurs u on u.id_util=p.utilisateur where id_pub=?');
     $nbligne= $requete -> execute(array($var));
     while($donnees=$requete->fetch())
    {
                                  $pub_id=$donnees['id_pub'];
                                  $pub_titre=$donnees['titre'];
                                  $pub_description=$donnees['description'];
                                  $pub_image=$donnees['image'];
                                  $pub_date=$donnees['pub_date'];
                                  $pub_utilisateur=$donnees['utilisateur'];
                                  $img_profil=$donnees['img_profil'];
                                  $login=$donnees['login'];
                                  

                                    echo "
                                
                                <div class='pub'>
                                           
                                          <div class='row' style='border:1px solid black;padding:20px;border-radius:20px;'>
                                              <div class='col-lg-6'>
                                                       <img src='./img/$img_profil' class='img-pers'>
                                                       <a href='profil.php?util=$login'><h3>$login</h3></a>
                                                       <h6>$pub_date</h6>
                                                       <img src='./img/$pub_image'><br>
                                              </div>
                                              <div class='col-lg-6' style='border-left:1px solid black;padding-top:20px;'>
                                                       
                                                       
                                                       <h5>titre : $pub_titre<h5>
                                                       <h5>description : $pub_description<h5>
                                              </div>
                                           
                                           

                                                    
                                                       
                                           </row>        
                                  </div>

                                





                                    ";

    }
        
}

function getlistamis($var)
{
        $bdd= new PDO('mysql:host=localhost;dbname=tweetemsi','root','');
        $requete = $bdd ->prepare ('SELECT u.* from utilisateurs u inner join amis a on u.id_util=a.ami where a.utilisateur=?');
        $requete -> execute(array($var));
         while($donnees=$requete->fetch())
        {

                          
                          $login=$donnees['login'];
                          $imgprofil=$donnees['img_profil'];
                           $id=$donnees['id_util'];

                 echo "
                            

                    <li><a href='profil.php?util=$login'>
                      <img src='img/$imgprofil' class='img-ami'/>
                       $login
                    </a></li>
                    <li><a href='discussion.php?rec=$id' class='btn btn-success'>
                     contacter
                    </a></li>
                    
                




                 ";




        }

}

function getlistamisParprofil($var)
{

     $bdd= new PDO('mysql:host=localhost;dbname=tweetemsi','root','');
        $requete = $bdd ->prepare ('SELECT u.* from utilisateurs u inner join amis a on u.id_util=a.ami inner join utilisateurs u2 on u2.id_util=a.utilisateur where u2.login=?');
        $requete -> execute(array($var));
         while($donnees=$requete->fetch())
        {

                          
                          $login=$donnees['login'];
                          $imgprofil=$donnees['img_profil'];
                         

                    echo "
                          

                    <div class='ami'> <a href='profil.php?util=$login'>$login</a><br>
                         <img src='img/$imgprofil' class='img-ami'>
                   </div>
                    
                




                 ";



        }
     
                         

                 




        

}

function getinfosutilisateur($var)
{
        $bdd= new PDO('mysql:host=localhost;dbname=tweetemsi','root','');
        $requete = $bdd ->prepare ('SELECT * from utilisateurs  where login=?');
        $requete -> execute(array($var));
         while($donnees=$requete->fetch())
        {
             
                          $ville=$donnees['ville'];
                          $datenaiss=$donnees['date_naiss'];
                          echo "
                                      <span clas='infos'>De </span>$ville <br>
                     <span clas='infos'>date naissance :</span>$datenaiss


                          ";
        }

}

function getmessages($var)
{
        $bdd= new PDO('mysql:host=localhost;dbname=tweetemsi','root','');
        $requete = $bdd ->prepare ('SELECT m.*,u.* from messages m inner join utilisateurs u on u.id_util=m.emetteur where m.recepteur=? and m.etat=?');
        $requete -> execute(array($var,"non-vue"));
         while($donnees=$requete->fetch())
        {

                    $sms=$donnees['message'];
                    $idmsg=$donnees['id'];
                    $imgemetteur=$donnees['img_profil'];
                    $loginemetteur=$donnees['login'];
                     $recepteur=$donnees['emetteur'];
                    echo "
                    
                          <div class='sms'>

                                       <img src='img/$imgemetteur' class='user-img-top'>  
                                    $loginemetteur </br>
                                   $sms

                              </div>
                            <a href='discussion.php?rec=$recepteur' class='btn btn-success'>repondre</a>


                    ";

        }
      
}

function getlistemessages($a,$b)
{
        $bdd= new PDO('mysql:host=localhost;dbname=tweetemsi','root','');
        $requete = $bdd ->prepare ('SELECT m.*,u.* from messages m inner join utilisateurs u on u.id_util=m.emetteur where m.recepteur=? and m.emetteur=? or m.recepteur=? and m.emetteur=? order by m.id LIMIT 6');
        $requete -> execute(array($b,$a,$a,$b));
         while($donnees=$requete->fetch())
        {

                    $sms=$donnees['message'];
                    $imgemetteur=$donnees['img_profil'];
                     $loginemetteur=$donnees['login'];
                    if($donnees['id_util']==$a)
                    {
                       $loginemetteur="vous";
                    }
                    echo "
                    
                          <div class='sms'>

                                     <img src='img/$imgemetteur' class='img-disc'>  
                                  <b>  $loginemetteur </b> </br>
                                  
                                   $sms

                              </div>
                            <hr>


                    ";

        }
      
}



 ?>