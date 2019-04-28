<?php
include_once("../connection.php");


$qry = mysqli_query($connection, "SELECT * FROM order_table WHERE isseenbycusomter = 0 and customerid = '" . $_SESSION['customerid'] . "'");


while($result = mysqli_fetch_assoc($qry))
{


?>


<script type="text/javascript">
            if ("Notification" in window) {
              let ask = Notification.requestPermission();
              ask.then (permission => 
              {
                if (permission === "granted") {
                  let msg = new Notification("Alarm!", {
                    body: "Order id <?php echo $result['orderid']; ?> is <?php   if ($result['isapproved'] == 0) {
                    echo "Pending";
                  }
                  elseif ($result['isapproved'] == 1) {
                    echo "Approved";
                  }
                  elseif ($result['isapproved'] == 2) {
                    echo "Cancelled";
                  }
                  elseif ($result['isapproved'] == 3) {
                    echo "Claimed";
                  }
                  elseif ($result['isapproved'] == 4) {
                    echo "Preparing";
                  }
                  elseif ($result['isapproved'] == 5) {
                    echo "Ready to pickup";
                  } ?>",
                    icon: "../images/foodstufflogo.jpg"
                  });
                  msg.addEventListener("click", event =>
                  {
                    window.open("orders.php");
                  });
                }
              });
            }
</script>

<?php
  // mysqli_query($connection, "update order_table set isseenbycusomter = 1 where orderid = '" . $result['orderid'] . "'");

 } ?>
