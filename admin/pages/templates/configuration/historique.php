<?php

$_SESSION['title'] = "Historique admin - ".NOMSITE;
$_SESSION['name_page'] = "Historique";

$Tools->log_account_admin();

get_head();
get_header();

$lstHistorique = $Admin->getLstEditionHistorique(null, " id DESC", "30");

?>

<div class="card-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Liste</h6>
                </div>
                <div class="table-responsive p-2">
                    <table class="table table-bordered table-edit" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Table</th>
                                <th>Id conçerné</th>
                                <th>Action</th>
                                <th>Statut</th>
                                <th>Utilisateur</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($lstHistorique as $data){ 
                                $userData = $Client->getClient("id='".$data['id_user']."'");
                                
                            ?>
                            <tr>
                                <th><?=$data['id']?></th>
                                <th><?=$data['table_name']?></th>
                                <th>
                                    <?=$data['table_id']?>
                                    <?php
                                    if($data['table_name'] == "produit"){
                                        echo ' - '.$Produit->getProduit("id='".$data['table_id']."'")['nom'];
                                    }
                                    if($data['table_name'] == "client"){
                                        echo ' - '.$Client->getClient("id='".$data['table_id']."'")['email'];
                                    }
                                    if($data['table_name'] == "gestion_projet"){
                                        echo ' - '.$Tools->text_cut($Gestionprojet->getGestionProjet("id='".$data['table_id']."'")['titre'], 20, true);
                                    }
                                    ?>
                                </th>
                                <th><?=$data['action']?></th>
                                <th><?=$data['statut']?></th>
                                <th><?=$userData['first_name']." ".$userData['last_name']?></th>
                                <th><?=$Tools->convert_date_to_print($data['date_modification'], 1)?></th>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>