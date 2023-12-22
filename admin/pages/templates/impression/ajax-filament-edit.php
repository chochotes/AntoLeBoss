<?php
include $_SERVER['DOCUMENT_ROOT'].'/parametres/constante.php';
include $_SERVER['DOCUMENT_ROOT'] . '/admin/parametres/constante.php';

$Tools->log_account_admin();

$Imprimante = new Imprimante();

$search = $Tools->data_secure($_POST['id']);
$data = $Imprimante->getFilament('id = "'.$search.'"');

?>
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Modifier</h6>
</div>
<div class="card-body">
    <form action="impression/filament-save-<?=$data['id']?>/" method="POST">
        <h5 class="mt-3">Référence</h5>
        <input type="text" name="reference" value="<?=$data['reference']?>" class="form-control bg-light border-0 small" required>
        <h5 class="mt-3">Fabricant</h5>
        <input type="text" name="fabricant" value="<?=$data['fabricant']?>" class="form-control bg-light border-0 small" >
        <h5 class="mt-3">Prix</h5>
        <input type="text" name="prix" value="<?=$data['prix']?>" class="form-control bg-light border-0 small" >
        <h5 class="mt-3">Désignation</h5>
        <input type="text" name="designation" value="<?=$data['designation']?>" class="form-control bg-light border-0 small" required>
        <h5 class="mt-3">Couleur</h5>
        <input type="text" name="code_couleur" value="<?=$data['code_couleur']?>" class="form-control bg-light border-0 small" >
        <h5 class="mt-3">Statut</h5>
        <input type="text" name="statut" value="<?=$data['statut']?>" class="form-control bg-light border-0 small" >
        <div class="text-center">
            <input type="submit" name="add" value="Modifier" class="mt-3 btn btn-primary">
        </div>
    </form>
</div>