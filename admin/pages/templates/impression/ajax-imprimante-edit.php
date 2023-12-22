<?php
include $_SERVER['DOCUMENT_ROOT'].'/parametres/constante.php';
include $_SERVER['DOCUMENT_ROOT'] . '/admin/parametres/constante.php';

$Tools->log_account_admin();

$search = $Tools->data_secure($_POST['id']);
$data = $Imprimante->getImprimante("id='".$search."'");

?>
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Modifier</h6>
</div>
<div class="card-body">
    <form action="impression/imprimante-save-<?=$data['id']?>/" method="POST">
        <h5 class="mt-3">Nom</h5>
        <input type="text" name="nom" class="form-control bg-light border-1 small" value="<?=$data['nom']?>" required>
        <h5 class="mt-3">Désignation</h5>
        <input type="text" name="designation" class="form-control bg-light border-1 small" value="<?=$data['designation']?>" required>
        <h5 class="mt-3">Statut</h5>
        <select name="statut" class="form-control bg-light border-1 small">
            <option value="1" <?php if($data['statut'] == 1) echo "selected"; ?>>Utilisable</option>
            <option value="0" <?php if($data['statut'] == 0) echo "selected"; ?>>Hors service</option>
            <option value="2" <?php if($data['statut'] == 2) echo "selected"; ?>>Visible</option>
        </select>
        <h5 class="mt-3">Position</h5>
        <input type="text" name="position" class="form-control bg-light border-1 small" value="<?=$data['position']?>">
        <div class="text-center">
            <input type="submit" name="add" value="Modifier" class="mt-3 btn btn-primary">
        </div>
    </form>
</div>