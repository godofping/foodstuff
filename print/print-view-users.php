<?php 
include_once("../connection.php");
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body style="text-align: center; font-family: arial;" onload="window.print()">
<h1>View Users</h1>
<table align="center" border="1px;">
	<thead>
                <tr>
                  <th>User ID</th>
                  <th>Full Name</th>
                  <th>User Level</th>
                  <th>Username</th>
                
                  
                </tr>
              </thead>
              <tbody>
              <?php 
              $qry = mysqli_query($connection,"select * from user_view where isdeleted = 0");
              while ($result = mysqli_fetch_assoc($qry)) {
                ?>
                <tr>
                  <td><?php echo $result['userid']; ?></td>
                  <td><?php echo $result['fullname']; ?></td>
                  <td><?php if ($result['userlevel'] == 1) {
                   echo "Owner/Admin";
                  }else {
                    echo "Secretary";
                  } ?></td>
                  <td><?php echo $result['username']; ?></td>
                 
                </tr>

              <?php } ?>
                
              </tbody>
            </table>



</body>
</html>