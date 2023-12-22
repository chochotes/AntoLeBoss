<?php
include $_SERVER['DOCUMENT_ROOT'].'/parametres/constante.php';
include $_SERVER['DOCUMENT_ROOT'] . '/admin/parametres/constante.php';

$Tools->log_account_admin();

$search = $Tools->data_secure($_POST['id']);
$data = $Produit->getTva('id="'.$search.'"');

?>
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Modifier</h6>
</div>
<div class="card-body">
    <form action="produit/tva-save-<?=$data['id']?>/" method="POST">
        <h5 class="mt-3">Nom</h5>
        <input type="text" name="nom" class="form-control bg-light border-1 small" value="<?=$data['nom']?>" required>
        <h5 class="mt-3">Taux</h5>
        <input type="text" name="taux" class="form-control bg-light border-1 small" value="<?=$data['taux']?>" required>
        <h5 class="mt-3">Abréviation</h5>
        <input type="text" name="abreviation" class="form-control bg-light border-1 small" value="<?=$data['abreviation']?>" required>
        <h5 class="mt-3">Description</h5>
        <input type="text" name="description" class="form-control bg-light border-1 small" value="<?=$data['description']?>" required>
        <div class="text-center">
            <input type="submit" name="add" value="Ajouter" class="mt-3 btn btn-primary">
        </div>
    </form>
</div>