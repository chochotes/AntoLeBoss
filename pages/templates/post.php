<?php

get_head();
get_header();
$identifiant = $Tools->data_secure($_GET['identifiant']);
$article = $Blog->getBlog("identifiant='".$identifiant."' AND statut=1");
    
?>
<div class="breadcrumb-area pt-35 pb-35 bg-gray">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li>
                    <a href="blog/">Blog</a>
                </li>
                <li class="active"><?=$article['titre']?></li>
            </ul>
        </div>
    </div>
</div>
<div class="blog-area pt-100 pb-100">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-lg-9">
                <div class="blog-details-wrapper mr-20">
                    <div class="blog-details-top">
                        <div class="blog-details-img">
                            <img alt="" src="<?=URLSITEWEB.$article['image']?>">
                        </div>
                        <div class="blog-details-content">
                            <h3><?=$article['titre']?></h3>
                            <div class="blog-details-meta">
                                <ul>
                                    <li><?=$Tools->convert_date_to_print($article['date_online'])?></li>
                                </ul>
                            </div>
                            <?=$article['contenu']?>
                        </div>
                    </div>
                    <div class="tag-share">
                        <div class="blog-share">
                            <div class="share-social">
                                <?php
                                    $url_facebook = URLSITEWEB.'blog/post/'.$post['url'].'/';
                                    $url_facebook = str_replace(":", "%3A", $url_facebook);
                                    $url_facebook = str_replace("/", "%2F", $url_facebook);
                                ?>
                                <ul>
                                    <li>
                                        <a href="https://www.facebook.com/sharer.php?u=<?=$url_facebook
                                        ?>" target="_blank" id="share-facebook"><i class="fab fa-facebook"></i> Partager</a>
                                    </li>
                                    <li>
                                        <a href="https://twitter.com/share?ref_src=<?=$url_facebook
                                        ?>" target="_blank" id="share-twitter"><i class="fab fa-twitter"></i> Partager</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    get_footer();
?>