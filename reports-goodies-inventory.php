<?php 
// this line includes all the html,css and php codes for the header
include_once('connection.php');
$_SESSION['page'] = "reports-goodies-inventory";
include('head.php'); 
?>
      <div class="main-content">
        <div class="page-title">
          <div class="title">Reports</div>
          <div class="sub-title">Goodies Inventory</div>
        </div>

        <div class="card bg-white">
          <div class="card-header">
          
          </div>
          <div class="card-block">

    

            <!-- starthere -->
              <div id="contents"></div>
            <!-- end here -->

          </div>
        </div>
      </div>
      <!-- /main area -->

      <!-- start modal -->
      <div class="modal bs-modal-sm" id="changedatemodal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title">Change date to view inventory history</h4>
            </div>
            <div class="modal-body">
             <form action="controller.php" method="POST">
                <input class="form-control" type="date" value="<?php echo date('Y-m-d'); ?>" required="" name="date" max="<?php echo date('Y-m-d'); ?>">
                                 
            </div>
            <div class="modal-footer no-border">
              
              <input type="text" name="sourcepage" value="reports-goodies-inventory" hidden="">
              <button type="submit" class="btn btn-success" >Change</button>
             </form>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
             
            </div>
          </div>
        </div>
      </div>
      <!-- end modal -->
      

      <script type="text/javascript">
        function printData()
        {
           var divToPrint=document.getElementById("datatabletoprint");
           newWin= window.open("");
           newWin.document.write(divToPrint.outerHTML);
           newWin.print();
           newWin.close();
        }
      </script>

  


<script type="text/javascript">

    window.onload = function () { 
    $(function res() {
        var date = <?php if (isset($_GET['date'])) { echo json_encode($_GET['date']); } else { echo json_encode(date('Y-m-d')); } ?>;


        $.post('getTable.php',{date:date},
        function(data)
        {
            $('#contents').html(data);
        }); 
        
    });
  }

setInterval(function() {
  $(function res() {
        var date = <?php if (isset($_GET['date'])) { echo json_encode($_GET['date']); } else { echo json_encode(date('Y-m-d')); } ?>;
       

        $.post('getTable.php',{date:date},
        function(data)
        {
            $('#contents').html(data);
        }); 
        
    });
}, 1000);
  


// $('#contents').load('getTable.php');


</script>
    
<?php
// this line includes all the javscript and html codes for the footer
 include('foot.php'); 
 ?>
    