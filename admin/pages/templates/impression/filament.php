<?php

$_SESSION['title'] = "Filament admin - ".NOMSITE;
$_SESSION['name_page'] = "Filament";
$Tools->log_account_admin("administrator");

if(isset($_GET['action']) && $_GET['action']=="save"){
    if(isset($_POST['reference']) && isset($_POST['designation']) && $_POST['reference']!="" && $_POST['designation']){
        $values= array(
            "reference" => $Tools->data_secure($_POST['reference']),
            "fabricant" => $Tools->data_secure($_POST['fabricant']),
            "prix" => $Tools->data_secure($_POST['prix']),
            "designation" => $Tools->data_secure($_POST['designation']),
            "code_couleur" => $Tools->data_secure($_POST['code_couleur']),
            "statut" => $Tools->data_secure($_POST['statut']),
        );

        if(isset($_GET['id']) && $_GET['id'] != "0" && $_GET['id'] != "")
        {
            $id = $Tools->data_secure($_GET['id']);
            if(set_update("imprimante_filament", $values, "id='$id'", 1)){
                $Admin->addEditionHistoric("filament", $id, "modification", 1);
                $_SESSION['error_message'] = "Le filament vient d'être modifié avec succés.";
                $_SESSION['error_color'] = "success";
            }else{
                $Admin->addEditionHistoric("filament", $_GET["id"], "modification", 0);
                $_SESSION['error_message'] = "Le filament n'a pas pu être modifié.";
                $_SESSION['error_color'] = "danger";
            }
        }else{
            if(set_insert("imprimante_filament", $values, 1, 1)){
                $Admin->addEditionHistoric("filament", $_SESSION['lastInsertId'], "ajout", 1);
                unset($_SESSION['lastInsertId']);
                $_SESSION['error_message'] = "Le filament vient d'être ajouté avec succés.";
                $_SESSION['error_color'] = "success";
            }else{
                $Admin->addEditionHistoric("filament", "", "ajout", 0);
                $_SESSION['error_message'] = "Le filament n'a pas pu être ajouté.";
                $_SESSION['error_color'] = "danger";
            }
        }
    }
}elseif(isset($_GET['action']) && $_GET['action']=="delete"){
    $id = $Tools->data_secure($_GET['id']);
    if(set_delete("imprimante_filament", "id='".$id."'", 1)){
        $Admin->addEditionHistoric("filament", $id, "delete", 1);
        $_SESSION['error_message'] = "Le filament vient d'être supprimé avec succés.";
        $_SESSION['error_color'] = "success";
    }else{
        $Admin->addEditionHistoric("filament", $id, "delete", 0);
        $_SESSION['error_message'] = "Le filament n'a pas pu être supprimé.";
        $_SESSION['error_color'] = "danger";
    }
}

get_head();
get_header();

$lstFilament = $Imprimante->getFilamentsWhere();
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
                                <th>Référence</th>
                                <th>Fabricant</th>
                                <th>Prix</th>
                                <th>Couleur</th>
                                <th>Statut</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($lstFilament as $data){ ?>
                            <tr onclick="show_data_edit('<?=URLADMIN?>', 'impression', 'filament-edit', '<?=$data['id']?>')" title="Identifiant: <?=$data['id']?>">
                                <th><?=$data['reference']?></th>
                                <th><?=$data['fabricant']?></th>
                                <th><?=$data['prix']?></th>
                                <th>
                                    <?php
                                    $printColor = $data['code_couleur'];
                                    if($printColor == "255,255,255,1") $bgColor = "0,0,0,1";
                                    else $bgColor = $printColor;
                                    ?>
                                    <table class="div-table-center" id="filamentTable">
                                        <tr>
                                            <td class="p-0">
                                                <div class="div-color-center" style="background-color: rgba(<?=$data['code_couleur']?>); border: 1px solid rgba(<?=$bgColor?>);" >
                                                </div>
                                            </td>
                                            <td class="p-0">
                                                - <?=$data['designation']?></th>
                                            </td>
                                        </tr>
                                    </table>
                                </th>
                                <th><?=$data['statut']?></th>
                                <th><i class="fas fa-times" onclick="showDeleteModal('impression/filament-delete-<?=$data['id']?>/')"></th>
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
                    <form action="impression/filament-save-0/" method="POST">
                        <h5 class="mt-3">Référence</h5>
                        <input type="text" name="reference" class="form-control bg-light border-0 small" required>
                        <h5 class="mt-3">Fabricant</h5>
                        <input type="text" name="fabricant" class="form-control bg-light border-0 small" >
                        <h5 class="mt-3">Prix</h5>
                        <input type="text" name="prix" class="form-control bg-light border-0 small" >
                        <h5 class="mt-3">Désignation</h5>
                        <input type="text" name="designation" class="form-control bg-light border-0 small" required>
                        <h5 class="mt-3">Couleur</h5>
                        <input type="text" name="code_couleur" class="form-control bg-light border-0 small" >
                        <h5 class="mt-3">Statut</h5>
                        <input type="text" name="statut" class="form-control bg-light border-0 small" >
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