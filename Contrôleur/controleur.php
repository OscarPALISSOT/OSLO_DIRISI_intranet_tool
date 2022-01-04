<?php

include_once 'Modèle/modele.php';
require_once("Modèle/auth.php");

function listesites($Bdd){
	return sites($Bdd);
}

function pageinfos($Trigramme){
	if(strlen($Trigramme) == 3){
		return infosquartier(htmlspecialchars(strtoupper($Trigramme)));
	} else {
		echo '<div class="container">Vérifier le trigramme de ce site</div>';
	}
}

function listeorganismes($Trigramme){
	if(strlen($Trigramme) == 3){
		return organismes(htmlspecialchars(strtoupper($Trigramme)));
	} else {
		echo '<div class="container">Mauvais trigramme</div>';
	}
}

function listeorganisme(){
		return selectorganismes();
}

function listemasterID(){
		return selectMasterID();
}

function listeaccess(){
		return selectIDAccess();
}


function tableauopera($Trigramme){
	if(strlen($Trigramme) == 3){
		return opera(htmlspecialchars(strtoupper($Trigramme)));
	} else {
		echo '<div class="container">Mauvais trigramme</div>';
	}
}

function tableaumodip($Trigramme){
	if(strlen($Trigramme) == 3){
		return modip(htmlspecialchars(strtoupper($Trigramme)));
	} else {
		echo '<div class="container">Mauvais trigramme</div>';
	}
}

function tableaumim3($Trigramme){
	if(strlen($Trigramme) == 3){
		return mim3(htmlspecialchars(strtoupper($Trigramme)));
	} else {
		echo '<div class="container">Mauvais trigramme</div>';
	}
}


function organisme($organisme){
	global $query;
	if(is_numeric($organisme) && strlen($query["trigramme"]) == 3){
		return nomorganisme(htmlspecialchars($organisme));
	} else {
		echo '<div class="container">Mauvais organisme</div>';
	}
}

function export($Bdd){
    return listeexport($Bdd);
}


function routeur($Trigramme){
	global $query;
	if(strlen($Trigramme) == 3){
		return rfz(htmlspecialchars(strtoupper($Trigramme)));
	} else {
		echo '<div class="container">Mauvais trigramme</div>';
	}
}


/*function tableaumim3v2($Trigramme){
	if(strlen($Trigramme) == 3){
		return mim3v2(htmlspecialchars(strtoupper($Trigramme)));
	} else {
		echo '<div class="container">Mauvais trigramme</div>';
	}
}*/

function tableaubnrv3($Trigramme){
	if(strlen($Trigramme) == 3){
		return bnrv3(htmlspecialchars(strtoupper($Trigramme)));
	} else {
		echo '<div class="container">Mauvais trigramme</div>';
	}
}

function tableaubnrv4($organisme){
	global $query;
	if(is_numeric($organisme) && strlen($query["trigramme"]) == 3){
		return bnrv4(htmlspecialchars($organisme),htmlspecialchars($query["trigramme"]));
	} else {
		echo '<div class="container">Mauvais organisme</div>';
	}
}

function tableaumim3v2($organisme){
	global $query;
	if(is_numeric($organisme) && strlen($query["trigramme"]) == 3){
		return mim3v2(htmlspecialchars($organisme),htmlspecialchars($query["trigramme"]));
	} else {
		echo '<div class="container">Mauvais organisme</div>';
	}
}