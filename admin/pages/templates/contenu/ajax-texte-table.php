<?php
include $_SERVER['DOCUMENT_ROOT'].'/parametres/constante.php';
include URLADMIN.'parametres/constante.php';

$search = $Tools->data_secure($_POST['search_header']);
$module = $Tools->data_secure($_POST['module']);
$page = $Tools->data_secure($_POST['page']);

$monModule = $Module->getModule('module = "'.$module.'" AND page = "'.$page.'"');

$requete = str_replace("[[search]]", $search, $monModuleSearch['requete']);
$lstResultat = get_results("SELECT * FROM ".$monModule['table_bdd']." WHERE ".$requete);

?>
<table class="table table-bordered table-edit" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nom</th>
            <th>Page</th>
            <th>Identifiant</th>
            <th>Statut</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($lstResultat as $data){ ?>
        <tr onclick="show_data_edit('<?=URLADMIN?>', '<?=$module?>', '<?=$page.'-edit'?>', '<?=$data['id']?>')" title="Identifiant: <?=$data['id']?>">
            <th><?=$data['id']?></th>
            <th><?=$data['nom']?></th>
            <th><?=$Pages->getPages('id="'.$data['id_page'].'"')['identifiant']?></th>
            <th><?=$data['identifiant']?></th>
            <th class="text-center">
                <?php 
                    if($data['statut'] == 1) echo '<div class="bg-success text-white">Activé</div>';
                    else echo '<div class="bg-danger text-white">Désactivé</div>';
                ?>
            </th>
            <th><i class="fas fa-times" onclick="showDeleteModal('<?=$module.'/'.$page.'-delete-'.$data['id'].'/'?>')"></th>
        </tr>
        <?php } ?>
    </tbody>
</table>