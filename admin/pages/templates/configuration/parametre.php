<?php

$_SESSION['title'] = "Paramètres admin - ".NOMSITE;
$_SESSION['name_page'] = "Paramètres";
$Tools->log_account_admin();

if(isset($_GET['action']) && $_GET['action']=="save"){
    if(isset($_POST['identity']) && isset($_POST['value']) && $_POST['identity']!="" && $_POST['value']){
        $values= array(
            "detail" => $Tools->data_secure($_POST['detail']),
            "identity" => $Tools->data_secure($_POST['identity']),
            "value" => $Tools->data_secure($_POST['value']),
        );

        if(isset($_GET['id']) && $_GET['id'] != "0" && $_GET['id'] != "")
        {
            $id = $_GET['id'];
            if(set_update("admin_settings", $values, "id='$id'", 1)){
                $_SESSION['error_message'] = "Le paramètre vient d'être modifié avec succés.";
                $_SESSION['error_color'] = "success";
            }else{
                $_SESSION['error_message'] = "Le paramètre n'a pas pu être modifié.";
                $_SESSION['error_color'] = "danger";
            }
        }else{
            if(set_insert("admin_settings", $values, 1)){
                $_SESSION['error_message'] = "Le paramètre vient d'être ajouté avec succés.";
                $_SESSION['error_color'] = "success";
            }else{
                $_SESSION['error_message'] = "Le paramètre n'a pas pu être ajouté.";
                $_SESSION['error_color'] = "danger";
            }
        }
    }
}elseif(isset($_GET['action']) && $_GET['action']=="delete"){
    if(set_delete("admin_settings", "id='".$_GET["id"]."'", 1)){
        $_SESSION['error_message'] = "Le paramètre vient d'être supprimé avec succés.";
        $_SESSION['error_color'] = "success";
    }else{
        $_SESSION['error_message'] = "Le paramètre n'a pas pu être supprimé.";
        $_SESSION['error_color'] = "danger";
    }
}

get_head();
get_header();

$data_settings = $Settings->getSettingsWhere("identity NOT LIKE 'MAINTENANCE%'");
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
                                <th>Détail</th>
                                <th>Identité</th>
                                <th>Valeur</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data_settings as $data){ ?>
                            <tr onclick="show_data_edit('<?=URLADMIN?>', 'configuration', 'parametre-edit', '<?=$data['id']?>')" title="Identifiant: <?=$data['id']?>">
                                <th><?=$data['detail']?></th>
                                <th><?=$data['identity']?></th>
                                <th><?=$data['value']?></th>
                                <th><i class="fas fa-times" onclick="showDeleteModal('configuration/parametre-delete-<?=$data['id']?>/')"></th>
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
                    <form action="configuration/parametre-save-0/" method="POST">
                        <h5 class="mt-3">Détail</h5>
                        <input type="text" name="detail" class="form-control bg-light border-0 small" required>
                        <h5 class="mt-3">Valeur</h5>
                        <input type="text" name="value" class="form-control bg-light border-0 small" required>
                        <h5 class="mt-3">Identité</h5>
                        <input type="text" name="identity" class="form-control bg-light border-0 small" required>
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