<?php
    global $query;
if(isset($_POST) && !empty($_POST['Login']) && !empty($_POST['pwd'])){
    extract($_POST);
    
    if(!preg_match('/^[a-zA-Z0-9_-]{3,20}$/', $Login)){
        die("mauvais identifiants");
    }
    $Login = htmlspecialchars($Login);
    $pwd = md5($pwd);
 
$user="root";
$password="Dir1si_";
$dbname = "bdd-dirisi";
$host = "localhost";
try
{
  global $bdd;
	$bdd = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8', $user, $password);
   
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

    
    $sql ="SELECT * FROM utilisateur WHERE Login='$Login' AND pwd='$pwd'";
    $sql_count= $bdd->query($sql);
    if($count = $sql_count->rowCount()){
        if($user = $sql_count->fetch()){
        //initialisation des sessions
    $_SESSION["Auth"] = array(
        'Login' => $Login,
        'pwd' => $pwd,
        'role' => $user['Role']
         );
        }
   
        //var_dump($_SESSION["Auth"]);
    
   
  
    if(isset($query['trigramme'])){
        header('Location: https://'.$_SERVER['HTTP_HOST'].'/quartiers?trigramme='.$query['trigramme']);
    } else {
    header('Location: https://'.$_SERVER['HTTP_HOST']);
    
    }
    //var_dump($query['trigramme']);
   
   // header('Location:'. $_SERVER['HTTP_REFERER']);
   
    } else {
        echo "mauvais identifiants";
    }
}
?>

<!DOCTYPE html>
<html>
 <head><meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="Ressources/css/style.css" rel="stylesheet"> 
   <link href="vendor/bootstrap-5.0.0-beta1-dist/css/bootstrap.min.css" rel="stylesheet">  
    
    </head>

<body>
<div class="container">
<h3 style="text-align: center">Veuillez vous authentifier</h3>
<form action="/login" method="post">

            <label for="Login" class="col-sm-auto"><span>Login :</span> </label>
            <input class="col-sm form-control" id="Login" name="Login" required="required" type="text" placeholder="Login" /><br>
                        
                             
            <label for="pwd" class="col-sm-auto"><span>Mot de passe :</span> </label>
            <input class="col-sm form-control" id="pwd" name="pwd" required="required" type="password" placeholder="Mot de passe" /><br>
                              
                                <button type="submit" class="btn btn-dark">M'authentifier</button>
</form>
</div>

</body>
</html>