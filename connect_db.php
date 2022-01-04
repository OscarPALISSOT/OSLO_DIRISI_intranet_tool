<?php

try {
        $db = new PDO('mysql:host=localhost;dbname=bdd-dirisitest', 'root', '');
  }
  catch (PDOException $e)
  {
          die('Erreur : ' . $e->getMessage());
  }
?>