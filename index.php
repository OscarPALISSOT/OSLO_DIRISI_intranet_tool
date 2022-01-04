<?php 
session_start();
parse_str(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY), $query);
global $query;
include_once 'Contrôleur/controleur.php'; 


$request =  parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
//var_dump($request);


switch ($request) {
    
    case'/login':
        require "Vue/authentification.php";
        break;

    case'/logout':
        require "Vue/logout.php";
        break;

    case '/' :
            require 'Vue/accueil.php';
            break;

    case '/quartiers' :
        require 'Vue/quartiers.php';
        break;

    case '/organisme' :
        require 'Vue/organisme.php';
        break;

    case '/recherche' :
        require 'Vue/recherche.php';
        break;

    case '/export' :
        require 'Vue/exportBDD.php';
        break;
    
    case '/BPT':
        require 'Vue/BPT.php';
        break;

    case '/BCS':
        require 'Vue/BCS.php';
        break;

    case '/BRC':
        require 'Vue/BRC.php';
        break;

    case '/contact':
        require 'Vue/contact.php';
        break;

    case '/contactprincipal':
        require 'Vue/contactprincipal.php';
        break;

    case '/contactBdD': 
        require 'Vue/contactBdD.php';
        break;
    
    case '/contactADS':
        require 'Vue/contactADS.php';
        break;
    
    case '/contactLille':
        require 'Vue/contactLille.php';
        break;

    case '/contactMetz':
        require 'Vue/contactMetz.php';
        break;

    case '/contactNancy':
        require 'Vue/contactNancy.php';
        break;

    case '/contactStrasbourg':
        require 'Vue/contactStrasbourg.php';
        break;

    case '/contactDizier':
        require 'Vue/contactDizier.php';
        break;

    case '/contactBesancon':
        require 'Vue/contactBesancon.php';
        break;

    case '/contactMourmelon':
        require 'Vue/contactMourmelon.php';
        break;

    case '/contactMetzDirisi':
        require 'Vue/contactMetzDirisi.php';
        break;

    case '/LilleBNR': 
        require 'Vue/LilleBNR.php';
        break;

    case '/MetzBNR': 
        require 'Vue/MetzBNR.php';
        break;

    case '/MourmelonBNR': 
        require 'Vue/MourmelonBNR.php';
        break;

    case '/StrasbourgBNR': 
        require 'Vue/StrasbourgBNR.php';
        break;

    case '/NancyBNR': 
        require 'Vue/NancyBNR.php';
        break;

    case '/DizierBNR': 
        require 'Vue/DizierBNR.php';
        break;

    case '/BesanconBNR': 
        require 'Vue/BesanconBNR.php';
        break;

    case '/BelfortBdD':
        require 'Vue/BelfortBdD.php';
        break;
        
    case '/BesanconBdD':
        require 'Vue/BesanconBdD.php';
        break;

    case '/CharlevilleBdD':
        require 'Vue/CharlevilleBdD.php';
        break;

    case '/LilleBdD':
        require 'Vue/LilleBdD.php';
        break;
                    
    case '/LuxeuilBdD':
        require 'Vue/LuxeuilBdD.php';
        break;
                        
    case '/MetzBdD':
        require 'Vue/MetzBdD.php';
        break;
                            
    case '/MourmelonBdD':
        require 'Vue/MourmelontBdD.php';
        break;
                                
    case '/NancyBdD':
        require 'Vue/NancyBdD.php';
        break;
                                    
    case '/PhalsbourgBdD':
        require 'Vue/PhalsbourgBdD.php';
        break;

    case '/DizierBdD':
        require 'Vue/DizierBdD.php';
        break;

    case '/VerdunBdD':
        require 'Vue/VerdunBdD.php';
        break;

    case '/StrasbourgBdD':
        require 'Vue/StrasbourgBdD.php';
        break;

    case '/DirisiADS':
        require 'Vue/DirisiADS.php';
        break;

    case '/MarineADS':
        require 'Vue/MarineADS.php';
        break;

    case '/DGAADS':
        require 'Vue/DGAADS.php';
        break;

    case '/OIAADS':
        require 'Vue/OIAADS.php';
        break;

    case '/RattacheADS':
        require 'Vue/RattacheADS.php';
        break;

    case '/EMAADS':
        require 'Vue/EMAADS.php';
        break;

    case '/SEAADS':
        require 'Vue/SEAADS.php';
        break;

    case '/AAEADS':
        require 'Vue/AAEADS.php';
        break;

    case '/SCAADS':
        require 'Vue/SCAADS.php';
        break;

    case '/SSAADS':
        require 'Vue/SSAADS.php';
        break;

    case '/SGAADS':
        require 'Vue/SGAADS.php';
        break;

    case '/TerreADS':
        require 'Vue/TerreADS.php';
        break;


        default:
        // http_response_code(404);
        require 'Vue/Erreurs/404.php';
        break;
}


