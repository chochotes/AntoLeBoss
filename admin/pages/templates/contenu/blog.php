<?php

$_SESSION['title'] = "Blog admin - ".NOMSITE;
$_SESSION['name_page'] = "Blog";

$Tools->log_account_admin();

if(isset($_GET['action']) && $_GET['action']=="add"){
    if(isset($_POST['titre']) && $_POST['titre']!=""){
        $values = [];
        if(isset($_POST['titre'])) $values += ['titre' => $Tools->data_secure($_POST['titre'])];
        if(isset($_POST['identifiant'])) $values += ['identifiant' => $Tools->data_secure($_POST['identifiant'])];
        if(isset($_POST['contenu'])) $values += ['contenu' => $_POST['contenu']];
        if(isset($_POST['resume'])) $values += ['resume' => $Tools->data_secure($_POST['resume'])];
        if(isset($_POST['seo_titre'])) $values += ['seo_titre' => $Tools->data_secure($_POST['seo_titre'])];
        if(isset($_POST['seo_description'])) $values += ['seo_description' => $Tools->data_secure($_POST['seo_description'])];
        if(isset($_POST['seo_meta'])) $values += ['seo_meta' => $Tools->data_secure($_POST['seo_meta'])];
        if(isset($_POST['statut'])) $values += ['statut' => $Tools->data_secure($_POST['statut'])];
        
        if(isset($_FILES['image']) && $_FILES['image']['name']){
            $url = 'media/blog/';
            $name_picture = $_FILES['image']['name'];
            if(move_uploaded_file($_FILES['image']['tmp_name'], URLSITEABS.$url.$name_picture))
                $values += ['image' => $url.$name_picture];
        }

        if(isset($_GET['id']) && $_GET['id'] != "0" && $_GET['id'] != ""){
            $id = $_GET['id'];
            if(set_update("blog", $values, "id='$id'", 1)){
                $Admin->addEditionHistoric("blog", $id, "modification", 1);
                $_SESSION['error_message'] = "L'article vient d'être modifié avec succés.";
                $_SESSION['error_color'] = "success";
            }else{
                $Admin->addEditionHistoric("blog", $id, "modification", 0);
                $_SESSION['error_message'] = "L'article n'a pas pu être modifié.";
                $_SESSION['error_color'] = "danger";
            }
        }else{
            if(set_insert("blog", $values, 1, 1)){
                $Admin->addEditionHistoric("blog", $_SESSION['lastInsertId'], "ajout", 1);
                unset($_SESSION['lastInsertId']);
                $_SESSION['error_message'] = "L'article vient d'être ajouté avec succés.";
                $_SESSION['error_color'] = "success";
            }else{
                $Admin->addEditionHistoric("blog", "", "ajout", 0);
                $_SESSION['error_message'] = "L'article n'a pas pu être ajouté.";
                $_SESSION['error_color'] = "danger";
            }
        }
    }
}elseif(isset($_GET['action']) && $_GET['action']=="delete"){
    if(set_delete("blog", "id='".$_GET["id"]."'", 1)){
        $_SESSION['error_message'] = "L'article vient d'être supprimé avec succés.";
        $_SESSION['error_color'] = "success";
    }else{
        $_SESSION['error_message'] = "L'article n'a pas pu être supprimé.";
        $_SESSION['error_color'] = "danger";
    }
}

get_head();
get_header();

$lstBlog = $Blog->getLstBlog();
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
                                <th>Titre</th>
                                <th width="20%">Image</th>
                                <th>Statut</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($lstBlog as $data){ ?>
                            <tr onclick="show_data_edit('<?=URLADMIN?>', 'contenu', 'blog-edit', '<?=$data['id']?>')" title="Identifiant: <?=$data['id']?>">
                                <th><?=$data['id']?></th>
                                <th><?=$data['titre']?></th>
                                <th><?php if($data['image']){?><img src="<?=URLSITEWEB.$data['image']?>" class="w-100"><?php } ?></th>
                                <th>
                                    <?php 
                                        if($data['statut']) echo "Publié";
                                        else echo "Brouillon";
                                    ?>
                                </th>
                                <th><i class="fas fa-times" onclick="showDeleteModal('contenu/blog-delete-<?=$data['id']?>/')"></th>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="card shadow mb-4" id="card-edit">
                <div class="text-center">
                    <a href="contenu/blog-edit-0/" class="m-5 btn btn-primary">Ajouter</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>