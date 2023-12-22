<?php

$_SESSION['title'] = "Faq admin - ".questionSITE;
$_SESSION['name_page'] = "Faq";

$Tools->log_account_admin();

if(isset($_GET['id']) && $_GET['id']){
    $id = $Tools->data_secure($_GET['id']);
    $data_faq = $Faq->getFaq('id="'.$id.'"');
    $question = $data_faq['question'];
    $reponse = $data_faq['reponse'];
    $position = $data_faq['position'];
    $statut = $data_faq['statut']; 
}else{
    $id = 0;
    $question = "";
    $reponse = "";
    $position = "";
    $statut = "";

}

get_head();
get_header();
?>

<form action="contenu/faq-add-<?=$id?>/" method="POST" enctype="multipart/form-data">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Faq</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-12 mt-3">
                                <label>Question</label>
                            </div>
                            <div class="col-md-8 col-12 mt-3">
                                <input type="text" name="question" class="form-control bg-light border-1 small" value="<?=$question?>">
                            </div>
                            
                            <div class="col-md-4 col-12 mt-3">
                                <label>Position</label>
                            </div>
                            <div class="col-md-8 col-12 mt-3">
                                <input type="text" name="position" class="form-control bg-light border-1 small" value="<?=$position?>">
                            </div>
                            <div class="col-md-4 col-12 mt-3">
                                <label>Statut</label>
                            </div>
                            <div class="col-md-8 col-12 mt-3">
                                <select name="statut" class="form-control bg-light border-1 small" required>
                                    <option value="0" <?php if($statut == 0) echo 'selected'; ?>>Inactive</option>
                                    <option value="1" <?php if($statut == 1) echo 'selected'; ?>>Active</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Réponse</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mt-3">
                                <textarea name="reponse" rows="20" class="form-control bg-light border-1 small" required><?=$reponse?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <input type="submit" class="btn btn-primary float-right" value="Enregistrer">
    </div>
</form>
<script>    
    CKEDITOR.replace('reponse');
    CKEDITOR.config.height = 400;
</script>
<?php
get_footer();
?>