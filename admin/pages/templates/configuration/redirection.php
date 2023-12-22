<?php

$_SESSION['title'] = "Redirection admin - ".NOMSITE;
$_SESSION['name_page'] = "Redirection";
$Tools->log_account_admin();

if(isset($_GET['action']) && $_GET['action']=="save"){
    if(isset($_POST['url']) && $_POST['url']){
        $values= array(
            "information" => $Tools->data_secure($_POST['information']),
            "url" => $Tools->data_secure($_POST['url']),
            "redirection" => $Tools->data_secure($_POST['redirection']),
            "statut" => $Tools->data_secure($_POST['statut']),
        );

        if(isset($_GET['id']) && $_GET['id'] != "0" && $_GET['id'] != "")
        {
            $id = $_GET['id'];
            if(set_update("redirection", $values, "id='$id'", 1)){
                $_SESSION['error_message'] = "La redirection vient d'être modifié avec succés.";
                $_SESSION['error_color'] = "success";
            }else{
                $_SESSION['error_message'] = "La redirection n'a pas pu être modifié.";
                $_SESSION['error_color'] = "danger";
            }
        }else{
            if(set_insert("redirection", $values, 1)){
                $_SESSION['error_message'] = "La redirection vient d'être ajouté avec succés.";
                $_SESSION['error_color'] = "success";
            }else{
                $_SESSION['error_message'] = "La redirection n'a pas pu être ajouté.";
                $_SESSION['error_color'] = "danger";
            }
        }
    }
}elseif(isset($_GET['action']) && $_GET['action']=="delete"){
    if(set_delete("redirection", "id='".$_GET["id"]."'", 1)){
        $_SESSION['error_message'] = "La redirection vient d'être supprimé avec succés.";
        $_SESSION['error_color'] = "success";
    }else{
        $_SESSION['error_message'] = "La redirection n'a pas pu être supprimé.";
        $_SESSION['error_color'] = "danger";
    }
}

get_head();
get_header();

$data_redirection = $Pages->getLstRedirection();
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
                                <th>Information</th>
                                <th>Url</th>
                                <th>Redirection</th>
                                <th>Statut</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data_redirection as $data){ ?>
                            <tr onclick="show_data_edit('<?=URLADMIN?>', 'configuration',  'redirection-edit', '<?=$data['id']?>')" title="Identifiant: <?=$data['id']?>">
                                <th><?=$data['id']?></th>
                                <th><?=$data['information']?></th>
                                <th><?=$data['url']?></th>
                                <th><?=$data['redirection']?></th>
                                <th><?=$data['statut']?></th>
                                <th><i class="fas fa-times" onclick="showDeleteModal('configuration/redirection-delete-<?=$data['id']?>/')"></th>
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
                    <form action="configuration/redirection-save-0/" method="POST">
                        <h5 class="mt-3">Information</h5>
                        <input type="text" name="information" class="form-control bg-light border-0 small" required>
                        <h5 class="mt-3">Url</h5>
                        <input type="text" name="url" class="form-control bg-light border-0 small" required>
                        <h5 class="mt-3">Redirection</h5>
                        <input type="text" name="redirection" class="form-control bg-light border-0 small" required>
                        <h5 class="mt-3">Statut</h5>
                        <input type="text" name="statut" class="form-control bg-light border-0 small" required>
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