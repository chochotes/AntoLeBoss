<?php

$_SESSION['title'] = "Actualités Admin - ".NOMSITE;
$_SESSION['name_page'] = "Actualité";
$Tools->redirection(URLADMIN."tableaudebord");
$Tools->log_account_admin("administrator");
get_head();
get_header();

