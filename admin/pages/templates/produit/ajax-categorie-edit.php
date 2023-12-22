<?php
include $_SERVER['DOCUMENT_ROOT'].'/parametres/constante.php';
include $_SERVER['DOCUMENT_ROOT'] . '/admin/parametres/constante.php';

$Tools->log_account_admin();

$Settings = new Settings();

$search = $Tools->data_secure($Tools->data_secure($_POST['id']));
$data = $Produit->getCategorie('id="'.$search.'"');

$lstCategorie = $Produit->getLstCategorie('id <> "'.$search.'"');

?>
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Modifier</h6>
</div>
<div class="card-body">
    <form action="produit/categorie-save-<?=$data['id']?>/" method="POST">
        <h5 class="mt-3">Nom</h5>
        <input type="text" name="nom" value="<?=$data['nom']?>" class="form-control bg-light border-1 small" required>
        <h5 class="mt-3">Parent</h5>
        <select name="id_parent" value="<?=$data['id_parent']?>" class="form-control bg-light border-1 small">
            <option></option>
            <?php foreach ($lstCategorie as $dataCategorie) { ?>
                <option value="<?= $dataCategorie['id'] ?>" <?php if($data['id_parent'] == $dataCategorie['id']) echo "selected";?>><?= $dataCategorie['nom'] ?></option>
            <?php } ?>
        </select>
        <h5 class="mt-3">Identifiant</h5>
        <input type="text" name="identifiant" value="<?=$data['identifiant']?>" class="form-control bg-light border-1 small" required>
        <h5 class="mt-3">Statut</h5>
        <select name="statut" value="<?=$data['statut']?>" class="form-control bg-light border-1 small" required>
            <option value="0" <?php if($data['statut'] == 0) echo "selected";?>>Inactif</option>
            <option value="1" <?php if($data['statut'] == 1) echo "selected";?>>Actif</option>
        </select>
        <div class="text-center">
            <input type="submit" name="add" value="Modifier" class="mt-3 btn btn-primary">
        </div>
    </form>
</div>