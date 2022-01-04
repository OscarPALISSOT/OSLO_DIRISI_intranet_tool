<?php

include_once("Modèle/connect_db.php");


    
    if(isset($_POST['query']) && !empty($_POST['query'])){

        $query = preg_replace("#[^a-z -_çà?0-9]#i", ",", $_POST['query']);
        

        if($_POST['filtre'] == "Site entier"){


        } if($_POST['filtre'] == "bnrs_finis"){
            $sql =$db->prepare( "SELECT *, `organisme`.`Nom` FROM bnrs_finis LEFT JOIN organisme ON bnrs_finis.Id_organisme = organisme.Id_organisme WHERE Nature LIKE ? OR Zone LIKE ? OR N_ASAP LIKE ? OR N_SERVICE_du_PDC LIKE ? OR N_RANG LIKE ? OR Priorisation LIKE ? OR Bénéficiaire LIKE ? OR BDD_Impliquée LIKE ? OR Description_Service LIKE ? OR Objectifs_et_description_fonctionnelle LIKE ? OR Montant_FEB LIKE ? OR Date_retour_DTS LIKE ? OR Point_de_situation LIKE ? OR Chef_de_projet LIKE ? OR Technicien LIKE ? OR Trigramme LIKE ? OR Nom LIKE ? ORDER BY bnrs_finis.id ASC;");
            $sql->execute(array('%'.$query.'%','%'.$query.'%','%'.$query.'%','%'.$query.'%','%'.$query.'%','%'.$query.'%','%'.$query.'%','%'.$query.'%','%'.$query.'%','%'.$query.'%','%'.$query.'%','%'.$query.'%','%'.$query.'%','%'.$query.'%','%'.$query.'%','%'.$query.'%','%'.$query.'%'));
            
            $count = $sql->rowCount();
            
            if($count >= 1 ){

                echo "<div class='count'>$count résultat(s) trouvé(s) pour <strong>$query</strong><hr/></div>";
                echo '<div class="container"> <div class="table-responsive">
                
                <table class="table table-bordered" style="border-color:black;"><thead class="thead-dark">
                <tbody>
                
                      <tr class="table-dark">
                        <th scope="col">ID</th>
                        <th scope="col">Nature</th>
                        <th scope="col">Zone</th>
                        <th scope="col">N_ASAP</th>
                        <th scope="col">N_SERVICE_du_PDC</th>
                        <th scope="col">N_RANG</th>
                        <th scope="col">Priorisation</th>
                        <th scope="col">Bénéficiaire</th>
                        <th scope="col">BDD_Impliquée</th>
                        <th scope="col">Description_Service</th>
                        <th scope="col">Objectifs_et_description_fonctionnelle</th>
                        <th scope="col">Montant_FEB</th>
                        <th scope="col">Date_retour_DTS</th>
                        <th scope="col">Point_de_situation</th>
                        <th scope="col">Chef_de_projet</th>
                        <th scope="col">Technicien</th>
                        <th scope="col">Trigramme</th>
                        <th scope="col">Organisme</th>
                      </tr>
                      </tbody>
                    </thead>
                    </div>
                    </div>';
                while($data = $sql->fetch(PDO::FETCH_OBJ)){
                    
                    echo '<tr class="table-active">
                        <th class="table-dark"scope="row">'.$data->ID.'</th>
                        <td >'.$data->Nature.'</td>
                        <td>'.$data->Zone.'</td>
                        <td>'.$data->N_ASAP.'</td>
                        <td>'.$data->N_SERVICE_du_PDC.'</td>
                        <td>'.$data->N_RANG.'</td>
                        <td>'.$data->Priorisation.'</td>
                        <td>'.$data->Bénéficiaire.'</td>
                        <td>'.$data->BDD_Impliquée.'</td>
                        <td>'.$data->Description_Service.'</td>
                        <td>'.$data->Objectifs_et_description_fonctionnelle.'</td>
                        <td>'.$data->Montant_FEB.'</td>
                        <td>'.$data->Date_retour_DTS.'</td>
                        <td>'.$data->Point_de_situation.'</td>
                        <td>'.$data->Chef_de_projet.'</td>
                        <td>'.$data->Technicien.'</td>
                        <td>'.$data->Trigramme.'</td>
                        <td>'.$data->Nom.'</td>
                      </tr> ';
                }
    
            } else  {
    
                echo "0 résultat trouvé pour <strong>$query</strong><hr/>";
    
            }
            
        }
        
        else if($_POST['filtre'] == "bnrs_prévus"){
          $sql =$db->prepare( "SELECT *, `organisme`.`Nom` FROM bnrs LEFT JOIN organisme ON bnrs.Id_organisme = organisme.Id_organisme WHERE Nature LIKE ? OR Zone LIKE ? OR N_ASAP LIKE ? OR N_SERVICE_du_PDC LIKE ? OR N_RANG LIKE ? OR Priorisation LIKE ? OR Bénéficiaire LIKE ? OR BDD_Impliquée LIKE ? OR Description_Service LIKE ? OR Objectifs_et_description_fonctionnelle LIKE ? OR Montant_FEB LIKE ? OR Date_de_la_demande LIKE ? OR Echeance_souhaitée LIKE ? OR Point_de_situation LIKE ? OR Chef_de_projet LIKE ? OR Technicien LIKE ? OR Trigramme LIKE ? OR Nom LIKE ? ORDER BY bnrs.id ASC;");
          $sql->execute(array('%'.$query.'%','%'.$query.'%','%'.$query.'%','%'.$query.'%','%'.$query.'%','%'.$query.'%','%'.$query.'%','%'.$query.'%','%'.$query.'%','%'.$query.'%','%'.$query.'%','%'.$query.'%','%'.$query.'%','%'.$query.'%','%'.$query.'%','%'.$query.'%','%'.$query.'%','%'.$query.'%'));
          
          $count = $sql->rowCount();
          
          if($count >= 1 ){

              echo "<div class='count'>$count résultat(s) trouvé(s) pour <strong>$query</strong><hr/></div>";
              echo '<div class="container"> <div class="table-responsive">
              
              <table class="table table-bordered" style="border-color:black;"><thead class="thead-dark">
              <tbody>
              
                    <tr class="table-dark">
                      <th scope="col">ID</th>
                      <th scope="col">Nature</th>
                      <th scope="col">Zone</th>
                      <th scope="col">N_ASAP</th>
                      <th scope="col">N_SERVICE_du_PDC</th>
                      <th scope="col">N_RANG</th>
                      <th scope="col">Priorisation</th>
                      <th scope="col">Bénéficiaire</th>
                      <th scope="col">BDD_Impliquée</th>
                      <th scope="col">Description_Service</th>
                      <th scope="col">Objectifs_et_description_fonctionnelle</th>
                      <th scope="col">Montant_FEB</th>
                      <th scope="col">Date de la demande/th>
                      <th scope="col">Echeance souhaitée/th>
                      <th scope="col">Point_de_situation</th>
                      <th scope="col">Chef_de_projet</th>
                      <th scope="col">Technicien</th>
                      <th scope="col">Trigramme</th>
                      <th scope="col">Organisme</th>
                    </tr>
                    </tbody>
                  </thead>
                  </div>
                  </div>';
              while($data = $sql->fetch(PDO::FETCH_OBJ)){
                  
                  echo '<tr class="table-active">
                      <th class="table-dark"scope="row">'.$data->ID.'</th>
                      <td >'.$data->Nature.'</td>
                      <td>'.$data->Zone.'</td>
                      <td>'.$data->N_ASAP.'</td>
                      <td>'.$data->N_SERVICE_du_PDC.'</td>
                      <td>'.$data->N_RANG.'</td>
                      <td>'.$data->Priorisation.'</td>
                      <td>'.$data->Bénéficiaire.'</td>
                      <td>'.$data->BDD_Impliquée.'</td>
                      <td>'.$data->Description_Service.'</td>
                      <td>'.$data->Objectifs_et_description_fonctionnelle.'</td>
                      <td>'.$data->Montant_FEB.'</td>
                      <td>'.$data->Date_de_la_demande.'</td>
                      <td>'.$data->Echeance_souhaitée.'</td>
                      <td>'.$data->Point_de_situation.'</td>
                      <td>'.$data->Chef_de_projet.'</td>
                      <td>'.$data->Technicien.'</td>
                      <td>'.$data->Trigramme.'</td>
                      <td>'.$data->Nom.'</td>
                    </tr> ';
              }
  
          } else  {
  
              echo "0 résultat trouvé pour <strong>$query</strong><hr/>";
  
          }
          
      }

        else if($_POST['filtre'] == "Inférieur à"){
            $sql =$db->prepare("SELECT *, organisme.Nom FROM bnrs_finis LEFT JOIN organisme ON bnrs_finis.Id_organisme = organisme.Id_organisme WHERE Montant_FEB <= $query");
            $sql->execute(array());


            
            $count = $sql->rowCount();
            
            if($count >= 1 ){

                echo "<div class='count'>$count résultat(s) trouvé(s) pour <strong>$query</strong><hr/></div>";
                echo '<div class="container"> <div class="table-responsive">
                
                <table class="table table-bordered" style="border-color:black;"><thead class="thead-dark">
                <tbody>
                
                      <tr class="table-dark">
                      
  
                        <th scope="col">ID</th>
                        <th scope="col">Nature</th>
                        <th scope="col">Zone</th>
                        <th scope="col">N_ASAP</th>
                        <th scope="col">N_SERVICE_du_PDC</th>
                        <th scope="col">N_RANG</th>
                        <th scope="col">Priorisation</th>
                        <th scope="col">Bénéficiaire</th>
                        <th scope="col">BDD_Impliquée</th>
                        <th scope="col">Description_Service</th>
                        <th scope="col">Objectifs_et_description_fonctionnelle</th>
                        <th scope="col">Montant_FEB</th>
                        <th scope="col">Date_retour_DTS</th>
                        <th scope="col">Point_de_situation</th>
                        <th scope="col">Chef_de_projet</th>
                        <th scope="col">Technicien</th>
                        <th scope="col">Trigramme</th>
                        <th scope="col">Organisme</th>
                      </tr>
                      </tbody>
                    </thead>
                    </div>
                    </div>';
                while($data = $sql->fetch(PDO::FETCH_OBJ)){
                    
                    echo '
                    
                      <tr class="table-active">
                        <th class="table-dark"scope="row">'.$data->ID.'</th>
                        <td >'.$data->Nature.'</td>
                        <td>'.$data->Zone.'</td>
                        <td>'.$data->N_ASAP.'</td>
                        <td>'.$data->N_SERVICE_du_PDC.'</td>
                        <td>'.$data->N_RANG.'</td>
                        <td>'.$data->Priorisation.'</td>
                        <td>'.$data->Bénéficiaire.'</td>
                        <td>'.$data->BDD_Impliquée.'</td>
                        <td>'.$data->Description_Service.'</td>
                        <td>'.$data->Objectifs_et_description_fonctionnelle.'</td>
                        <td>'.$data->Montant_FEB.'</td>
                        <td>'.$data->Date_retour_DTS.'</td>
                        <td>'.$data->Point_de_situation.'</td>
                        <td>'.$data->Chef_de_projet.'</td>
                        <td>'.$data->Technicien.'</td>
                        <td>'.$data->Trigramme.'</td>
                        <td>'.$data->Nom.'</td>
                        
                      </tr> ';
                }
            }else  {
    
              echo "0 résultat trouvé pour <strong>$query</strong><hr/>";
  
          }
        }
        
        else if($_POST['filtre'] == "Supérieur à"){
          $sql =$db->prepare("SELECT *, organisme.Nom FROM bnrs_finis LEFT JOIN organisme ON bnrs_finis.Id_organisme = organisme.Id_organisme WHERE Montant_FEB >= $query");
          $sql->execute(array());


          
          $count = $sql->rowCount();
          
          if($count >= 1 ){

              echo "<div class='count'>$count résultat(s) trouvé(s) pour <strong>$query</strong><hr/></div>";
              echo '<div class="container"> <div class="table-responsive">
              
              <table class="table table-bordered" style="border-color:black;"><thead class="thead-dark">
              <tbody>
              
                    <tr class="table-dark">
                    

                      <th scope="col">ID</th>
                      <th scope="col">Nature</th>
                      <th scope="col">Zone</th>
                      <th scope="col">N_ASAP</th>
                      <th scope="col">N_SERVICE_du_PDC</th>
                      <th scope="col">N_RANG</th>
                      <th scope="col">Priorisation</th>
                      <th scope="col">Bénéficiaire</th>
                      <th scope="col">BDD_Impliquée</th>
                      <th scope="col">Description_Service</th>
                      <th scope="col">Objectifs_et_description_fonctionnelle</th>
                      <th scope="col">Montant_FEB</th>
                      <th scope="col">Date_retour_DTS</th>
                      <th scope="col">Point_de_situation</th>
                      <th scope="col">Chef_de_projet</th>
                      <th scope="col">Technicien</th>
                      <th scope="col">Trigramme</th>
                      <th scope="col">Organisme</th>
                    </tr>
                    </tbody>
                  </thead>
                  </div>
                  </div>';
              while($data = $sql->fetch(PDO::FETCH_OBJ)){
                  
                  echo '
                  
                    <tr class="table-active">
                      <th class="table-dark"scope="row">'.$data->ID.'</th>
                      <td >'.$data->Nature.'</td>
                      <td>'.$data->Zone.'</td>
                      <td>'.$data->N_ASAP.'</td>
                      <td>'.$data->N_SERVICE_du_PDC.'</td>
                      <td>'.$data->N_RANG.'</td>
                      <td>'.$data->Priorisation.'</td>
                      <td>'.$data->Bénéficiaire.'</td>
                      <td>'.$data->BDD_Impliquée.'</td>
                      <td>'.$data->Description_Service.'</td>
                      <td>'.$data->Objectifs_et_description_fonctionnelle.'</td>
                      <td>'.$data->Montant_FEB.'</td>
                      <td>'.$data->Date_retour_DTS.'</td>
                      <td>'.$data->Point_de_situation.'</td>
                      <td>'.$data->Chef_de_projet.'</td>
                      <td>'.$data->Technicien.'</td>
                      <td>'.$data->Trigramme.'</td>
                      <td>'.$data->Nom.'</td>
                      
                    </tr> ';
              }
          }else  {
  
            echo "0 résultat trouvé pour <strong>$query</strong><hr/>";

        }
      }


      else if($_POST['filtre'] == "Contact"){
        $sql =$db->prepare("SELECT * FROM contact WHERE Nom LIKE ? OR Prénom LIKE ? OR Email LIKE ? OR TPH LIKE ? OR Cirisi LIKE ? OR Enseigne LIKE ? OR BdD LIKE ? OR ADS LIKE ? OR PNIA LIKE ? ORDER BY contact.ID ASC;");
        $sql->execute(array('%'.$query.'%', '%'.$query.'%', '%'.$query.'%', '%'.$query.'%', '%'.$query.'%', '%'.$query.'%', '%'.$query.'%', '%'.$query.'%', '%'.$query.'%'));


        
        $count = $sql->rowCount();
        
        if($count >= 1 ){

            echo "<div class='count'>$count résultat(s) trouvé(s) pour <strong>$query</strong><hr/></div>";
            echo '<div class="container"> <div class="table-responsive">
            
            <table class="table table-bordered" style="border-color:black;"><thead class="thead-dark">
            <tbody>
            
                  <tr class="table-dark">
                  

                    <th scope="col">ID</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Email</th>
                    <th scope="col">TPH</th>
                    <th scope="col">Cirisi</th>
                    <th scope="col">Enseigne</th>
                    <th scope="col">BdD</th>
                    <th scope="col">ADS</th>
                    <th scope="col">PNIA</th>
                  </tr>
                  </tbody>
                </thead>
                </div>
                </div>';
            while($data = $sql->fetch(PDO::FETCH_OBJ)){
                
                echo '
                
                  <tr class="table-active">
                    <th class="table-dark"scope="row">'.$data->ID.'</th>
                    <td >'.$data->Nom.'</td>
                    <td>'.$data->Prénom.'</td>
                    <td>'.$data->Email.'</td>
                    <td>'.$data->TPH.'</td>
                    <td>'.$data->Cirisi.'</td>
                    <td>'.$data->Enseigne.'</td>
                    <td>'.$data->BdD.'</td>
                    <td>'.$data->ADS.'</td>
                    <td>'.$data->PNIA.'</td>
                  </tr> ';
            }
        }else  {

          echo "0 résultat trouvé pour <strong>$query</strong><hr/>";

      }
    }

    else if($_POST['filtre'] == "NomOrganisme"){
      $sql =$db->prepare("SELECT *, organisme_quartiers.Trigramme, quartiers.Nom, quartiers.Adresse FROM organisme INNER JOIN organisme_quartiers ON organisme.Id_organisme = organisme_quartiers.Id_organisme INNER JOIN quartiers ON organisme_quartiers.Trigramme = quartiers.Trigramme WHERE quartiers.Trigramme LIKE ? ORDER BY organisme.Id_organisme;");
      $sql->execute(array('%'.$query.'%'));


      
      $count = $sql->rowCount();
      
      if($count >= 1 ){

          echo "<div class='count'>$count résultat(s) trouvé(s) pour le Trigramme <strong>$query</strong><hr/></div>";
          echo '<div class="container"> <div class="table-responsive">
          
          <table class="table table-bordered" style="border-color:black;"><thead class="thead-dark">
          <tbody>
          
                <tr class="table-dark">
                

                  <!--<th scope="col">ID</th>-->
                  <th scope="col">Trigramme</th>
                  <th scope="col">Nom</th>
                  <th scope="col">Nom</th>
                  <th scope="col">Adresse</th>
                </tr>
                </tbody>
              </thead>
              </div>
              </div>';
          while($data = $sql->fetch(PDO::FETCH_OBJ)){
              
              echo '
              
                <tr class="table-active">
                  <!--<th class="table-dark"scope="row">'.$data->Id_organisme.'</th>-->
                  <td >'.$data->Trigramme.'</td>
                  <td >'.$data->Nom.'</td>
                  <td >'.$data->nom.'</td>
                  <td >'.$data->Adresse.'</td>
                </tr> ';
          }
      }else  {

        echo "0 résultat trouvé pour <strong>$query</strong><hr/>";

    }
  }

  else if($_POST['filtre'] == "modip"){
    $sql =$db->prepare("SELECT * FROM modip WHERE Numero_DECLIC LIKE ? OR Classement_DL LIKE ? OR Priorite_DECLIC LIKE ? OR Site LIKE ? OR Trigramme LIKE ? OR Classification_Site LIKE ? OR clients LIKE ? OR Classification_Operation LIKE ? OR Cout LIKE ? OR Description LIKE ? OR Categorie LIKE ? OR Type LIKE ? OR reno_avant LIKE ? OR reno_apres LIKE ? OR Annee_Coeur_av_tvx LIKE ? OR Annee_reno_coeur LIKE ? OR Annee LIKE ? OR Semestre LIKE ?");
    $sql->execute(array('%'.$query.'%', '%'.$query.'%', '%'.$query.'%', '%'.$query.'%', '%'.$query.'%', '%'.$query.'%', '%'.$query.'%', '%'.$query.'%', '%'.$query.'%', '%'.$query.'%', '%'.$query.'%', '%'.$query.'%', '%'.$query.'%', '%'.$query.'%', '%'.$query.'%', '%'.$query.'%', '%'.$query.'%', '%'.$query.'%'));


    
    $count = $sql->rowCount();
    
    if($count >= 1 ){

        echo "<div class='count'>$count résultat(s) trouvé(s) pour le Trigramme <strong>$query</strong><hr/></div>";
        echo '<div class="container"> <div class="table-responsive">
        
        <table class="table table-bordered" style="border-color:black;"><thead class="thead-dark">
        <tbody>
        
              <tr class="table-dark">
              

                <!--<th scope="col">Id_modip</th>-->
                <th scope="col">Numero DECLIC</th>
                <th scope="col">Classement DL</th>
                <th scope="col">Priorite DECLIC</th>
                <th scope="col">Site</th>
                <th scope="col">Trigramme</th>
                <th scope="col">Classification Site</th>
                <th scope="col">Clients</th>
                <th scope="col">Classification Operation</th>
                <th scope="col">Cout</th>
                <th scope="col">Description</th>
                <th scope="col">Categorie</th>
                <th scope="col">Type</th>
                <th scope="col">Reno_avant</th>
                <th scope="col">Reno_apres</th>
                <th scope="col">Annee Coeur av tvx</th>
                <th scope="col">Annee reno coeur</th>
                <th scope="col">Annee</th>
                <th scope="col">Semestre</th>
              </tr>
              </tbody>
            </thead>
            </div>
            </div>';
        while($data = $sql->fetch(PDO::FETCH_OBJ)){
            
            echo '
            
              <tr class="table-active">
                <!--<th class="table-dark"scope="row">'.$data->Id_modip.'</th>-->
                <td >'.$data->Numero_DECLIC.'</td>
                <td >'.$data->Classement_DL.'</td>
                <td >'.$data->Priorite_DECLIC.'</td>
                <td >'.$data->Site.'</td>
                <td >'.$data->Trigramme.'</td>
                <td >'.$data->Classification_Site.'</td>
                <td >'.$data->clients.'</td>
                <td >'.$data->Classification_Operation	.'</td>
                <td >'.$data->Cout.'</td>
                <td >'.$data->Description.'</td>
                <td >'.$data->Categorie.'</td>
                <td >'.$data->Type.'</td>
                <td >'.$data->reno_avant.'</td>
                <td >'.$data->reno_apres.'</td>
                <td >'.$data->Annee_Coeur_av_tvx	.'</td>
                <td >'.$data->Annee_reno_coeur.'</td>
                <td >'.$data->Annee.'</td>
                <td >'.$data->Semestre.'</td>
              </tr> ';
        }
    }else  {

      echo "0 résultat trouvé pour <strong>$query</strong><hr/>";

  }
}

else if($_POST['filtre'] == "modip finis"){
  $sql =$db->prepare("SELECT * FROM modip_finis WHERE Numero_DECLIC LIKE ? OR Classement_DL LIKE ? OR Priorite_DECLIC LIKE ? OR Site LIKE ? OR Trigramme LIKE ? OR Classification_Site LIKE ? OR clients LIKE ? OR Classification_Operation LIKE ? OR Cout LIKE ? OR Description LIKE ? OR Categorie LIKE ? OR Type LIKE ? OR reno_avant LIKE ? OR reno_apres LIKE ? OR Annee_Coeur_av_tvx LIKE ? OR Annee_reno_coeur LIKE ? OR Annee LIKE ? OR Semestre LIKE ?");
  $sql->execute(array('%'.$query.'%', '%'.$query.'%', '%'.$query.'%', '%'.$query.'%', '%'.$query.'%', '%'.$query.'%', '%'.$query.'%', '%'.$query.'%', '%'.$query.'%', '%'.$query.'%', '%'.$query.'%', '%'.$query.'%', '%'.$query.'%', '%'.$query.'%', '%'.$query.'%', '%'.$query.'%', '%'.$query.'%', '%'.$query.'%'));


  
  $count = $sql->rowCount();
  
  if($count >= 1 ){

      echo "<div class='count'>$count résultat(s) trouvé(s) pour <strong>$query</strong><hr/></div>";
      echo '<div class="container"> <div class="table-responsive">
      
      <table class="table table-bordered" style="border-color:black;"><thead class="thead-dark">
      <tbody>
      
            <tr class="table-dark">
            

              <!--<th scope="col">ID</th>-->
              <th scope="col">Numero DECLIC</th>
              <th scope="col">Classement DL</th>
              <th scope="col">Priorite DECLIC</th>
              <th scope="col">Site</th>
              <th scope="col">Trigramme</th>
              <th scope="col">Classification Site</th>
              <th scope="col">Clients</th>
              <th scope="col">Classification Operation</th>
              <th scope="col">Cout</th>
              <th scope="col">Description</th>
              <th scope="col">Categorie</th>
              <th scope="col">Type</th>
              <th scope="col">Reno_avant</th>
              <th scope="col">Reno_apres</th>
              <th scope="col">Annee Coeur av tvx</th>
              <th scope="col">Annee reno coeur</th>
              <th scope="col">Annee</th>
              <th scope="col">Semestre</th>
            </tr>
            </tbody>
          </thead>
          </div>
          </div>';
      while($data = $sql->fetch(PDO::FETCH_OBJ)){
          
          echo '
          
            <tr class="table-active">
              <!--<th class="table-dark"scope="row">'.$data->ID.'</th>-->
              <td >'.$data->Numero_DECLIC.'</td>
              <td >'.$data->Classement_DL.'</td>
              <td >'.$data->Priorite_DECLIC.'</td>
              <td >'.$data->Site.'</td>
              <td >'.$data->Trigramme.'</td>
              <td >'.$data->Classification_Site.'</td>
              <td >'.$data->clients.'</td>
              <td >'.$data->Classification_Operation	.'</td>
              <td >'.$data->Cout.'</td>
              <td >'.$data->Description.'</td>
              <td >'.$data->Categorie.'</td>
              <td >'.$data->Type.'</td>
              <td >'.$data->reno_avant.'</td>
              <td >'.$data->reno_apres.'</td>
              <td >'.$data->Annee_Coeur_av_tvx	.'</td>
              <td >'.$data->Annee_reno_coeur.'</td>
              <td >'.$data->Annee.'</td>
              <td >'.$data->Semestre.'</td>
            </tr> ';
      }
  }else  {

    echo "0 résultat trouvé pour <strong>$query</strong><hr/>";

}
}

else if($_POST['filtre'] == "modip finis inférieur à"){
  $sql =$db->prepare("SELECT * FROM modip_finis WHERE Cout <= $query");
  $sql->execute(array());
  $count = $sql->rowCount();
  
  if($count >= 1 ){

      echo "<div class='count'>$count coût(s) inférieur(s) ou égale(s) à <strong>$query</strong>€<hr/></div>";
      echo '<div class="container"> <div class="table-responsive">
      
      <table class="table table-bordered" style="border-color:black;"><thead class="thead-dark">
      <tbody>
      
            <tr class="table-dark">
            

              <!--<th scope="col">ID</th>-->
              <th scope="col">Numero DECLIC</th>
              <th scope="col">Classement DL</th>
              <th scope="col">Priorite DECLIC</th>
              <th scope="col">Site</th>
              <th scope="col">Trigramme</th>
              <th scope="col">Classification Site</th>
              <th scope="col">Clients</th>
              <th scope="col">Classification Operation</th>
              <th scope="col">Cout</th>
              <th scope="col">Description</th>
              <th scope="col">Categorie</th>
              <th scope="col">Type</th>
              <th scope="col">Reno_avant</th>
              <th scope="col">Reno_apres</th>
              <th scope="col">Annee Coeur av tvx</th>
              <th scope="col">Annee reno coeur</th>
              <th scope="col">Annee</th>
              <th scope="col">Semestre</th>
            </tr>
            </tbody>
          </thead>
          </div>
          </div>';
      while($data = $sql->fetch(PDO::FETCH_OBJ)){
          
          echo '
          
            <tr class="table-active">
              <!--<th class="table-dark"scope="row">'.$data->ID.'</th>-->
              <td >'.$data->Numero_DECLIC.'</td>
              <td >'.$data->Classement_DL.'</td>
              <td >'.$data->Priorite_DECLIC.'</td>
              <td >'.$data->Site.'</td>
              <td >'.$data->Trigramme.'</td>
              <td >'.$data->Classification_Site.'</td>
              <td >'.$data->clients.'</td>
              <td >'.$data->Classification_Operation	.'</td>
              <td >'.$data->Cout.'</td>
              <td >'.$data->Description.'</td>
              <td >'.$data->Categorie.'</td>
              <td >'.$data->Type.'</td>
              <td >'.$data->reno_avant.'</td>
              <td >'.$data->reno_apres.'</td>
              <td >'.$data->Annee_Coeur_av_tvx	.'</td>
              <td >'.$data->Annee_reno_coeur.'</td>
              <td >'.$data->Annee.'</td>
              <td >'.$data->Semestre.'</td>
            </tr> ';
      }
  }else  {

    echo "0 résultat trouvé pour <strong>$query</strong><hr/>";

}
}

else if($_POST['filtre'] == "modip finis supérieur à"){
  $sql =$db->prepare("SELECT * FROM modip_finis WHERE Cout >= $query");
  $sql->execute(array());
  $count = $sql->rowCount();
  
  if($count >= 1 ){

      echo "<div class='count'>$count coût(s) supérieur(s) ou égale(s) à <strong>$query</strong>€<hr/></div>";
      echo '<div class="container"> <div class="table-responsive">
      
      <table class="table table-bordered" style="border-color:black;"><thead class="thead-dark">
      <tbody>
      
            <tr class="table-dark">
            

              <!--<th scope="col">ID</th>-->
              <th scope="col">Numero DECLIC</th>
              <th scope="col">Classement DL</th>
              <th scope="col">Priorite DECLIC</th>
              <th scope="col">Site</th>
              <th scope="col">Trigramme</th>
              <th scope="col">Classification Site</th>
              <th scope="col">Clients</th>
              <th scope="col">Classification Operation</th>
              <th scope="col">Cout</th>
              <th scope="col">Description</th>
              <th scope="col">Categorie</th>
              <th scope="col">Type</th>
              <th scope="col">Reno_avant</th>
              <th scope="col">Reno_apres</th>
              <th scope="col">Annee Coeur av tvx</th>
              <th scope="col">Annee reno coeur</th>
              <th scope="col">Annee</th>
              <th scope="col">Semestre</th>
            </tr>
            </tbody>
          </thead>
          </div>
          </div>';
      while($data = $sql->fetch(PDO::FETCH_OBJ)){
          
          echo '
          
            <tr class="table-active">
              <!--<th class="table-dark"scope="row">'.$data->ID.'</th>-->
              <td >'.$data->Numero_DECLIC.'</td>
              <td >'.$data->Classement_DL.'</td>
              <td >'.$data->Priorite_DECLIC.'</td>
              <td >'.$data->Site.'</td>
              <td >'.$data->Trigramme.'</td>
              <td >'.$data->Classification_Site.'</td>
              <td >'.$data->clients.'</td>
              <td >'.$data->Classification_Operation	.'</td>
              <td >'.$data->Cout.'</td>
              <td >'.$data->Description.'</td>
              <td >'.$data->Categorie.'</td>
              <td >'.$data->Type.'</td>
              <td >'.$data->reno_avant.'</td>
              <td >'.$data->reno_apres.'</td>
              <td >'.$data->Annee_Coeur_av_tvx	.'</td>
              <td >'.$data->Annee_reno_coeur.'</td>
              <td >'.$data->Annee.'</td>
              <td >'.$data->Semestre.'</td>
            </tr> ';
      }
  }else  {

    echo "0 résultat trouvé pour <strong>$query</strong><hr/>";

}
}

else if($_POST['filtre'] == "modip finis datant d'avant ou de"){
  $sql =$db->prepare("SELECT * FROM modip_finis WHERE Annee <= $query");
  $sql->execute(array());
  $count = $sql->rowCount();
  
  if($count >= 1 ){

      echo "<div class='count'>$count modip finis pour l'année <strong>$query</strong> ou avant <hr/></div>";
      echo '<div class="container"> <div class="table-responsive">
      
      <table class="table table-bordered" style="border-color:black;"><thead class="thead-dark">
      <tbody>
      
            <tr class="table-dark">
            

              <!--<th scope="col">ID</th>-->
              <th scope="col">Numero DECLIC</th>
              <th scope="col">Classement DL</th>
              <th scope="col">Priorite DECLIC</th>
              <th scope="col">Site</th>
              <th scope="col">Trigramme</th>
              <th scope="col">Classification Site</th>
              <th scope="col">Clients</th>
              <th scope="col">Classification Operation</th>
              <th scope="col">Cout</th>
              <th scope="col">Description</th>
              <th scope="col">Categorie</th>
              <th scope="col">Type</th>
              <th scope="col">Reno_avant</th>
              <th scope="col">Reno_apres</th>
              <th scope="col">Annee Coeur av tvx</th>
              <th scope="col">Annee reno coeur</th>
              <th scope="col">Annee</th>
              <th scope="col">Semestre</th>
            </tr>
            </tbody>
          </thead>
          </div>
          </div>';
      while($data = $sql->fetch(PDO::FETCH_OBJ)){
          
          echo '
          
            <tr class="table-active">
              <!--<th class="table-dark"scope="row">'.$data->ID.'</th>-->
              <td >'.$data->Numero_DECLIC.'</td>
              <td >'.$data->Classement_DL.'</td>
              <td >'.$data->Priorite_DECLIC.'</td>
              <td >'.$data->Site.'</td>
              <td >'.$data->Trigramme.'</td>
              <td >'.$data->Classification_Site.'</td>
              <td >'.$data->clients.'</td>
              <td >'.$data->Classification_Operation	.'</td>
              <td >'.$data->Cout.'</td>
              <td >'.$data->Description.'</td>
              <td >'.$data->Categorie.'</td>
              <td >'.$data->Type.'</td>
              <td >'.$data->reno_avant.'</td>
              <td >'.$data->reno_apres.'</td>
              <td >'.$data->Annee_Coeur_av_tvx	.'</td>
              <td >'.$data->Annee_reno_coeur.'</td>
              <td >'.$data->Annee.'</td>
              <td >'.$data->Semestre.'</td>
            </tr> ';
      }
  }else  {

    echo "0 résultat trouvé pour <strong>$query</strong><hr/>";

}
}

else if($_POST['filtre'] == "modip finis datant d'après ou de"){
  $sql =$db->prepare("SELECT * FROM modip_finis WHERE Annee >= $query");
  $sql->execute(array());
  $count = $sql->rowCount();
  
  if($count >= 1 ){

      echo "<div class='count'>$count modip finis pour l'année <strong>$query</strong> ou après <hr/></div>";
      echo '<div class="container"> <div class="table-responsive">
      
      <table class="table table-bordered" style="border-color:black;"><thead class="thead-dark">
      <tbody>
      
            <tr class="table-dark">
            

              <!--<th scope="col">ID</th>-->
              <th scope="col">Numero DECLIC</th>
              <th scope="col">Classement DL</th>
              <th scope="col">Priorite DECLIC</th>
              <th scope="col">Site</th>
              <th scope="col">Trigramme</th>
              <th scope="col">Classification Site</th>
              <th scope="col">Clients</th>
              <th scope="col">Classification Operation</th>
              <th scope="col">Cout</th>
              <th scope="col">Description</th>
              <th scope="col">Categorie</th>
              <th scope="col">Type</th>
              <th scope="col">Reno_avant</th>
              <th scope="col">Reno_apres</th>
              <th scope="col">Annee Coeur av tvx</th>
              <th scope="col">Annee reno coeur</th>
              <th scope="col">Annee</th>
              <th scope="col">Semestre</th>
            </tr>
            </tbody>
          </thead>
          </div>
          </div>';
      while($data = $sql->fetch(PDO::FETCH_OBJ)){
          
          echo '
          
            <tr class="table-active">
              <!--<th class="table-dark"scope="row">'.$data->ID.'</th>-->
              <td >'.$data->Numero_DECLIC.'</td>
              <td >'.$data->Classement_DL.'</td>
              <td >'.$data->Priorite_DECLIC.'</td>
              <td >'.$data->Site.'</td>
              <td >'.$data->Trigramme.'</td>
              <td >'.$data->Classification_Site.'</td>
              <td >'.$data->clients.'</td>
              <td >'.$data->Classification_Operation	.'</td>
              <td >'.$data->Cout.'</td>
              <td >'.$data->Description.'</td>
              <td >'.$data->Categorie.'</td>
              <td >'.$data->Type.'</td>
              <td >'.$data->reno_avant.'</td>
              <td >'.$data->reno_apres.'</td>
              <td >'.$data->Annee_Coeur_av_tvx	.'</td>
              <td >'.$data->Annee_reno_coeur.'</td>
              <td >'.$data->Annee.'</td>
              <td >'.$data->Semestre.'</td>
            </tr> ';
      }
  }else  {

    echo "0 résultat trouvé pour <strong>$query</strong><hr/>";

}
}
else if($_POST['filtre'] == "modip prévus datant d'avant ou de"){
  $sql =$db->prepare("SELECT * FROM modip WHERE Annee < $query");
  $sql->execute(array());


  
  $count = $sql->rowCount();
  
  if($count >= 1 ){

      echo "<div class='count'>$count modip prévus avant l'année <strong>$query</strong><hr/></div>";
      echo '<div class="container"> <div class="table-responsive">
      
      <table class="table table-bordered" style="border-color:black;"><thead class="thead-dark">
      <tbody>
      
            <tr class="table-dark">
            

              <!--<th scope="col">Id_modip</th>-->
              <th scope="col">Numero DECLIC</th>
              <th scope="col">Classement DL</th>
              <th scope="col">Priorite DECLIC</th>
              <th scope="col">Site</th>
              <th scope="col">Trigramme</th>
              <th scope="col">Classification Site</th>
              <th scope="col">Clients</th>
              <th scope="col">Classification Operation</th>
              <th scope="col">Cout</th>
              <th scope="col">Description</th>
              <th scope="col">Categorie</th>
              <th scope="col">Type</th>
              <th scope="col">Reno_avant</th>
              <th scope="col">Reno_apres</th>
              <th scope="col">Annee Coeur av tvx</th>
              <th scope="col">Annee reno coeur</th>
              <th scope="col">Annee</th>
              <th scope="col">Semestre</th>
            </tr>
            </tbody>
          </thead>
          </div>
          </div>';
      while($data = $sql->fetch(PDO::FETCH_OBJ)){
          
          echo '
          
            <tr class="table-active">
              <!--<th class="table-dark"scope="row">'.$data->Id_modip.'</th>-->
              <td >'.$data->Numero_DECLIC.'</td>
              <td >'.$data->Classement_DL.'</td>
              <td >'.$data->Priorite_DECLIC.'</td>
              <td >'.$data->Site.'</td>
              <td >'.$data->Trigramme.'</td>
              <td >'.$data->Classification_Site.'</td>
              <td >'.$data->clients.'</td>
              <td >'.$data->Classification_Operation	.'</td>
              <td >'.$data->Cout.'</td>
              <td >'.$data->Description.'</td>
              <td >'.$data->Categorie.'</td>
              <td >'.$data->Type.'</td>
              <td >'.$data->reno_avant.'</td>
              <td >'.$data->reno_apres.'</td>
              <td >'.$data->Annee_Coeur_av_tvx	.'</td>
              <td >'.$data->Annee_reno_coeur.'</td>
              <td >'.$data->Annee.'</td>
              <td >'.$data->Semestre.'</td>
            </tr> ';
      }
  }else  {

    echo "0 résultat trouvé pour <strong>$query</strong><hr/>";

}
}

else if($_POST['filtre'] == "modip prévus datant d'après ou de"){
  $sql =$db->prepare("SELECT * FROM modip WHERE Annee > $query");
  $sql->execute(array());


  
  $count = $sql->rowCount();
  
  if($count >= 1 ){

      echo "<div class='count'>$count modip prévus après l'année <strong>$query</strong><hr/></div>";
      echo '<div class="container"> <div class="table-responsive">
      
      <table class="table table-bordered" style="border-color:black;"><thead class="thead-dark">
      <tbody>
      
            <tr class="table-dark">
            

              <!--<th scope="col">Id_modip</th>-->
              <th scope="col">Numero DECLIC</th>
              <th scope="col">Classement DL</th>
              <th scope="col">Priorite DECLIC</th>
              <th scope="col">Site</th>
              <th scope="col">Trigramme</th>
              <th scope="col">Classification Site</th>
              <th scope="col">Clients</th>
              <th scope="col">Classification Operation</th>
              <th scope="col">Cout</th>
              <th scope="col">Description</th>
              <th scope="col">Categorie</th>
              <th scope="col">Type</th>
              <th scope="col">Reno_avant</th>
              <th scope="col">Reno_apres</th>
              <th scope="col">Annee Coeur av tvx</th>
              <th scope="col">Annee reno coeur</th>
              <th scope="col">Annee</th>
              <th scope="col">Semestre</th>
            </tr>
            </tbody>
          </thead>
          </div>
          </div>';
      while($data = $sql->fetch(PDO::FETCH_OBJ)){
          
          echo '
          
            <tr class="table-active">
              <!--<th class="table-dark"scope="row">'.$data->Id_modip.'</th>-->
              <td >'.$data->Numero_DECLIC.'</td>
              <td >'.$data->Classement_DL.'</td>
              <td >'.$data->Priorite_DECLIC.'</td>
              <td >'.$data->Site.'</td>
              <td >'.$data->Trigramme.'</td>
              <td >'.$data->Classification_Site.'</td>
              <td >'.$data->clients.'</td>
              <td >'.$data->Classification_Operation	.'</td>
              <td >'.$data->Cout.'</td>
              <td >'.$data->Description.'</td>
              <td >'.$data->Categorie.'</td>
              <td >'.$data->Type.'</td>
              <td >'.$data->reno_avant.'</td>
              <td >'.$data->reno_apres.'</td>
              <td >'.$data->Annee_Coeur_av_tvx	.'</td>
              <td >'.$data->Annee_reno_coeur.'</td>
              <td >'.$data->Annee.'</td>
              <td >'.$data->Semestre.'</td>
            </tr> ';
      }
  }else  {

    echo "0 résultat trouvé pour <strong>$query</strong><hr/>";

}
}

    }
       
  



?> 