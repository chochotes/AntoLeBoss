<?php

$_SESSION['title'] = "Tva admin - ".NOMSITE;
$_SESSION['name_page'] = "Tva";
$Tools->log_account_admin("administrator");

if(isset($_GET['action']) && $_GET['action']=="save"){
    if(isset($_POST['nom']) && $_POST['nom']){
        $values= array(
            "nom" => $Tools->data_secure($_POST['nom']),
            "taux" => $Tools->data_secure($_POST['taux']),
            "abreviation" => $Tools->data_secure($_POST['abreviation']),
            "description" => $Tools->data_secure($_POST['description'])
        );

        if(isset($_GET['id']) && $_GET['id'] != "0" && $_GET['id'] != "")
        {
            $id = $_GET['id'];
            if(set_update("produit_tva", $values, "id='$id'", 1)){
                $Admin->addEditionHistoric("produit_tva", $_GET["id"], "modification", 1);
                $_SESSION['error_message'] = "La TVA vient d'être modifiée avec succés.";
                $_SESSION['error_color'] = "success";
            }else{
                $Admin->addEditionHistoric("produit_tva", $_GET["id"], "modification", 0);
                $_SESSION['error_message'] = "La TVA n'a pas pu être modifiée.";
                $_SESSION['error_color'] = "danger";
            }
        }else{
            if(set_insert("produit_tva", $values, 1, 1)){
                $Admin->addEditionHistoric("produit_tva", $_SESSION['lastInsertId'], "ajout", 1);
                unset($_SESSION['lastInsertId']);
                $_SESSION['error_message'] = "La TVA vient d'être ajoutée avec succés.";
                $_SESSION['error_color'] = "success";
            }else{
                $Admin->addEditionHistoric("produit_tva", "", "ajout", 0);
                $_SESSION['error_message'] = "La TVA n'a pas pu être ajoutée.";
                $_SESSION['error_color'] = "danger";
            }
        }
    }
}elseif(isset($_GET['action']) && $_GET['action']=="delete"){
    if(set_delete("produit_tva", "id='".$_GET["id"]."'", 1)){
        $Admin->addEditionHistoric("produit_tva", $_GET["id"], "delete", 1);
        $_SESSION['error_message'] = "La TVA vient d'être supprimée avec succés.";
        $_SESSION['error_color'] = "success";
    }else{
        $Admin->addEditionHistoric("produit_tva", $_GET["id"], "delete", 0);
        $_SESSION['error_message'] = "La TVA n'a pas pu être supprimée.";
        $_SESSION['error_color'] = "danger";
    }
}

get_head();
get_header();

$lstTva = $Produit->getLstTva();
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
                                <th>Taux</th>
                                <th>Abréviation</th>
                                <th>Description</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($lstTva as $data){ ?>
                            <tr onclick="show_data_edit('<?=URLADMIN?>', 'produit', 'tva-edit', '<?=$data['id']?>')" title="Identifiant: <?=$data['id']?>">
                                <th><?=$data['id']?></th>
                                <th><?=$data['nom']?></th>
                                <th><?=$data['taux']?></th>
                                <th><?=$data['abreviation']?></th>
                                <th><?=$data['description']?></th>
                                <th><i class="fas fa-times" onclick="showDeleteModal('produit/tva-delete-<?=$data['id']?>/')"></th>
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
                    <form action="produit/tva-save-0/" method="POST">
                        <h5 class="mt-3">Nom</h5>
                        <input type="text" name="nom" class="form-control bg-light border-1 small" required>
                        <h5 class="mt-3">Taux</h5>
                        <input type="text" name="taux" class="form-control bg-light border-1 small" required>
                        <h5 class="mt-3">Abréviation</h5>
                        <input type="text" name="abreviation" class="form-control bg-light border-1 small" required>
                        <h5 class="mt-3">Description</h5>
                        <input type="text" name="description" class="form-control bg-light border-1 small" required>
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