<?php
include_once("connection.php");



$qry = mysqli_query($connection, "SELECT * FROM order_table WHERE ISSEEN = 0");
 $datetimenow = date("Y-m-d H:i:s");

while($result = mysqli_fetch_assoc($qry))
{

   if ($result['ordertype'] == 1 and ($result['isapproved'] == 1 or $result['isapproved'] == 4 or $result['isapproved'] == 5)) {
    
     $alarmtime = date("Y-m-d H:i:s", strtotime( $result['datetimeofpickup']. "-10 minutes"));

      if($datetimenow > $alarmtime)
      { ?>
          <script type="text/javascript">
            if ("Notification" in window) {
              let ask = Notification.requestPermission();
              ask.then (permission => 
              {
                if (permission === "granted") {
                  let msg = new Notification("Alarm!", {
                    body: "Order id <?php echo $result['orderid']; ?> is about to pick up at <?php echo $result['datetimeofpickup']; ?>",
                    icon: "images/foodstufflogo.jpg"
                  });
                  msg.addEventListener("click", event =>
                  {
                    window.open("view-ordering-and-booking.php?in=default");
                  });
                }
              });
            }
          </script>

      <?php }
      mysqli_query($connection, "update order_table set ISSEEN = 1 where orderid = '" . $result['orderid'] . "'");
  
   }

   if ($result['ordertype'] == 2 and ($result['isapproved'] == 1 or $result['isapproved'] == 4 or $result['isapproved'] == 5)) {
  
     $alarmtime = date("Y-m-d H:i:s", strtotime( $result['datetimeofpickup']. "-1 hour"));

      if($datetimenow > $alarmtime)
      { ?>
          <script type="text/javascript">
            if ("Notification" in window) {
              let ask = Notification.requestPermission();
              ask.then (permission => 
              {
                if (permission === "granted") {
                  let msg = new Notification("Alarm!", {
                    body: "Order id <?php echo $result['orderid']; ?> is about to pick up at <?php echo $result['datetimeofpickup']; ?>",
                     icon: "images/foodstufflogo.jpg"
                  });
                  msg.addEventListener("click", event =>
                  {
                  
                    window.open("view-bills-of-customer.php");
                  });
                }
              });
            }
          </script>

      <?php }
      mysqli_query($connection, "update order_table set ISSEEN = 1 where orderid = '" . $result['orderid'] . "'");
  
   }

}


$qry = mysqli_query($connection, "SELECT * FROM order_table WHERE isapproved = 0 and isnew = 0");
 $datetimenow = date("Y-m-d H:i:s");

while($result = mysqli_fetch_assoc($qry))
{ ?>

  <script type="text/javascript">
            if ("Notification" in window) {
              let ask = Notification.requestPermission();
              ask.then (permission => 
              {
                if (permission === "granted") {
                  let msg = new Notification("New Order!", {
                    body: "Order id <?php echo $result['orderid']; ?>",
                    icon: "images/foodstufflogo.jpg"
                  });
                  msg.addEventListener("click", event =>
                  {
                    window.open("view-ordering-and-booking.php?in=pending");
                  });
                }
              });
            }
  </script>


<?php 
mysqli_query($connection, "update order_table set isnew = 1 where orderid = '" . $result['orderid'] . "'");

}
?>
