            <!-- FOOTER LAYOUT_ELEMENT START-->
            <footer id="footer">2019 © All Rights Reserved by <a href="https://www.mattsenkumar.com" target="_blank">MattsenKumar LLC.</a></footer>
            <!-- FOOTER LAYOUT_ELEMENT END-->
        </div>
        <!-- PAGE WRAPPER END LAYOUT_ELEMENT-->

        <!-- Theme's External JS Files -->
        <!-- <script rel="javascript" src="assets/css/base.css"></script> -->
        <script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
        <!-- start export button js -->
        <script type="text/javascript" src="assets/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="assets/js/buttons.flash.min.js"></script>
        <script type="text/javascript" src="assets/js/jszip.min.js"></script>
        <script type="text/javascript" src="assets/js/pdfmake.min.js"></script>
        <script type="text/javascript" src="assets/js/vfs_fonts.js"></script>
        <script type="text/javascript" src="assets/js/buttons.html5.min.js"></script>
        <script type="text/javascript" src="assets/js/buttons.print.min.js"></script>
        <!-- end export button js -->
        <script type="text/javascript" src="assets/js/custom.js"></script>
        <script>
          $(document).ready(function(){
            $('ul li a').click(function(){
                $(this).parent().siblings().removeClass("active");
                $(this).parent().addClass("active");
            });
            });
            // $(document).ready(function(){
            //     $('[data-toggle="tooltip"]').tooltip();   
            // });
        </script>
    </body>
</html>