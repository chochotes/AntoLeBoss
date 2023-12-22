<?php
include $_SERVER['DOCUMENT_ROOT'].'/parametres/constante.php';
include $_SERVER['DOCUMENT_ROOT'] . '/admin/parametres/constante.php';

$Tools->log_account_admin();

$search = $Tools->data_secure($_POST['id']);
$data = $Pages->getRedirection("id='".$search."'");

?>
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Modifier</h6>
</div>
<div class="card-body">
    <form action="configuration/redirection-save-<?=$data['id']?>/" method="POST">
        <h5 class="mt-3">Information</h5>
        <input type="text" name="information" value="<?=$data['information']?>" class="form-control bg-light border-0 small" required>
        <h5 class="mt-3">Url</h5>
        <input type="text" name="url" value="<?=$data['url']?>" class="form-control bg-light border-0 small" required>
        <h5 class="mt-3">Redirection</h5>
        <input type="text" name="redirection" value="<?=$data['redirection']?>" class="form-control bg-light border-0 small" required>
        <h5 class="mt-3">Statut</h5>
        <input type="text" name="statut" value="<?=$data['statut']?>" class="form-control bg-light border-0 small" required>
        <div class="text-center">
            <input type="submit" name="add" value="Ajouter" class="mt-3 btn btn-primary">
        </div>
    </form>
</div>