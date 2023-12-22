<?php
include $_SERVER['DOCUMENT_ROOT'].'/parametres/constante.php';
include $_SERVER['DOCUMENT_ROOT'] . '/admin/parametres/constante.php';

$Tools->log_account_admin();

$search = $Tools->data_secure($_POST['id']);
$data = $Produit->getLivraison('id="'.$search.'"');

?>
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Modifier</h6>
</div>
<div class="card-body">
    <form action="produit/livraison-save-<?=$data['id']?>/" method="POST">
        <h5 class="mt-3">Entreprise</h5>
        <input type="text" name="id_entreprise" class="form-control bg-light border-1 small" value="<?=$data['id_entreprise']?>" required>
        <h5 class="mt-3">Poids max</h5>
        <input type="text" name="poids_max" class="form-control bg-light border-1 small" value="<?=$data['poids_max']?>" required>
        <h5 class="mt-3">Prix</h5>
        <input type="text" name="prix" class="form-control bg-light border-1 small" value="<?=$data['prix']?>" required>
        <div class="text-center">
            <input type="submit" name="add" value="Modifier" class="mt-3 btn btn-primary">
        </div>
    </form>
</div>