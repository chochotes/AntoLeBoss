<?php
/*** VERSION 1.1 ***/

$monModule = $Module->getModule('module = "'.$_SESSION['module'].'" AND page = "'.$_SESSION['page'].'"');

/***** INFORMATIONS POUR LE HEADER *****/
$_SESSION['title'] = str_replace("[[NOMSITE]]", NOMSITE, $monModule['title']);
$_SESSION['name_page'] = $monModule['name_page'];
$_SESSION['monModule'] = $monModule;

$Tools->log_account_admin();

$page = $monModule['page'];
$module = $monModule['module'];
$table = $monModule['table_bdd'];
$classe = $monModule['classe'];

$lst_filament = $Imprimante->getLstFilament();
$select = array();
for($i=0; $i<count($lst_filament); $i++){
    $select[$i]['value'] = $lst_filament[$i]['id'];
    $select[$i]['nom'] = $lst_filament[$i]['reference'] . ' - ' . $lst_filament[$i]['fabricant'] . ' - ' . $lst_filament[$i]['designation'];
}
//["type" => 'text', "titre" => 'Identifiant Filament', "name" => 'id_filament', "required" => 'true', "print" => true, "position" => 1],
$tableau = array(
    ["type" => 'select', "titre" => 'Filament', "name" => 'id_filament', "required" => 'true', "option" => $select, "print" => true, "position" => 1],
    ["type" => 'text', "titre" => 'Numéro Bobine', "name" => 'num_bobine', "required" => 'true', "print" => true, "position" => 2],
    ["type" => 'text', "titre" => 'Stock', "name" => 'stock', "required" => 'true', "print" => true, "position" => 3],
);

if(isset($_GET['action']) && $_GET['action']=="add"){
    if(!empty($_POST['id_filament']) && !empty($_POST['num_bobine']) && !empty($_POST['stock'])){
        $values = [];
        foreach($tableau as $form){
            if(isset($_POST[$form['name']])){
                if($form['type'] != "ckeditor") $content = $Tools->data_secure($_POST[$form['name']]);
                else $content = $_POST[$form['name']];
                
                $values += array($form['name'] => $content);
            }
        }

        if(isset($_GET['id']) && $_GET['id'] != "0" && $_GET['id'] != ""){
            $id = $Tools->data_secure($_GET['id']);
            if(set_update($table, $values, 'id="'.$id.'"', 1)){
                $Admin->addEditionHistoric($table, $id, "modification", 1);
                $_SESSION['error_message'] = "Le stock vient d'être modifié avec succès.";
                $_SESSION['error_color'] = "success";
            }else{
                $Admin->addEditionHistoric($table, $id, "modification", 0);
                $_SESSION['error_message'] = "Le stock n'a pas pu être modifié.";
                $_SESSION['error_color'] = "danger";
            }
        }else{
            if(set_insert($table, $values, 1, 1)){
                $Admin->addEditionHistoric($table, $_SESSION['lastInsertId'], "ajout", 1);
                unset($_SESSION['lastInsertId']);
                $_SESSION['error_message'] = "Le stock vient d'être ajouté avec succès.";
                $_SESSION['error_color'] = "success";
            }else{
                $Admin->addEditionHistoric($table, "", "ajout", 0);
                $_SESSION['error_message'] = "Le stock n'a pas pu être ajouté.";
                $_SESSION['error_color'] = "danger";
            }
        }
    }
}elseif(isset($_GET['action']) && $_GET['action']=="delete"){
    $id = $Tools->data_secure($_GET['id']);
    if(set_delete($table, 'id="'.$id.'"', 1)){
        $Admin->addEditionHistoric($table, $id, "suppression", 1);
        $_SESSION['error_message'] = "Le stock vient d'être supprimé avec succès.";
        $_SESSION['error_color'] = "success";
    }else{
        $Admin->addEditionHistoric($table, $id, "suppression", 1);
        $_SESSION['error_message'] = "Le stock n'a pas pu être supprimé.";
        $_SESSION['error_color'] = "danger";
    }
}

get_head();
get_header();
$lstStock = $$classe->getLstStock();
?>

<div class="card-body">
    <div class="row">
        <div class="col-md-8 col-sm-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Liste</h6>
                </div>
                <div class="table-responsive p-2" id="table_result_search">
                    <table class="table table-bordered table-edit" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID Filament</th>
                                <th>Filament</th>
                                <th>N° Bobine</th>
                                <th>Stock</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
							$nbBobine = 0; $poidsTotal = 0; $valeur = 0;
							foreach($lstStock as $data){
							$nbBobine++;
							$poidsTotal += $data['stock'];
							?>
                            <?php $filament = $Imprimante->getFilament('id = "' . $data['id_filament'] . '"'); ?>
                            <tr onclick="show_data_edit('<?=URLADMIN?>', '<?=$module?>', '<?=$page.'-edit'?>', '<?=$data['id']?>')" title="Identifiant: <?=$data['id']?>">
                                <th><?=$data['id_filament']?></th>
                                <th><?= $filament['reference'] ?> - <?= $filament['fabricant'] ?> - <?= $filament['designation'] ?></th>
                                <th><?=$data['num_bobine']?></th>
                                <?php 
                                if ($data['stock'] <= 50) echo "<th class=\"bg-danger text-light\">{$data['stock']}</th>";
                                elseif ($data['stock'] <= 100) echo  "<th class=\"bg-warning text-light\">{$data['stock']}</th>";
                                else echo "<th>{$data['stock']}</th>";
                                ?>
                                <th><i class="fas fa-times" onclick="showDeleteModal('<?=$module.'/'.$page.'-delete-'.$data['id'].'/'?>')"></th>
								<?php
									$valeur += ($data['stock']*$filament['prix'])/100;
									?>
                            </tr>
                            <?php } ?>
							<tr>
								<th class="text-center">Quantité : <?=$nbBobine?></th>
								<th colspan="2" class="text-center">Valeur : <?=round($valeur)?> € - Revente ~ <?=round($valeur*10)?> €</th>
								<th class="text-center"><?=$poidsTotal?> gr</th>
							</tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="card shadow mb-4" id="card-edit">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Ajouter</h6>
                </div>
                <div class="card-body">
                    <form action="<?=$module.'/'.$page.'-add-0/'?>" method="POST">
                        <?php
                            foreach($tableau as $form){
                                if($form['print']){
                                    if($form['type'] == "textarea"){
                                        echo '<h5 class = "mt-3">'.$form['titre'].'</h5>';
                                        echo '<textarea name="'.$form['name'].'" rows = "4" class = "form-control bg-light border-1 small" ';
                                        if($form['required'] == true) echo "required";
                                        echo '></textarea>';
                                    }
                                    if($form['type'] == "text" || $form['type'] == "mail" || $form['type'] == "tel"){
                                        echo '<h5 class = "mt-3">'.$form['titre'].'</h5>';
                                        echo '<input type="'.$form['type'].'" name="'.$form['name'].'" class="form-control bg-light border-1 small"';
                                        if($form['required'] == true) echo "required";
                                        echo '>';
                                    }
                                    if($form['type'] == "select"){
                                        echo '<h5 class = "mt-3">'.$form['titre'].'</h5>';
                                        echo '<select name="'.$form['name'].'" class="form-control bg-light border-1 small"';
                                        if($form['required'] == true) echo "required";
                                        echo '>';
                                        foreach($form['option'] as $option){
                                            echo '<option value="'.$option['value'].'">'.$option['nom'].'</option>';
                                        }
                                        echo '</select>';
                                    }
                                }
                            }
                        ?>
                        <div class="text-center">
                            <input type="submit" name="add" value="Ajouter" class="mt-3 btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>