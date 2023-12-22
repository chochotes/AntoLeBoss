<?php
include $_SERVER['DOCUMENT_ROOT'].'/parametres/constante.php';
include $_SERVER['DOCUMENT_ROOT'] . '/admin/parametres/constante.php';

$Tools->log_account_admin();

$Produit = new Produit();

$search = $Tools->data_secure($_POST['id']);
$data = $Client->getClient("id='".$search."'");


$date_registered = $data['date_registered'];
$last_log = $data['last_log'];

?>
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Modifier</h6>
</div>
<div class="card-body">
    <form action="boutique/client-add-<?=$data['id']?>/" method="POST">
        <h5 class="mt-3">Nom</h5>
        <input type="text" name="last_name" value="<?=$data['last_name']?>" class="form-control bg-light border-0 small" required>
        <h5 class="mt-3">Prénom</h5>
        <input type="text" name="first_name" value="<?=$data['first_name']?>" class="form-control bg-light border-0 small" required>
        <h5 class="mt-3">Email</h5>
        <input type="text" name="email" value="<?=$data['email']?>" class="form-control bg-light border-0 small" required>
        <h5 class="mt-3">Téléphone</h5>
        <input type="text" name="phone" value="<?=$data['phone']?>" class="form-control bg-light border-0 small">
        <h5 class="mt-3">Statut</h5>
        <select name="statut" class="form-control bg-light border-1 small" required>
            <option value="1" <?php if($data['statut'] == 1) echo "selected"; ?>>Activé</option>
            <option value="0" <?php if($data['statut'] == 0) echo "selected"; ?>>Désactivé</option>
        </select>
        <h5 class="mt-3">Profil</h5>
        <select name="droit" class="form-control bg-light border-1 small" required>
            <option value="user" <?php if($data['droit'] == "user") echo "selected"; ?>>Client</option>
            <option value="administrator" <?php if($data['droit'] == "administrator") echo "selected"; ?>>Administrateur</option>
            <option value="administrator-editor" <?php if($data['droit'] == "administrator-editor") echo "selected"; ?>>Rédacteur</option>
        </select>
        <div class="col-12 mt-3">
            <p>Date inscription : <?=$Tools->convert_date_to_print($date_registered,1)?></p>
        </div>
        <div class="col-12 mt-3">
            <p>Dernière connexion : <?=$Tools->convert_date_to_print($last_log,1)?></p>
        </div>
        <div class="text-center">
            <input type="submit" name="add" value="Modifier" class="mt-3 btn btn-primary">
            <a href="<?=URLADMIN?>boutique/client-edit-<?=$data['id']?>" class="mt-3 btn btn-primary">Modifier en détail</a> 
        </div>
    </form>
</div>