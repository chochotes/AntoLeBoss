<?php
include $_SERVER['DOCUMENT_ROOT'].'/parametres/constante.php';
include $_SERVER['DOCUMENT_ROOT'].'/3d-secure/parametres/constante.php';

$Tools->log_account_admin();

$Settings = new Settings();

$search = $Tools->data_secure($Tools->data_secure($_POST['id']));
$data = $Settings->getSettingWithId($search);

?>
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Modifier</h6>
</div>
<div class="card-body">
    <form action="configuration/parametre-save-<?=$data['id']?>/" method="POST">
        <h5 class="mt-3">Détail</h5>
        <input type="text" name="detail" value="<?=$data['detail']?>" class="form-control bg-light border-0 small" required>
        <h5 class="mt-3">Identité</h5>
        <input type="text" name="identity" value="<?=$data['identity']?>" class="form-control bg-light border-0 small" required>
        <h5 class="mt-3">Valeur</h5>
        <input type="text" name="value" value="<?=$data['value']?>" class="form-control bg-light border-0 small" required>
        <div class="text-center">
            <input type="submit" name="add" value="Modifier" class="mt-3 btn btn-primary">
        </div>
    </form>
</div>