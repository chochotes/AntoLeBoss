<?php

$_SESSION['title'] = "Accueil administrateur - ".NOMSITE;
$_SESSION['name_page'] = "Accueil";

$Tools->log_account_admin();

$_SESSION['adminId'] = "";
$_SESSION['adminNom'] = "";
$_SESSION['adminPrenom'] = "";
$_SESSION['adminEmail'] = "";
$_SESSION['droit'] = "";
get_head();
$Tools->redirection(URLSITEWEB);
?>