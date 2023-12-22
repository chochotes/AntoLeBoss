<?php
/*** VERSION 1.1 ***/

$_SESSION['title'] = "Contenu admin - ".NOMSITE;
$_SESSION['name_page'] = "Contenu du site";

$Tools->log_account_admin();

if(isset($_GET['id']) && $_GET['id']){
    $id = $Tools->data_secure($_GET['id']);
    $dataContenu = $Contenu->getContenu('id="'.$id.'"');
    $nom = $dataContenu['nom'];
    $id_page = $dataContenu['id_page'];
    $identifiant = $dataContenu['identifiant'];
    $contenu = $dataContenu['contenu'];
    $statut = $dataContenu['statut'];
}else{
    $id = 0;
    $nom = "";
    $id_page = "";
    $identifiant = "";
    $contenu = "";
    $statut = "";
}

$lstPages = $Pages->getLstPages();

get_head();
get_header();
?>

<form action="contenu/texte-add-<?=$id?>/" method="POST" enctype="multipart/form-data">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Identification</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-12 mt-3">
                                <label>Nom</label>
                            </div>
                            <div class="col-md-8 col-12 mt-3">
                                <input type="text" name="nom" class="form-control bg-light border-1 small" value="<?=$nom?>">
                            </div>
                            <div class="col-md-4 col-12 mt-3">
                                <label>Identifiant</label>
                            </div>
                            <div class="col-md-8 col-12 mt-3">
                                <input type="text" name="identifiant" class="form-control bg-light border-1 small" value="<?=$identifiant?>">
                            </div>
                            <div class="col-md-4 col-12 mt-3">
                                <label>Page</label>
                            </div>
                            <div class="col-md-8 col-12 mt-3">
                                <select name="id_page" class="form-control bg-light border-1 small" required>
                                    <?php 
                                        foreach($lstPages as $dataPage){
                                            echo '<option value="'.$dataPage['id'].'"'; 
                                            if($id_page == $dataPage['id']) echo 'selected';
                                            echo '>'.$dataPage['identifiant'].'</option>';
                                    } ?>
                                </select>
                            </div>
                            <div class="col-md-4 col-12 mt-3">
                                <label>Statut</label>
                            </div>
                            <div class="col-md-8 col-12 mt-3">
                                <select name="statut" class="form-control bg-light border-1 small" required>
                                    <option value="0" <?php if($statut == 0) echo 'selected'; ?>>Désactivé</option>
                                    <option value="1" <?php if($statut == 1) echo 'selected'; ?>>Activé</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Message</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mt-3">
                                <textarea name="contenu" rows="20" class="form-control bg-light border-1 small" required><?=$contenu?></textarea>
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
    CKEDITOR.replace('contenu');
    CKEDITOR.config.height = 400;
</script>
<?php
get_footer();
?>