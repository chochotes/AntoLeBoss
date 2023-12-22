<?php

$_SESSION['title'] = "Promotion admin - ".NOMSITE;
$_SESSION['name_page'] = "Promotion";

$Tools->log_account_admin();

if(isset($_GET['action']) && $_GET['action']=="add"){
    if(isset($_POST['nom']) && $_POST['nom']!=""){
        $values = [];
        if(isset($_POST['nom'])) $values += ['nom' => $Tools->data_secure($_POST['nom'])];
        if(isset($_POST['date_debut'])) $values += ['date_debut' => $Tools->data_secure($_POST['date_debut'])];
        if(isset($_POST['date_fin'])) $values += ['date_fin' => $Tools->data_secure($_POST['date_fin'])];
        if(isset($_POST['code'])) $values += ['code' => $Tools->data_secure($_POST['code'])];
        if(isset($_POST['remise'])) $values += ['remise' => $Tools->data_secure($_POST['remise'])];
        if(isset($_POST['type'])) $values += ['type' => $Tools->data_secure($_POST['type'])];
        if(isset($_POST['id_produit'])) $values += ['id_produit' => $Tools->data_secure($_POST['id_produit'])];
        if(isset($_POST['id_categorie'])) $values += ['id_categorie' => $Tools->data_secure($_POST['id_categorie'])];
        if(isset($_POST['statut'])) $values += ['statut' => $Tools->data_secure($_POST['statut'])];
        
        if(isset($_POST['nouveau_prix']) && $_POST['nouveau_prix']) $values += ['nouveau_prix' => $Tools->data_secure($_POST['nouveau_prix'])];
        else $values += ['nouveau_prix' => NULL];
        if(isset($_POST['frais_de_port']) && $_POST['frais_de_port']) $values += ['frais_de_port' => $Tools->data_secure($_POST['frais_de_port'])];
        else $values += ['frais_de_port' => NULL];
        if(isset($_POST['prix_min']) && $_POST['prix_min']) $values += ['prix_min' => $Tools->data_secure($_POST['prix_min'])];
        else $values += ['prix_min' => NULL];
        if(isset($_POST['quantite_min']) && $_POST['quantite_min']) $values += ['quantite_min' => $Tools->data_secure($_POST['quantite_min'])];
        else $values += ['quantite_min' => NULL];
        if(isset($_POST['maximum']) && $_POST['maximum']) $values += ['maximum' => $Tools->data_secure($_POST['maximum'])];
        else $values += ['maximum' => NULL];
                
        
        if(isset($_GET['id']) && $_GET['id'] != "0" && $_GET['id'] != ""){
            $id = $_GET['id'];
            if(set_update("produit_promotion", $values, "id='$id'", 1)){
                $Admin->addEditionHistoric("produit_promotion", $id, "modification", 1);
                $_SESSION['error_message'] = "La promotion vient d'être modifié avec succés.";
                $_SESSION['error_color'] = "success";
            }else{
                $Admin->addEditionHistoric("produit_promotion", $id, "modification", 0);
                $_SESSION['error_message'] = "La promotion n'a pas pu être modifié.";
                $_SESSION['error_color'] = "danger";
            }
        }else{
            if(set_insert("produit_promotion", $values, 1, 1)){
                $Admin->addEditionHistoric("produit_promotion", $_SESSION['lastInsertId'], "ajout", 1);
                unset($_SESSION['lastInsertId']);
                $_SESSION['error_message'] = "La promotion vient d'être ajouté avec succés.";
                $_SESSION['error_color'] = "success";
            }else{
                $Admin->addEditionHistoric("produit_promotion", "", "ajout", 0);
                $_SESSION['error_message'] = "La promotion n'a pas pu être ajouté.";
                $_SESSION['error_color'] = "danger";
            }
        }
    }
}elseif(isset($_GET['action']) && $_GET['action']=="delete"){
    if(set_delete("produit_promotion", "id='".$_GET["id"]."'", 1)){
        $_SESSION['error_message'] = "La promotion vient d'être supprimé avec succés.";
        $_SESSION['error_color'] = "success";
    }else{
        $_SESSION['error_message'] = "La promotion n'a pas pu être supprimé.";
        $_SESSION['error_color'] = "danger";
    }
}

get_head();
get_header();

$lstPromotion = $Produit->getLstPromotion();
?>

<div class="card-body">
    <div class="row">
        <div class="col-md-8 col-sm-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Liste</h6>
                </div>
                <div class="table-responsive p-2">
                    <table class="table table-bordered table-edit" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nom</th>
                                <th>Remise</th>
                                <th>Frais de port</th>
                                <th>Quantité minimale</th>
                                <th>Code</th>
                                <th>Statut</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($lstPromotion as $data){ ?>
                            <tr onclick="show_data_edit('<?=URLADMIN?>', 'produit', 'promotion-edit', '<?=$data['id']?>')" title="Identifiant: <?=$data['id']?>">
                                <th><?=$data['id']?></th>
                                <th><?=$data['nom']?></th>
                                <th><?=$data['remise'].' '.$data['type']?></th>
                                <th><?=$data['frais_de_port']?></th>
                                <th><?=$data['quantite_min']?></th>
                                <th><?=$data['code']?></th>
                                <th><?=$data['statut']?></th>
                                <th><i class="fas fa-times" onclick="showDeleteModal('produit/promotion-delete-<?=$data['id']?>/')"></th>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="card shadow mb-4" id="card-edit">
                <div class="text-center">
                    <a href="produit/promotion-edit-0/" class="m-5 btn btn-primary">Ajouter</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>