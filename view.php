<?php
include 'connection.php';
include_once "include/function_pagination.php";
if(isset($_GET['id']))
{
    $reg_id = $_GET['id'];
    $delete = mysql_query("DELETE FROM `registration` WHERE reg_id=".$reg_id." ");
    if($delete)
    {
        echo "<script>alert('Deleted successfully.');
            window.location.href = 'view.php';
        </script>";
        
    }
}

$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
if ($page <= 0) $page = 1;
 
$per_page = 2; // Set how many records do you want to display per page.
 
$startpoint = ($page * $per_page) - $per_page;

//if($_GET['type']!="")
//{
//    $type = "WHERE type=".$_GET['type'];
//}

//$statement = "`registration` {$type} ORDER BY `reg_id` DESC"; // Change `records` according to your table name.

$statement = "`registration` ORDER BY `reg_id` DESC"; // Change `records` according to your table name.
  
$select_query = ("SELECT * FROM {$statement} LIMIT {$startpoint} , {$per_page}");


?>
<html>
    <head>
        <style>
            .pagination ul li{float:left; list-style:none; padding:10px; margin:5px; border:1px solid;}
        </style>
    </head>
    <body>
    <center>
        <form action="" method="post" enctype="multipart/form-data">
            <table style="width:50%" border="1">
                <tr>
                    <th>Welcome</th>
                </tr>
                <tr>
                    <td>First Name</td>
                    <td>Last Name</td>
                    <td>Email</td>
                    <td>Phone No</td>
                    <td>Gender</td>
                    <td>Country</td>
                    <td>Image</td>
                    <td>Edit</td>
                    <td>Delete</td>
                </tr>
                
                    <?php 
                        $select = mysql_query($select_query);
                        if(mysql_num_rows($select)>0)
                        {
                            while($row = mysql_fetch_array($select))
                            {
                                
                                echo "<tr>";
                                echo '<td>'.$row['first_name'].'</td>';
                                echo '<td>'.$row['last_name'].'</td>';
                                echo '<td>'.$row['email'].'</td>';
                                echo '<td>'.$row['phone_no'].'</td>';
                                echo '<td>'.$row['gender'].'</td>';
                                echo '<td>'.$row['country'].'</td>';
                                echo '<td><img src="uploads/'.$row['image'].'"  height="42" width="42"></td>';
                                echo '<td> <a href="index.php?id='.$row['reg_id'].'">Edit</a> </td>';
                                ?>
                                <td> <a href="<?php echo "view.php?id=".$row['reg_id'];?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a> </td>
                                <?php
                                echo "</tr>";
                            }
                        }else{
                            echo "<tr>";
                            echo '<td>No Record Found</td>';
                            echo "</tr>";
                        }
                    ?>
            </table>
        </form>
        
        <div class="pagination">
        <?php
//            if($_GET['type']!="")
//            {
//                $url="blogs.php?type=".$_GET['type']."&";
//            }
//            else
//            {
                $url='view.php?';
//            }
            echo pagination($statement,$per_page,$page,$url);
        ?>
        </div>
    </center>
</body>
</html>
