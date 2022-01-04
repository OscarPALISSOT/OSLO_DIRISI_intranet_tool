<?php
$user = "root";
$password = "Dir1si_";
$dbname = "bdd-dirisi";
$host = "localhost";

try {
        global $bdd;
        $bdd = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8', $user, $password);    
     
  }
  catch (Exception $e)
  {
          die('Erreur : ' . $e->getMessage());
  }
