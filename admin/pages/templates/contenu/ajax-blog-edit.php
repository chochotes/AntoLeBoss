<?php
include $_SERVER['DOCUMENT_ROOT'].'/parametres/constante.php';
include $_SERVER['DOCUMENT_ROOT'].'/3d-secure/parametres/constante.php';

$Tools->log_account_admin();

$Blog = new Blog();

$search = $Tools->data_secure($_POST['id']);
$data = $Blog->getBlog(" id = '".$search."'");

?>
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Modifier</h6>
</div>
<div class="card-body">
    <form action="contenu/blog-add-<?=$data['id']?>/" method="POST">
        <h5 class="mt-3">Titre</h5>
        <input type="text" name="titre" value="<?=$data['titre']?>" class="form-control bg-light border-1 small" required>
        <h5 class="mt-3">Identifiant</h5>
        <input type="text" name="identifiant" value="<?=$data['identifiant']?>" class="form-control bg-light border-1 small" required>
        <h5 class="mt-3">Statut</h5>
        <select name="statut" class="form-control bg-light border-1 small" required>
            <option value="0" <?php if($data['statut'] == 0) echo 'selected' ?>>Brouillon</option>
            <option value="1" <?php if($data['statut'] == 1) echo 'selected' ?>>Publié</option>
        </select>
        <div class="text-center">
            <input type="submit" name="add" value="Modifier" class="mt-3 btn btn-primary">
            <a href="<?=URLADMIN?>blog/blog-edit-<?=$data['id']?>/" class="mt-3 btn btn-primary">Modifier en détail</a> 
        </div>
    </form>
</div>