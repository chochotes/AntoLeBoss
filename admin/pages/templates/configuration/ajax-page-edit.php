<?php
include $_SERVER['DOCUMENT_ROOT'].'/parametres/constante.php';
include $_SERVER['DOCUMENT_ROOT'] . '/admin/parametres/constante.php';

$Tools->log_account_admin();

$search = $Tools->data_secure($_POST['id']);
$data = $Pages->getPages("id = '".$search."'");

?>
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Modifier</h6>
</div>
<div class="card-body">
    <form action="configuration/page-save-<?=$data['id']?>/" method="POST">
        <h5 class="mt-3">Fichier</h5>
        <input type="text" name="file" value="<?=$data['file']?>" class="form-control bg-light border-0 small" required>
        <h5 class="mt-3">Url</h5>
        <input type="text" name="identifiant" value="<?=$data['identifiant']?>" class="form-control bg-light border-0 small" required>
        <h5 class="mt-3">Titre</h5>
        <input type="text" name="title" value="<?=$data['title']?>" class="form-control bg-light border-0 small" required>
        <h5 class="mt-3">Meta titre</h5>
        <input type="text" name="meta_title" value="<?=$data['meta_title']?>" class="form-control bg-light border-0 small">
        <h5 class="mt-3">Meta description</h5>
        <input type="text" name="meta_description" value="<?=$data['meta_description']?>" class="form-control bg-light border-0 small">
        <h5 class="mt-3">Meta image</h5>
        <input type="text" name="meta_image" value="<?=$data['meta_image']?>" class="form-control bg-light border-0 small">
        <h5 class="mt-3">Meta URL</h5>
        <input type="text" name="meta_url" value="<?=$data['meta_url']?>" class="form-control bg-light border-0 small">
        <h5 class="mt-3">Meta image type</h5>
        <input type="text" name="meta_img_type" value="<?=$data['meta_img_type']?>" class="form-control bg-light border-0 small">
        <h5 class="mt-3">Meta image alt</h5>
        <input type="text" name="meta_img_alt" value="<?=$data['meta_img_alt']?>" class="form-control bg-light border-0 small">
        <div class="text-center">
            <input type="submit" name="add" value="Modifier" class="mt-3 btn btn-primary">
        </div>
    </form>
</div>