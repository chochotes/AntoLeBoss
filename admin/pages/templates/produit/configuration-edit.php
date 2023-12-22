<?php

$_SESSION['title'] = "Produit admin - ".NOMSITE;
$_SESSION['name_page'] = "Produit";

$Tools->log_account_admin();

if(isset($_GET['id']) && $_GET['id']){
    $id = $_GET['id'];
    $dataProduit = $Produit->getProduitWhere("id='".$id."'");
    $nom = $dataProduit['nom'];
    $identifiant = $dataProduit['identifiant'];
    $prix = $dataProduit['prix'];
    $id_tva = $dataProduit['id_tva'];
    $description = $dataProduit['description'];
    $poids = $dataProduit['poids'];
    $dimensions = $dataProduit['dimensions'];
    $stock = $dataProduit['stock'];
    $couleur = $dataProduit['couleur'];
    $personnalisation = $dataProduit['personnalisation'];
    $image_principale = $dataProduit['image_principale'];
    $image = $dataProduit['image'];
    if($dataProduit['seo_nom']) $seo_nom = $dataProduit['seo_nom']; else $seo_nom = "- [[NOMSITE]]";
    if($dataProduit['seo_description']) $seo_description = $dataProduit['seo_description']; else $seo_description = "- [[NOMSITE]]";
    if($dataProduit['seo_meta']) $seo_meta = $dataProduit['seo_meta']; else $seo_meta = "- [[NOMSITE]]";
    $reference = $dataProduit['reference'];
    $id_produit_panier = $dataProduit['id_produit_panier'];
    $id_produit_associe = $dataProduit['id_produit_associe'];
    $categorie = $dataProduit['categorie'];
    $date_visibilite = $dataProduit['date_visibilite'];
    $date_nouveaute = $dataProduit['date_nouveaute'];
    $createur = $dataProduit['createur'];
    $createur_url = $dataProduit['createur_url'];
    $statut = $dataProduit['statut'];
}else{
    $id = 0;
    $nom = "";
    $identifiant = "";
    $prix = "";
    $id_tva = "1";
    $description = "";
    $poids = "";
    $dimensions = "";
    $stock = "1";
    $couleur = "";
    $personnalisation = "";
    $image_principale = "";
    $image = "";
    $seo_nom = "- [[NOMSITE]]";
    $seo_description = "- [[NOMSITE]]";
    $seo_meta = "- [[NOMSITE]]";
    $reference = "";
    $categorie = "";
    $id_produit_panier = "";
    $id_produit_associe = "";
    $date_visibilite = "";
    $date_nouveaute = "";
    $createur = "";
    $createur_url = "";
    $statut = "";
}

$lstProduit = $Produit->getLstProduit('id <> "'.$id.'"');
$lstCouleur = $Imprimante->getLstFilament();
$lstCategorie = $Produit->getLstCategorie();
        
get_head();
get_header();

?>

<form action="produit/configuration-add-<?=$id?>/" method="POST" enctype="multipart/form-data">
    <div class="card-body">
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Produit</h6>
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
                                        <label>Prix</label>
                                    </div>
                                    <div class="col-md-8 col-12 mt-3">
                                        <input type="text" name="prix" class="form-control bg-light border-1 small" value="<?=$prix?>" required>
                                    </div>
                                    <div class="col-md-4 col-12 mt-3">
                                        <label>Tva</label>
                                    </div>
                                    <div class="col-md-8 col-12 mt-3">
                                        <input type="text" name="id_tva" class="form-control bg-light border-1 small" value="<?=$id_tva?>" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">SEO</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 col-12 mt-3">
                                        <label>SEO Nom</label>
                                    </div>
                                    <div class="col-md-8 col-12 mt-3">
                                        <input type="text" name="seo_nom" class="form-control bg-light border-1 small" value="<?=$seo_nom?>">
                                    </div>
                                    <div class="col-md-4 col-12 mt-3">
                                        <label>SEO description</label>
                                    </div>
                                    <div class="col-md-8 col-12 mt-3">
                                        <textarea name="seo_description" class="form-control bg-light border-1 small"><?=$seo_description?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Configuration</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 col-12 mt-3">
                                        <label>Référence</label>
                                    </div>
                                    <div class="col-md-8 col-12 mt-3">
                                        <input type="text" name="reference" class="form-control bg-light border-1 small" value="<?=$reference?>" required>
                                    </div>
                                    <div class="col-md-4 col-12 mt-3">
                                        <label>Poids</label>
                                    </div>
                                    <div class="col-md-8 col-12 mt-3">
                                        <input type="text" name="poids" class="form-control bg-light border-1 small" value="<?=$poids?>">
                                    </div>
                                    <div class="col-md-4 col-12 mt-3">
                                        <label>Temps d'impression</label>
                                    </div>
                                    <div class="col-md-8 col-12 mt-3">
                                        <input type="text" name="temps_impression" class="form-control bg-light border-1 small" value="<?=$temps_impression?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Personnalisation</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 col-12 mt-3">
                                        <label>Couleur</label>
                                    </div>
                                    <div class="col-md-8 col-12 mt-3">
                                        <select name="couleur[]" class="form-control bg-light border-1 small selectpicker" multiple>
                                            <?php foreach($lstCouleur as $dataCouleur){ ?>
                                            <option value="<?=$dataCouleur['id']?>" <?php if(strpos($couleur, ";".$dataCouleur['id'].";") !== false) echo "selected";?>><?=$dataCouleur['reference'].' '.$dataCouleur['fabricant'].' '.$dataCouleur['designation']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4 col-12 mt-3">
                                        <label>Personnalisation</label>
                                    </div>
                                    <div class="col-md-8 col-12 mt-3">
                                        <input type="text" name="personnalisation" class="form-control bg-light border-1 small" value="<?=$personnalisation?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Images</h6>
                            </div>
                            <div class="card-body">
                                <div class="row" id="lstImage">
                                    <div class="<?php if($image_principale) echo "col-md-3"; else echo "col-md-4"; ?> col-12 mt-3">
                                        <label>Image principale</label>
                                    </div>
                                    <?php if($image_principale): ?>
                                        <div class="col-md-3 col-12 mt-3">
                                            <img src="<?=URLSITEWEB.$image_principale?>" class="w-100">
                                        </div>
                                    <?php endif; ?>
                                    <div class="<?php if($image_principale) echo "col-md-6"; else echo "col-md-8"; ?> col-12 mt-3">
                                        <input type="file" name="image_principale" class="form-control bg-light border-1 small">
                                    </div>
                                    <?php
                                    $image = explode(";", $image);
                                    $i=1;
                                    foreach($image as $dataImage){ 
                                        if($dataImage):?>
                                        <div class="col-md-3 col-12 mt-3">
                                            <label>Image n°<?=$i?></label>
                                        </div>
                                        <div class="col-md-3 col-12 mt-3">
                                            <img src="<?=URLSITEWEB.$dataImage?>" class="w-100">
                                        </div>
                                        <div class="col-md-6 col-12 mt-3">
                                            <input type="file" name="image_<?=$i?>" class="form-control bg-light border-1 small">
                                        </div>
                                    <?php
                                    $i++;
                                    endif;} ?>
                                </div>
                                <input type="button" class="m-auto mt-3 btn btn-primary" onclick="addImage()" value="Ajouter une image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Visibilité</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="row">
                                    <div class="col-md-4 col-12 mt-3">
                                        <label>Identifiant</label>
                                    </div>
                                    <div class="col-md-8 col-12 mt-3">
                                        <input type="text" name="identifiant" class="form-control bg-light border-1 small" value="<?=$identifiant?>" required>
                                    </div>
                                    <div class="col-md-4 col-12 mt-3">
                                        <label>Catégorie</label><?=$categorie?>
                                    </div>
                                    <div class="col-md-8 col-12 mt-3">
                                        <select name="categorie[]" class="form-control bg-light border-1 small selectpicker" multiple required>
                                            <?php foreach($lstCategorie as $dataCategorie){ ?>
                                            <option value="<?=$dataCategorie['id']?>" <?php if(strpos($categorie, ";".$dataCategorie['id'].";") !== false) echo "selected";?>><?=$dataCategorie['nom']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4 col-12 mt-3">
                                        <label>Produit visible à l'ajout au panier</label>
                                    </div>
                                    <div class="col-md-8 col-12 mt-3">
                                        <select name="id_produit_panier[]" class="form-control bg-light border-1 small selectpicker" multiple>
                                            <?php foreach($lstProduit as $dataProduit){ ?>
                                                <option value="<?=$dataProduit['id']?>" <?php if(strstr($id_produit_panier, ";".$dataProduit['id'].";")) echo "selected"?>><?=$dataProduit['nom']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4 col-12 mt-3">
                                        <label>Produit associé</label>
                                    </div>
                                    <div class="col-md-8 col-12 mt-3">
                                        <select name="id_produit_associe[]" class="form-control bg-light border-1 small selectpicker" multiple>
                                            <?php foreach($lstProduit as $dataProduit){ ?>
                                                <option value="<?=$dataProduit['id']?>" <?php if(strstr($id_produit_associe, ";".$dataProduit['id'].";")) echo "selected"?>><?=$dataProduit['nom']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="row">
                                    <div class="col-md-4 col-12 mt-3">
                                        <label>Stock</label>
                                    </div>
                                    <div class="col-md-8 col-12 mt-3">
                                        <input type="text" name="stock" class="form-control bg-light border-1 small" value="<?=$stock?>" required>
                                    </div>
                                    <div class="col-md-4 col-12 mt-3">
                                        <label>Statut</label>
                                    </div>
                                    <div class="col-md-8 col-12 mt-3">
                                        <select name="statut" class="form-control bg-light border-1 small" required>
                                            <option value="0" <?php if($statut == 0) echo "selected"; ?>>Masqué</option>
                                            <option value="1" <?php if($statut == 1) echo "selected"; ?>>Visible</option>
                                            <option value="2" <?php if($statut == 2) echo "selected"; ?>>Gestion de la quantité</option>
                                            <option value="3" <?php if($statut == 3) echo "selected"; ?>>À modifier</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 col-12 mt-3">
                                        <label>Date Visibilité</label>
                                    </div>
                                    <div class="col-md-8 col-12 mt-3">
                                        <input type="date" name="date_visibilite" class="form-control bg-light border-1 small" value="<?=$date_visibilite?>">
                                    </div>
                                    <div class="col-md-4 col-12 mt-3">
                                        <label>Date nouveauté</label>
                                    </div>
                                    <div class="col-md-8 col-12 mt-3">
                                        <input type="date" name="date_nouveaute" class="form-control bg-light border-1 small" value="<?=$date_nouveaute?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Affichage</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2 col-12 mt-3">
                                <label>Dimensions</label>
                            </div>
                            <div class="col-md-2 col-12 mt-3">
                                <input type="text" name="dimensions" class="form-control bg-light border-1 small" value="<?=$dimensions?>">
                            </div>
                            <div class="col-md-2 col-12 mt-3">
                                <label>Créateur</label>
                            </div>
                            <div class="col-md-2 col-12 mt-3">
                                <input type="text" name="createur" class="form-control bg-light border-1 small" value="<?=$createur?>">
                            </div>
                            <div class="col-md-2 col-12 mt-3">
                                <label>Url du fichier</label>
                            </div>
                            <div class="col-md-2 col-12 mt-3">
                                <input type="text" name="createur_url" class="form-control bg-light border-1 small" value="<?=$createur_url?>">
                            </div>
                            <div class="col-12 mt-3">
                                <label>Description</label>
                            </div>
                            <div class="col-12 mt-3">
                                <textarea name="description" id="description"><?=$description?></textarea>
                            </div>
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
<script type="text/javascript">
    var nbImage = <?=$i?>;
    
    function addImage(){
        var msg = '';
        msg += '<div class="col-md-4 col-12 mt-3">';
        msg += '<label>Image n°'+nbImage+'</label>';
        msg += '</div>';
        msg += '<div class="col-md-8 col-12 mt-3">';
        msg += '<input type="file" name="image_'+nbImage+'" class="form-control bg-light border-1 small">';
        msg += '</div>';
        $("#lstImage").append(msg);
        nbImage++;
    }
    
</script>