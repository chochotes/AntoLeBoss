<?php

$_SESSION['title'] = "Page admin - ".NOMSITE;
$_SESSION['name_page'] = "Page";
$Tools->log_account_admin();

if(isset($_GET['action']) && $_GET['action']=="save"){
    if(isset($_POST['file']) && $_POST['file']){
        
        $values = [];        
        if(isset($_POST['identifiant'])) $values += ['identifiant' => $Tools->data_secure($_POST['identifiant'])];
        if(isset($_POST['file'])) $values += ['file' => $Tools->data_secure($_POST['file'])];
        if(isset($_POST['title'])) $values += ['title' => $Tools->data_secure($_POST['title'])];
        if(isset($_POST['meta_title'])) $values += ['meta_title' => $Tools->data_secure($_POST['meta_title'])];
        if(isset($_POST['meta_description'])) $values += ['meta_description' => $Tools->data_secure($_POST['meta_description'])];
        if(isset($_POST['meta_image'])) $values += ['meta_image' => $Tools->data_secure($_POST['meta_image'])];
        if(isset($_POST['meta_url'])) $values += ['meta_url' => $Tools->data_secure($_POST['meta_url'])];
        if(isset($_POST['meta_img_type'])) $values += ['meta_img_type' => $Tools->data_secure($_POST['meta_img_type'])];
        if(isset($_POST['meta_img_alt'])) $values += ['meta_img_alt' => $Tools->data_secure($_POST['meta_img_alt'])];


        if(isset($_GET['id']) && $_GET['id'] != "0" && $_GET['id'] != "")
        {
            $id = $Tools->data_secure($_GET["id"]);
            if(set_update("pages", $values, "id='$id'", 1)){
                $Admin->addEditionHistoric("pages", $id, "modification", 1);
                $_SESSION['error_message'] = "La page vient d'être modifié avec succés.";
                $_SESSION['error_color'] = "success";
            }else{
                $Admin->addEditionHistoric("pages", $id, "modification", 0);
                $_SESSION['error_message'] = "La page n'a pas pu être modifié.";
                $_SESSION['error_color'] = "danger";
            }
        }else{
            if(set_insert("pages", $values, 1)){
                $Admin->addEditionHistoric("pages", $_SESSION['lastInsertId'], "ajout", 1);
                $_SESSION['error_message'] = "La page vient d'être ajouté avec succés.";
                $_SESSION['error_color'] = "success";
            }else{
                $Admin->addEditionHistoric("pages", "", "ajout", 0);
                $_SESSION['error_message'] = "La page n'a pas pu être ajouté.";
                $_SESSION['error_color'] = "danger";
            }
        }
    }
}elseif(isset($_GET['action']) && $_GET['action']=="delete"){
    $id = $Tools->data_secure($_GET["id"]);
    if(set_delete("pages", "id='".$id."'", 1)){
        $Admin->addEditionHistoric("pages", $id, "suppression", 1);
        $_SESSION['error_message'] = "La page vient d'être supprimé avec succés.";
        $_SESSION['error_color'] = "success";
    }else{
        $Admin->addEditionHistoric("pages", $id, "suppression", 0);
        $_SESSION['error_message'] = "La page n'a pas pu être supprimé.";
        $_SESSION['error_color'] = "danger";
    }
}

get_head();
get_header();

$data_page = $Pages->getLstPages();

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
                                <th>Fichier</th>
                                <th>Url</th>
                                <th>Titre</th>
                                <th>SEO</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data_page as $data){ ?>
                            <tr onclick="show_data_edit('<?=URLADMIN?>', 'configuration',  'page-edit', '<?=$data['id']?>')" title="Identifiant: <?=$data['id']?>">
                                <td><?= $data['id'] ?></td>
                                <td><?= $data['file'] ?></td>
                                <td><?= $data['identifiant'] ?></td>
                                <td><?= $data['title'] ?></td>
                                <td class="text-center">
                                    <?php
                                    if ($data['meta_title'] && $data['meta_description'] && $data['meta_image'] && $data['meta_img_type'] && $data['meta_img_alt'])
                                        echo '<i class="fas fa-check bg-success text-white text-center p-2 rounded"></i>';
                                    else
                                        echo '<i class="fas fa-times bg-danger text-white text-center p-2 rounded"></i>';
                                    ?>
                                </td>
                                <th><i class="fas fa-times" onclick="showDeleteModal('configuration/page-delete-<?=$data['id']?>/')"></th>
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
                    <form action="configuration/page-save-0/" method="POST">
                        <h5 class="mt-3">Fichier</h5>
                        <input type="text" name="file" class="form-control bg-light border-0 small" required>
                        <h5 class="mt-3">Url</h5>
                        <input type="text" name="identifiant" class="form-control bg-light border-0 small" required>
                        <h5 class="mt-3">Titre</h5>
                        <input type="text" name="title" class="form-control bg-light border-0 small" required>
                        <h5 class="mt-3">Meta titre</h5>
                        <input type="text" name="meta_title" class="form-control bg-light border-0 small">
                        <h5 class="mt-3">Meta description</h5>
                        <input type="text" name="meta_description" class="form-control bg-light border-0 small">
                        <h5 class="mt-3">Meta image</h5>
                        <input type="text" name="meta_image" class="form-control bg-light border-0 small">
                        <h5 class="mt-3">Meta URL</h5>
                        <input type="text" name="meta_url" class="form-control bg-light border-0 small">
                        <h5 class="mt-3">Meta image type</h5>
                        <input type="text" name="meta_img_type" class="form-control bg-light border-0 small">
                        <h5 class="mt-3">Meta image alt</h5>
                        <input type="text" name="meta_img_alt" class="form-control bg-light border-0 small">
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