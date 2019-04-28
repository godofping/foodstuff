
<?php
$connection = mysqli_connect("localhost","root","vertrigo");
mysqli_select_db($connection,"micsdb");

$search = mysqli_real_escape_string($connection,htmlentities(trim($_POST['searchterm'])));

$find_search = mysqli_query($connection, "select * from categorytable where acivate = 1 and (NameOfCategory like '%$search%')");



if (mysqli_num_rows($find_search) == 0) {
  ?>

                   <!--alert-icons-->
                   <div style="padding-top: 40px;"></div>
                  
               <b><p>No results :(</p></b>
              
                  
 
               
  </div>

  <?php
}
else
{

  ?>
  <table>
    <thead>
      <tr>
        <th data-field="NameOfCategory">Category Name</th>
        <th data-field="Action">Action</th>
        
      </tr>
    </thead>

    <tbody>
  <?php
  while($row = mysqli_fetch_assoc($find_search))
{
  ?>

           <tr>
              <td><?php echo $row['NameOfCategory']; ?></td>
              <td><a href="edit-category.php?CategoryId=<?php echo $row['CategoryId'] ?>" class="btn-flat waves-effect pink accent-2 white-text">Edit</a> <a href="delete-category.php?CategoryId=<?php echo $row['CategoryId'] ?>" onclick="return confirm('Are you sure you want to delete this item?');" class="btn-flat waves-effect pink accent-2 white-text">Delete</a></td>
            </tr>

     

  <?php
  
  
}
?>

                    </tbody>
                  </table>
<?php
}

?>
