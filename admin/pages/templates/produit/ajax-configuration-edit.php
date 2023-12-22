<?php
include $_SERVER['DOCUMENT_ROOT'].'/parametres/constante.php';
include $_SERVER['DOCUMENT_ROOT'] . '/admin/parametres/constante.php';

$Tools->log_account_admin();

$Produit = new Produit();

$search = $Tools->data_secure($_POST['id']);
$data = $Produit->getProduitWhere("id ='".$search."'");

?>
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Modifier</h6>
</div>
<div class="card-body">
    <form action="produit/configuration-add-<?=$data['id']?>/" method="POST">
        <h5 class="mt-3">Nom</h5>
        <input type="text" name="nom" value="<?=$data['nom']?>" class="form-control bg-light border-1 small" required>
        <h5 class="mt-3">Identifiant</h5>
        <input type="text" name="identifiant" value="<?=$data['identifiant']?>" class="form-control bg-light border-1 small" required>
        <h5 class="mt-3">Prix</h5>
        <input type="text" name="prix" value="<?=$data['prix']?>" class="form-control bg-light border-1 small" required>
        <h5 class="mt-3">Poids</h5>
        <input type="text" name="poids" value="<?=$data['poids']?>" class="form-control bg-light border-1 small" required>
        <h5 class="mt-3">Stock</h5>
        <input type="text" name="stock" value="<?=$data['stock']?>" class="form-control bg-light border-1 small" required>
        <h5 class="mt-3">Statut</h5>
        <select name="statut" class="form-control bg-light border-1 small" required>
            <option value="0" <?php if($data['statut'] == 0) echo "selected"; ?>>Masqué</option>
            <option value="1" <?php if($data['statut'] == 1) echo "selected"; ?>>Visible</option>
            <option value="2" <?php if($data['statut'] == 2) echo "selected"; ?>>Gestion de la quantité</option>
            <option value="3" <?php if($statut == 3) echo "selected"; ?>>À modifier</option>
        </select>
        <div class="text-center">
            <input type="submit" name="add" value="Modifier" class="mt-3 btn btn-primary">
            <a href="<?=URLADMIN?>produit/configuration-edit-<?=$data['id']?>" class="mt-3 btn btn-primary">Modifier en détail</a> 
        </div>
    </form>
</div>