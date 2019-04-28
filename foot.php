</div>
<div id="displaynotification"></div>
    <!-- /content panel -->
    <!-- bottom footer -->
    <footer class="content-footer" style="background-color: #6164c1 !important;">
      <nav class="footer-right">
        <ul class="nav">
          <li>
            <a style="color:white;" href="javascript:;">Copyright © 2017 D' Little Baker's FOODSTUFF All rights reserved.</a>
          </li>
        </ul>
      </nav>

    </footer>
    <!-- /bottom footer -->

  </div>
  <!-- build:js({.tmp,app}) scripts/app.min.js -->
  <script src="scripts/helpers/modernizr.js"></script>
  <script src="vendor/jquery/dist/jquery.js"></script>
  <script src="vendor/bootstrap/dist/js/bootstrap.js"></script>
  <script src="vendor/fastclick/lib/fastclick.js"></script>
  <script src="vendor/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
  <script src="scripts/helpers/smartresize.js"></script>
  <script src="scripts/constants.js"></script>
  <script src="scripts/main.js"></script>
  <!-- endbuild -->
  <!-- page scripts -->
  <script src="vendor/datatables/media/js/jquery.dataTables.js"></script>
  <!-- end page scripts -->
  <!-- initialize page scripts -->
  <script src="vendor/datatables/media/js/datatables.js"></script>
  <script type="text/javascript">
    $('.datatable').dataTable({
      
    });
  </script>
  <!-- end initialize page scripts -->
   <!-- initialize page scripts -->
  <script type="text/javascript">
    $("[data-toggle=tooltip]").tooltip();
    $("[data-toggle=popover]")
      .popover()
      .click(function (e) {
        e.preventDefault();
      });
  </script>
  <!-- end initialize page scripts -->
    <!-- initialize page scripts -->
  <script type="text/javascript">
    $("[data-toggle=tooltip]").tooltip();
    $("[data-toggle=popover]")
      .popover()
      .click(function (e) {
        e.preventDefault();
      });
  </script>
  <!-- end initialize page scripts -->


<script type="text/javascript">
    
$(document).ready(function checknoti(){
    var feedback = $.ajax({
        type: "POST",
        url: "check-noti.php",
        async: false
    }).complete(function(){
        setTimeout(function(){checknoti();}, 5000);
    }).responseText;

    $('#displaynotification').html(feedback);
});

</script>

<script language="javascript">
    function printPage(areaID){
    var printContent = document.getElementById(areaID);
    var WinPrint = window.open('', '', 'width=900,height=650');
    WinPrint.document.write(printContent.innerHTML);
    WinPrint.document.close();
    WinPrint.focus();
    WinPrint.print();
    WinPrint.close();
}
</script>



</body>

</html>