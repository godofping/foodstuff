<?php 
include_once("../connection.php");
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body style="text-align: center; font-family: arial;" onload="window.print()">
<h1>Customer Reviews (<?php echo $_GET['date']; ?>)</h1>
	<table align="center" border="1px;">
              <thead>
                <tr>
                  <th>Review ID</th>
                  <th>Title</th>
                  <th>Review Date</th>
                  <th>Full Name</th>
                  <th>Comment</th>
                  
                  
                </tr>
              </thead>
              <tbody>
              <?php 
              $qry = mysqli_query($connection,"select * from review_view where reviewdate = '" . $_GET['date'] . "'");
              while ($result = mysqli_fetch_assoc($qry)) {
                ?>
                <tr>
                  <td><?php echo $result['reviewid']; ?></td>
                  <td><?php echo $result['reviewtitle']; ?></td>
                  <td><?php echo $result['reviewdate']; ?></td>
                  <td><?php echo $result['fullname']; ?></td>
                  <td><?php echo $result['comment']; ?></td>
                  
                </tr>

              <?php } ?>
                
              </tbody>
            </table>



</body>
</html>