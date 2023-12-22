<?php

$_SESSION['title'] = "Blog admin - ".NOMSITE;
$_SESSION['name_page'] = "Blog";

$Tools->log_account_admin();

if(isset($_GET['id']) && $_GET['id']){
    $id = $_GET['id'];
    $dataBlog = $Blog->getBlog("id='".$id."'");
    $titre = $dataBlog['titre'];
    $identifiant = $dataBlog['identifiant'];
    $image = $dataBlog['image'];
    $seo_titre = $dataBlog['seo_titre'];
    $seo_description = $dataBlog['seo_description'];
    $seo_meta = $dataBlog['seo_meta'];
    $resume = $dataBlog['resume'];
    $contenu = $dataBlog['contenu'];
    $statut = $dataBlog['statut'];
}else{
    $id = 0;
    $titre = "";
    $identifiant = "";
    $image = "";
    $seo_titre = "";
    $seo_description = "";
    $seo_meta = "";
    $resume = "";
    $contenu = "";
    $statut = "";
}


get_head();
get_header();

?>

<form action="contenu/blog-add-<?=$id?>/" method="POST" enctype="multipart/form-data">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Contenu</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-12 mt-3">
                                <label>Titre</label>
                            </div>
                            <div class="col-md-8 col-12 mt-3">
                                <input type="text" name="titre" class="form-control bg-light border-1 small" value="<?=$titre?>" required>
                            </div>
                            <div class="col-md-4 col-12 mt-3">
                                <label>Identifiant</label>
                            </div>
                            <div class="col-md-8 col-12 mt-3">
                                <input type="text" name="identifiant" class="form-control bg-light border-1 small" value="<?=$identifiant?>" required>
                            </div>
                            <div class="<?php if($image) echo "col-md-3"; else echo "col-md-4"; ?> col-12 mt-3">
                                <label>Image</label>
                            </div>
                            <?php if($image): ?>
                                <div class="col-md-3 col-12 mt-3">
                                    <img src="<?=URLSITEWEB.$image?>" class="w-100">
                                </div>
                            <?php endif; ?>
                            <div class="<?php if($image) echo "col-md-6"; else echo "col-md-8"; ?> col-12 mt-3">
                                <input type="file" name="image" class="form-control bg-light border-1 small">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">SEO</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-12 mt-3">
                                <label>Titre</label>
                            </div>
                            <div class="col-md-8 col-12 mt-3">
                                <input type="text" name="seo_titre" class="form-control bg-light border-1 small" value="<?=$seo_titre?>">
                            </div>
                            <div class="col-md-4 col-12 mt-3">
                                <label>Description</label>
                            </div>
                            <div class="col-md-8 col-12 mt-3">
                                <input type="text" name="seo_description" class="form-control bg-light border-1 small" value="<?=$seo_description?>">
                            </div>
                            <div class="col-md-4 col-12 mt-3">
                                <label>Meta</label>
                            </div>
                            <div class="col-md-8 col-12 mt-3">
                                <input type="text" name="seo_meta" class="form-control bg-light border-1 small" value="<?=$seo_meta?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Visibilité</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-12 mt-3">
                                <label>Statut</label>
                            </div>
                            <div class="col-md-8 col-12 mt-3">
                                <select class="form-control bg-light border-1 small" name="statut">
                                    <option value="0" <?php if($statut == 0) echo "selected";?>>Brouillon</option>
                                    <option value="1" <?php if($statut == 1) echo "selected";?>>Publié</option>
                                </select>
                            </div>
                            <div class="col-md-4 col-12 mt-3">
                                <label>Resumé</label>
                            </div>
                            <div class="col-md-8 col-12 mt-3">
                                <textarea name="resume" class="form-control bg-light border-1 small"><?=$resume?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Contenu</h6>
                    </div>
                    <div class="card-body">
                        <?=htmlentities('<blockquote></blockquote>')?>
                        <textarea name="contenu" id="contenu"><?=$contenu?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <input type="submit" class="btn btn-primary btn-fixed" value="Enregistrer">
    </div>
</form>
<script>    
    CKEDITOR.replace('contenu');
    CKEDITOR.config.height = 800;
</script>
<?php
get_footer();
?>