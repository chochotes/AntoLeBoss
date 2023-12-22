<?php
$lstFaq = $Faq->getLstFaq("statut = '1' ORDER BY position");
get_head();
get_header();
?>

<div class="breadcrumb-area pt-35 pb-35 bg-gray">
    <div class="container">
        <div class="breadcrumb-content text-center">
           <p class="font-weight-bold">FAQ</p>
        </div>
    </div>
</div>
<div class="container">
    <div class="row spacet-3" id="cgdu"><!--align-items-center-->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-5 text-center">
            <h1 style="">Vous avez des questions ?</h1>
        </div>
            <div class="col-lg-7 col-md-6 col-sm-12 col-xs-12 mt-5 mb-5">
            <h3 class="mb-4 mt-3 text-center">Qui sommes-nous ?</h3>                
            <div id="accordionExample">
                <?php foreach($lstFaq as $data){ ?>
                    <div class="faq-card" id="heading<?= $data['id']?>">
                        <button class="collapsed w-100 text-left font-weight-bold mb-2" type="button" data-toggle="collapse" data-target="#collapse<?= $data['id']?>" aria-expanded="false" aria-controls="collapse<?= $data['id']?>">
                            <?=$data['question']?>
                            <i class="fas fa-minus-circle"></i>
                        </button>
                    </div>

                    <div id="collapse<?= $data['id']?>" class="collapse" aria-labelledby="heading<?= $data['id']?>" data-parent="#accordionExample">
                        <div class="card-body">
                            <?=$data['reponse']?>
                        </div>
                    </div>                        
                <?php 
                } ?>
            </div>
        </div>
            <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12 mt-5 pl-5 mb-5">
                <div class="contact-from contact-shadow m-0">
                    <h3 class="mb-4 mt-3 text-center">Informations de contact</h3> 
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-xs-12 p-1 text-left">
                            <i class="fas fa-envelope-open-text pr-3"></i>
                            <a <a href="mailto:<?=CONTACTEMAIL?>"><?=CONTACTEMAIL?></a>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-xs-12 p-1 text-left">
                            <i class="fas fa-phone-square-alt pr-3"></i>
                            <a href="tel:<?=CONTACTTELEPHONE?>"><?=CONTACTTELEPHONE?></a>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-xs-12 p-1  text-left ">
                            <i class="fas fa-map-marked-alt pr-3"></i>
                            <a href="https://www.google.fr/maps/place/72+Rue+du+Professeur+Christian+Cabrol+E001,+80000+Amiens/@49.8821264,2.271265,17z/data=!3m1!4b1!4m5!3m4!1s0x47e78479f55b3c2d:0x1633c11d3e05b48c!8m2!3d49.882123!4d2.2734537">
                            <?=CONTACTADDRESS?></a>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-xs-12 mt-3 text-center"> 
                        <a class="btn btn-dark btn-lg btn-block" href="/contact">Nous contacter</a>
                    </div>
                </div>
            </div>
    </div>
</div>

<?php
    get_footer();
?>