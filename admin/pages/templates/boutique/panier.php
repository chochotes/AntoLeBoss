<?php

$_SESSION['title'] = "Panier admin - ".NOMSITE;
$_SESSION['name_page'] = "Panier";

$Tools->log_account_admin();

get_head();
get_header();

$lstPanier = $Panier->getLstPanier();

?>

<div class="card-body">
    <div class="row">
        <div class="col-md-8 col-sm-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Liste</h6>
                </div>
                <div class="table-responsive p-2">
                    <table class="table table-bordered table-edit" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Client</th>
                                <th>Création</th>
                                <th>Modifiation</th>
                                <th>Nombre de produit</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($lstPanier as $data){
                                $name = "";
                                $total = 0;
                                $nbProduct = 0;
                                if($data['id_client']){
                                    $dataClient = $Client->getClient("id='".$data['id_client']."'");
                                    $name = $dataClient['last_name'].' '.$dataClient['first_name'];
                                }
                                $panierProduct = $Panier->getProduitPanierFull($data['id']);
                                foreach($panierProduct as $pdt){
                                    $nbProduct += $pdt['quantite'];
                                    $promotion = $Produit->getPromotionProduit($pdt['id'], $pdt['prix']);
                                    if($promotion)
                                        $total += $pdt['quantite']*$Produit->getPriceWithTva($promotion, $pdt['id_tva']);
                                    else
                                        $total += $pdt['quantite']*$Produit->getPriceWithTva($pdt['prix'], $pdt['id_tva']);
                                }
                                if($nbProduct):
                            ?>
                            <tr onclick="show_data_edit('<?=URLADMIN?>', 'boutique', 'panier-edit', '<?=$data['id']?>')" title="Identifiant: <?=$data['id']?>">
                                <th><?=$data['id']?></th>
                                <th><?php if($name) echo $name; else echo "/";?></th>
                                <th><?=$Tools->convert_date_to_print($data['date_creation'],1)?></th>
                                <th><?=$Tools->convert_date_to_print($data['date_modification'],1)?></th>
                                <th><?=$nbProduct?></th>
                                <th><?=$total?></th>
                            </tr>
                            <?php endif; } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="card shadow mb-4" id="card-edit">
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>