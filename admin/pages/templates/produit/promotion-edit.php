<?php

$_SESSION['title'] = "Produit admin - ".NOMSITE;
$_SESSION['name_page'] = "Produit";

$Tools->log_account_admin();

if(isset($_GET['id']) && $_GET['id']){
    $id = $_GET['id'];
    $dataPromotion = $Produit->getPromotion("id='".$id."'");
    $nom = $dataPromotion['nom'];
    $date_debut = $dataPromotion['date_debut'];
    $date_fin = $dataPromotion['date_fin'];
    $code = $dataPromotion['code'];
    $prix_min = $dataPromotion['prix_min'];
    $quantite_min = $dataPromotion['quantite_min'];
    $maximum = $dataPromotion['maximum'];
    $remise = $dataPromotion['remise'];
    $type = $dataPromotion['type'];
    $nouveau_prix = $dataPromotion['nouveau_prix'];
    $frais_de_port = $dataPromotion['frais_de_port'];
    $id_produit = $dataPromotion['id_produit'];
    $id_categorie = $dataPromotion['id_categorie'];
    $statut = $dataPromotion['statut'];
}else{
    $id = 0;
    $nom = "";
    $date_debut = "";
    $date_fin = "";
    $code = "";
    $prix_min = "";
    $quantite_min = "";
    $maximum = "";
    $remise = "";
    $type = "";
    $nouveau_prix = "";
    $frais_de_port = "";
    $id_produit = "";
    $id_categorie = "";
    $statut = "";
}

$lstProduit = $Produit->getLstProduit();

get_head();
get_header();

?>

<form action="produit/promotion-add-<?=$id?>/" method="POST">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Accessibilité</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-12 mt-3">
                                <label>Date de début</label>
                            </div>
                            <div class="col-md-8 col-12 mt-3">
                                <input type="datetime" name="date_debut" class="form-control bg-light border-1 small" value="<?=$date_debut?>">
                            </div>
                            <div class="col-md-4 col-12 mt-3">
                                <label>Date de fin</label>
                            </div>
                            <div class="col-md-8 col-12 mt-3">
                                <input type="datetime" name="date_fin" class="form-control bg-light border-1 small" value="<?=$date_fin?>">
                            </div>
                            <div class="col-md-4 col-12 mt-3">
                                <label>Code</label>
                            </div>
                            <div class="col-md-8 col-12 mt-3">
                                <input type="text" name="code" class="form-control bg-light border-1 small" value="<?=$code?>">
                            </div>
                            <div class="col-md-4 col-12 mt-3">
                                <label>Statut</label>
                            </div>
                            <div class="col-md-8 col-12 mt-3">
                                <select name="statut" class="form-control bg-light border-1 small">
                                    <option value="0" <?php if($statut == 0) echo "selected"; ?>>Inactif</option>
                                    <option value="1" <?php if($statut == 1) echo "selected"; ?>>Actif</option>
                                </select>
                            </div>
                            <div class="col-md-4 col-12 mt-3">
                                <label>Prix minimum</label>
                            </div>
                            <div class="col-md-8 col-12 mt-3">
                                <input type="text" name="prix_minimum" class="form-control bg-light border-1 small" value="<?=$prix_minimum?>">
                            </div>
                            <div class="col-md-4 col-12 mt-3">
                                <label>Quantite Minimale</label>
                            </div>
                            <div class="col-md-8 col-12 mt-3">
                                <input type="number" name="quantite_min" class="form-control bg-light border-1 small" value="<?=$quantite_min?>">
                            </div>
                            <div class="col-md-4 col-12 mt-3">
                                <label>Maximum utilisation</label>
                            </div>
                            <div class="col-md-8 col-12 mt-3">
                                <input type="number" name="maximum" class="form-control bg-light border-1 small" value="<?=$maximum?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Remise</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-12 mt-3">
                                <label>Remise</label>
                            </div>
                            <div class="col-md-8 col-12 mt-3">
                                <input type="text" name="remise" class="form-control bg-light border-1 small" value="<?=$remise?>">
                            </div>
                            <div class="col-md-4 col-12 mt-3">
                                <label>Type</label>
                            </div>
                            <div class="col-md-8 col-12 mt-3">
                                <input type="text" name="type" class="form-control bg-light border-1 small" value="<?=$type?>">
                            </div>
                            <div class="col-md-4 col-12 mt-3">
                                <label>Nouveau prix</label>
                            </div>
                            <div class="col-md-8 col-12 mt-3">
                                <input type="text" name="nouveau_prix" class="form-control bg-light border-1 small" value="<?=$nouveau_prix?>">
                            </div>
                            <div class="col-md-4 col-12 mt-3">
                                <label>Frais de port</label>
                            </div>
                            <div class="col-md-8 col-12 mt-3">
                                <input type="text" name="frais_de_port" class="form-control bg-light border-1 small" value="<?=$frais_de_port?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Configuration</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-12 mt-3">
                                <label>Nom</label>
                            </div>
                            <div class="col-md-8 col-12 mt-3">
                                <input type="text" name="nom" class="form-control bg-light border-1 small" value="<?=$nom?>" required>
                            </div>
                            <div class="col-md-4 col-12 mt-3">
                                <label>Produit</label>
                            </div>
                            <div class="col-md-8 col-12 mt-3">
                                <input type="text" name="id_produit" class="form-control bg-light border-1 small" value="<?=$id_produit?>">
                            </div>
                            <?php /*<div class="col-md-4 col-12 mt-3">
                                <label>Catégorie</label>
                            </div>
                            <div class="col-md-8 col-12 mt-3">
                                <input type="text" name="id_categorie" class="form-control bg-light border-1 small" value="<?=$id_categorie?>">
                            </div>*/ ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="submit" class="btn btn-primary btn-fixed" value="Enregistrer">
    </div>
</form>
<script>
    CKEDITOR.replace('description');
    CKEDITOR.config.height = 500;
</script>
<?php
get_footer();
?>