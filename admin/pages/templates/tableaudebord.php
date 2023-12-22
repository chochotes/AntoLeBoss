<?php

$_SESSION['title'] = "Tableau de bord admin - ".NOMSITE;
$_SESSION['name_page'] = "Tableau de bord";

$Tools->log_account_admin("administrator");
get_head();
get_header();

get_footer();
    
?>
