<?php
include $_SERVER['DOCUMENT_ROOT'].'/parametres/constante.php';
include $_SERVER['DOCUMENT_ROOT'] . '/admin/parametres/constante.php';

$Tools->log_account_admin();

$Panier = new Panier();
$Produit = new Produit();

$search = $Tools->data_secure($_POST['id']);
$lstProduit = $Panier->getProduitPanierFull($search);

?>
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Modifier</h6>
</div>
<div class="card-body">
    <table class="table table-bordered table-edit" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th width="30%">Image</th>
                <th>Produit</th>
                <th>Personnalisation</th>
            </tr>
        </thead>
        <tbody>
        <?php
        foreach($lstProduit as $dataProduit){ ?>
            <tr>
                <th><img src="<?=URLSITEWEB.$dataProduit['image_principale']?>" class="w-100"></th>
                <th><?=$dataProduit['nom'].' '.' '.' x'.$dataProduit['quantite']?></th>
                <th><?=$Imprimante->printColorProduit($dataProduit['id_color']).' '.$dataProduit['personnalisation']?></th>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>