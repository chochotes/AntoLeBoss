<?php
include $_SERVER['DOCUMENT_ROOT'].'/parametres/constante.php';
include $_SERVER['DOCUMENT_ROOT'] . '/admin/parametres/constante.php';

$Tools->log_account_admin();

$Produit = new Produit();

$search = $Tools->data_secure($_POST['id']);
$data = $Produit->getPromotion("id ='".$search."'");

?>
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Modifier</h6>
</div>
<div class="card-body">
    <form action="produit/promotion-add-<?=$data['id']?>/" method="POST">
        <h5 class="mt-3">Nom</h5>
        <input type="text" name="nom" value="<?=$data['nom']?>" class="form-control bg-light border-1 small" required>
        <h5 class="mt-3">Date de début</h5>
        <input type="datetime" name="date_debut" class="form-control bg-light border-1 small" value="<?=$data['date_debut']?>">
        <h5 class="mt-3">Date de fin</h5>
        <input type="datetime" name="date_fin" class="form-control bg-light border-1 small" value="<?=$data['date_fin']?>">
        <h5 class="mt-3">Produit</h5>
        <input type="text" name="poids" value="<?=$data['id_produit']?>" class="form-control bg-light border-1 small">
        <h5 class="mt-3">Catégorie</h5>
        <input type="text" name="stock" value="<?=$data['id_categorie']?>" class="form-control bg-light border-1 small">
        <h5 class="mt-3">Statut</h5>
        <select name="statut" class="form-control bg-light border-1 small">
            <option value="0" <?php if($data['statut'] == 0) echo "selected"; ?>>Inactif</option>
            <option value="1" <?php if($data['statut'] == 1) echo "selected"; ?>>Actif</option>
        </select>
        <div class="text-center">
            <input type="submit" name="add" value="Modifier" class="mt-3 btn btn-primary">
            <a href="<?=URLADMIN?>produit/promotion-edit-<?=$data['id']?>" class="mt-3 btn btn-primary">Modifier en détail</a> 
        </div>
    </form>
</div>