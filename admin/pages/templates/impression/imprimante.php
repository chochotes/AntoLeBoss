<?php

$_SESSION['title'] = "Imprimante admin - ".NOMSITE;
$_SESSION['name_page'] = "Imprimante";
$Tools->log_account_admin("administrator");

if(isset($_GET['action']) && $_GET['action']=="save"){
    if(isset($_POST['nom']) && isset($_POST['designation']) && $_POST['nom']!="" && $_POST['designation']){
        
        $values = [];
        if(isset($_POST['nom'])) $values += ['nom' => $Tools->data_secure($_POST['nom'])];
        if(isset($_POST['designation'])) $values += ['designation' => $Tools->data_secure($_POST['designation'])];
        if(isset($_POST['statut'])) $values += ['statut' => $Tools->data_secure($_POST['statut'])];
        if(isset($_POST['position'])) $values += ['position' => $Tools->data_secure($_POST['position'])];
        
        if(isset($_GET['id']) && $_GET['id'] != "0" && $_GET['id'] != "")
        {
            $id = $_GET['id'];
            if(set_update("imprimante", $values, "id='$id'", 1)){
                $Admin->addEditionHistoric("imprimante", $_GET["id"], "modification", 1);
                $_SESSION['error_message'] = "L'imprimante vient d'être modifié avec succés.";
                $_SESSION['error_color'] = "success";
            }else{
                $Admin->addEditionHistoric("imprimante", $_GET["id"], "modification", 0);
                $_SESSION['error_message'] = "L'imprimante n'a pas pu être modifié.";
                $_SESSION['error_color'] = "danger";
            }
        }else{
            if(set_insert("imprimante", $values, 1, 1)){
                $Admin->addEditionHistoric("imprimante", $_SESSION['lastInsertId'], "ajout", 1);
                unset($_SESSION['lastInsertId']);
                $_SESSION['error_message'] = "L'imprimante vient d'être ajouté avec succés.";
                $_SESSION['error_color'] = "success";
            }else{
                $Admin->addEditionHistoric("imprimante", "", "ajout", 0);
                $_SESSION['error_message'] = "L'imprimante n'a pas pu être ajouté.";
                $_SESSION['error_color'] = "danger";
            }
        }
    }
}elseif(isset($_GET['action']) && $_GET['action']=="delete"){
    if(set_delete("imprimante", "id='".$_GET["id"]."'", 1)){
        $Admin->addEditionHistoric("imprimante", $_GET["id"], "delete", 1);
        $_SESSION['error_message'] = "L'imprimante vient d'être supprimé avec succés.";
        $_SESSION['error_color'] = "success";
    }else{
        $Admin->addEditionHistoric("imprimante", $_GET["id"], "delete", 0);
        $_SESSION['error_message'] = "L'imprimante n'a pas pu être supprimé.";
        $_SESSION['error_color'] = "danger";
    }
}

get_head();
get_header();

$lstImprimante = $Imprimante->getLstImprimante();
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
                                <th>Désignation</th>
                                <th>Statut</th>
                                <th>Position</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($lstImprimante as $data){ ?>
                            <tr onclick="show_data_edit('<?=URLADMIN?>', 'impression', 'imprimante-edit', '<?=$data['id']?>')" title="Identifiant: <?=$data['id']?>">
                                <th><?=$data['id']?></th>
                                <th><?=$data['nom']?></th>
                                <th><?=$data['designation']?></th>
                                <th>
                                    <?php
                                        if($data['statut'] == 0) echo "Hors service";
                                        elseif($data['statut'] == 1) echo "Utilisable";
                                        else echo "Visible";
                                    ?>
                                </th>
                                <th><?=$data['position']?></th>
                                <th><i class="fas fa-times" onclick="showDeleteModal('impression/imprimante-delete-<?=$data['id']?>/')"></th>
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
                    <form action="impression/imprimante-save-0/" method="POST">
                        <h5 class="mt-3">Nom</h5>
                        <input type="text" name="nom" class="form-control bg-light border-1 small" required>
                        <h5 class="mt-3">Désignation</h5>
                        <input type="text" name="designation" class="form-control bg-light border-1 small" required>
                        <h5 class="mt-3">Statut</h5>
                        <select name="statut" class="form-control bg-light border-1 small">
                            <option value="1">Utilisable</option>
                            <option value="0">Hors service</option>
                            <option value="2">Visible</option>
                        </select>
                        <h5 class="mt-3">Position</h5>
                        <input type="text" name="position" class="form-control bg-light border-1 small">
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