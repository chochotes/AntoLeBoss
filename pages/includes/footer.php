    </main>
    <footer class="footer-area bg-paleturquoise pt-100">
        <div class="container">
            <div class="footer-top-2 pb-20">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                        <div class="footer-widget mb-40">
                            <a href="#" class="footer-logo" ><img src="/media/logo/logo.svg" alt="logo site web" style="width: 20em; height: 15em;" ></a>
                            <?php /*
                            <div class="subscribe-style mt-45">
                                <p>Subscribe to our newsleter, Enter your emil address</p>
                                <div id="mc_embed_signup" class="subscribe-form mt-20">
                                    <form id="mc-embedded-subscribe-form" class="validate subscribe-form-style" novalidate="" target="_blank" name="mc-embedded-subscribe-form" method="post" action="http://devitems.us11.list-manage.com/subscribe/post?u=6bbb9b6f5827bd842d9640c82&amp;id=05d85f18ef">
                                        <div id="mc_embed_signup_scroll" class="mc-form">
                                            <input class="email" type="email" required="" placeholder="Enter your email...." name="EMAIL" value="">
                                            <div class="mc-news" aria-hidden="true">
                                                <input type="text" value="" tabindex="-1" name="b_6bbb9b6f5827bd842d9640c82_05d85f18ef">
                                            </div>
                                            <div class="clear">
                                                <input id="mc-embedded-subscribe" class="button" type="submit" name="subscribe" value="">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                             */ ?>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-4 col-6">
                        <div class="footer-widget mb-40 pl-50">
                            <div class="footer-title">
                                <h3>Nos produits</h3>
                            </div>
                            <div class="footer-list">
                                <ul>
                                    <li><a href="<?=URLSITEWEB?>catalogue/">Tous nos produits</a></li>
                                    <li><a href="<?=URLSITEWEB?>catalogue/fleurs/maison/exterieur">Pour l'exetérieur</li>
                                    <li><a href="<?=URLSITEWEB?>catalogue/fleurs/maison/interieur">Décoration intérieur</a></li>
                                    <li><a href="<?=URLSITEWEB?>catalogue/fleurs/saison/ete">Fleurs d'été</a></li>
                                    <li><a href="<?=URLSITEWEB?>catalogue/fleurs/saison/printemps">Fleurs de printemps</a></li>
                                    <li><a href="<?=URLSITEWEB?>catalogue/fleurs/saison/automne">Fleurs d'automne</a></li>
                                    <li><a href="<?=URLSITEWEB?>catalogue/fleurs/saison/hivers">Fleurs d'hivers</a></li>
                                    <li><a href="<?=URLSITEWEB?>sur-mesure/climat/chaud">Climat chaud</a></li>
                                    <li><a href="<?=URLSITEWEB?>sur-mesure/climat/froid">Climat Froid</a></li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-4 col-6">
                        <div class="footer-widget mb-40 pl-100">
                            <div class="footer-title">
                                <h3>Notre entreprise</h3>
                            </div>
                            <div class="footer-list">
                                <ul>
                                    <li><a href="mentions-legales/">Mentions légales</a></li>
                                    <li><a href="traitement-des-donnees/">Traitement des données</a></li>
                                    <li><a href="conditions-generales-de-ventes/">Conditions générales de ventes</a></li>
                                    <li><a href="faq/">FAQ</a></li>
                                    <li><a href="contact/">Contact</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom border-top-1 pt-20">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-5 col-12">
                        <div class="footer-social pb-20">
                            <a href="<?=URLFACEBOOK?>" target="_blank">Facebook</a>
                            <?php // <a href="#">Twitter</a> ?>
                            <a href="<?=URLINSTAGRAM?>" target="_blank">Instagram</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="copyright text-center pb-20">
                            <p>Copyright © <?= date('Y').' - '.NOMSITE ?></p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-3 col-12">
                        <div class="payment-mathod pb-20">
                            <p><?=NOMSITE?> l'impression 3D à votre porte.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>

<!-- All JS is here
============================================ -->

<!-- Popper JS -->
<script src="lib/js/popper.min.js"></script>
<!-- Plugins JS -->
<script src="lib/js/plugins.js"></script>
<!-- Ajax Mail -->
<script src="lib/js/ajax-mail.js"></script>
<!-- Main JS -->
<script src="lib/js/main.js"></script>

<!--    RECAPTCHA V3    -->
<script src="https://www.google.com/recaptcha/api.js"></script>
<script>
    function onSubmit(token) {
        document.getElementById("demo-form").submit();
    }
</script>



</body>
</html>