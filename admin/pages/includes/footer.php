                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Made by 3D ACCESS</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <!-- Modal -->
    <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5><i class="fas fa-exclamation-triangle text-danger"></i> ATTENTION <i class="fas fa-exclamation-triangle text-danger"></i></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>Vous êtes sur le point de supprimer un élément du site, êtes-vous sur ?</h5>
                    <div class="row mt-5">
                        <div class="col-6 text-center">
                            <button type="button" class="btn text-white bg-danger" data-dismiss="modal">Annuler</button>
                        </div>
                        <div class="col-6 text-center">
                            <a href="" id="urlModalDelete" class="btn bg-success text-white text-right">Supprimer</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="lib/vendor/jquery/jquery.min.js"></script>
    <script src="lib/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    
    <script src="lib/js/bootstrap-select.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="lib/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="lib/js/sb-admin-2.min.js"></script>


    <!-- Page level plugins -->
    <script src="lib/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="lib/js/demo/chart-area-demo.js"></script>
    <script src="lib/js/demo/chart-pie-demo.js"></script>
    <script src="lib/js/print-js.js"></script>
    
    
    <script>
    $( "#search_submit" ).click(function() {
        var idProduit;
        
        
        search_header = document.getElementById("search_header");
        var request = 'search_header='+search_header.value+'&module=<?=$_SESSION['monModule']['module']?>&page=<?=$_SESSION['monModule']['page']?>';

        $.ajax({
            data: request,
            url: '<?=URLADMIN?>pages/templates/contenu/ajax-texte-table.php',
            method: 'POST',
            success: function(msg) {
                $("#table_result_search").empty();
                $("#table_result_search").append(msg);
            }
        });
    });
    
    </script>
</body>

</html>
