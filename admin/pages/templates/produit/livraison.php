<?php

$_SESSION['title'] = "Livraison admin - ".NOMSITE;
$_SESSION['name_page'] = "Livraison";
$Tools->log_account_admin("administrator");

if(isset($_GET['action']) && $_GET['action']=="save"){
    if(isset($_POST['id_entreprise']) && $_POST['id_entreprise']){
        $values= array(
            "id_entreprise" => $Tools->data_secure($_POST['id_entreprise']),
            "poids_max" => $Tools->data_secure($_POST['poids_max']),
            "prix" => $Tools->data_secure($_POST['prix'])
        );

        if(isset($_GET['id']) && $_GET['id'] != "0" && $_GET['id'] != "")
        {
            $id = $_GET['id'];
            if(set_update("livraison", $values, "id='$id'", 1)){
                $Admin->addEditionHistoric("livraison", $_GET["id"], "modification", 1);
                $_SESSION['error_message'] = "La livraison vient d'être modifiée avec succés.";
                $_SESSION['error_color'] = "success";
            }else{
                $Admin->addEditionHistoric("livraison", $_GET["id"], "modification", 0);
                $_SESSION['error_message'] = "La livraison n'a pas pu être modifiée.";
                $_SESSION['error_color'] = "danger";
            }
        }else{
            if(set_insert("livraison", $values, 1, 1)){
                $Admin->addEditionHistoric("livraison", $_SESSION['lastInsertId'], "ajout", 1);
                unset($_SESSION['lastInsertId']);
                $_SESSION['error_message'] = "La livraison vient d'être ajoutée avec succés.";
                $_SESSION['error_color'] = "success";
            }else{
                $Admin->addEditionHistoric("livraison", "", "ajout", 0);
                $_SESSION['error_message'] = "La livraison n'a pas pu être ajoutée.";
                $_SESSION['error_color'] = "danger";
            }
        }
    }
}elseif(isset($_GET['action']) && $_GET['action']=="delete"){
    if(set_delete("livraison", "id='".$_GET["id"]."'", 1)){
        $Admin->addEditionHistoric("livraison", $_GET["id"], "delete", 1);
        $_SESSION['error_message'] = "La livraison vient d'être supprimée avec succés.";
        $_SESSION['error_color'] = "success";
    }else{
        $Admin->addEditionHistoric("livraison", $_GET["id"], "delete", 0);
        $_SESSION['error_message'] = "La livraison n'a pas pu être supprimée.";
        $_SESSION['error_color'] = "danger";
    }
}

get_head();
get_header();

$lstLivraison = $Produit->getLstLivraison();
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
                                <th>Entreprise</th>
                                <th>Poids max</th>
                                <th>Prix</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($lstLivraison as $data){ ?>
                            <tr onclick="show_data_edit('<?=URLADMIN?>', 'produit', 'livraison-edit', '<?=$data['id']?>')" title="Identifiant: <?=$data['id']?>">
                                <th><?=$data['id']?></th>
                                <th><?=$data['id_entreprise']?></th>
                                <th><?=$data['poids_max']?></th>
                                <th><?=$data['prix']?></th>
                                <th><i class="fas fa-times" onclick="showDeleteModal('produit/livraison-delete-<?=$data['id']?>/')"></th>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="card shadow mb-4" id="card-edit">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Ajouter</h6>
                </div>
                <div class="card-body">
                    <form action="produit/livraison-save-0/" method="POST">
                        <h5 class="mt-3">Entreprise</h5>
                        <input type="text" name="id_entreprise" class="form-control bg-light border-1 small" required>
                        <h5 class="mt-3">Poids max</h5>
                        <input type="text" name="poids_max" class="form-control bg-light border-1 small" required>
                        <h5 class="mt-3">Prix</h5>
                        <input type="text" name="prix" class="form-control bg-light border-1 small" required>
                        <div class="text-center">
                            <input type="submit" name="add" value="Ajouter" class="mt-3 btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>