<?php 
include_once("../connection.php");
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body style="text-align: center; font-family: arial;" onload="window.print()">
<h1>List of Customer</h1>
	<table align="center" border="1px;">
              <thead>
                <tr>
                  <th>Customer ID</th>
                  <th>Full Name</th>
                  <th>Address</th>
                  <th>Email Address</th>
                  <th>Contact Number</th>
                  <th>Status</th>
                  <th>Username</th>
             
                </tr>
              </thead>
              <tbody>
              <?php 
              $qry = mysqli_query($connection,"select * from customer_view where isdeleted = 0");
              while ($result = mysqli_fetch_assoc($qry)) {
                ?>
                <tr>
                  <td><?php echo $result['customerid']; ?></td>
                  <td><?php echo $result['fullname']; ?></td>
                  <td><?php echo $result['address']; ?></td>
                  <td><?php echo $result['emailaddress']; ?></td>
                  <td><?php echo $result['contactnumber']; ?></td>
                  <td><?php if ($result['isactivated'] == 1)
                  {
                    echo "Activated";
                  }else {
                    echo "Not Activated";
                  }?></td>
                  <td><?php echo $result['username']; ?></td>
                 
                </tr>

              <?php } ?>
                
              </tbody>
            </table>



</body>
</html>