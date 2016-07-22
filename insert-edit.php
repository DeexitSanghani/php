<?php
error_reporting(0);
include 'connection.php';

if(isset($_GET['id']) && $_GET['id']!="")
{
    $reg_id = $_GET['id'];
    $select_query = mysql_query("SELECT * FROM `registration` WHERE reg_id='".$reg_id."'");
    $row = mysql_fetch_array($select_query);
}
if(isset($_POST['submit']))
{
   $first_name = $_POST['first_name'];
   $last_name = $_POST['last_name'];
   $email = $_POST['email'];
   $phone_no = $_POST['phone_no'];
   $gender = isset($_POST["gender"])?stripslashes($_POST["gender"]):"";
   $country = isset($_POST["country"])?stripslashes($_POST["country"]):"";
   
    
    if($_FILES['image']['name']!=""){
        $file_name = rand(1000,100000)."-".$_FILES['image']['name'];
        $temp_name = $_FILES['image']['tmp_name'];
        $folder="uploads/";
        if(move_uploaded_file($temp_name,$folder.$file_name))
        {
            $image = $file_name;
        }
    }
    else
    {
       $image = $row['image'];
    }
   
    if($_GET['id'])
    {
        $update = mysql_query("UPDATE `registration` SET
                            `first_name`='".$first_name."',`last_name`='".$last_name."',
                            `email`='".$email."',`phone_no`='".$phone_no."',
                            `gender`='".$gender."',`country`='".$country."',
                            `image`='".$image."' WHERE reg_id='".$_GET['id']."' ");
        if($update=== TRUE)
        {
            echo "<script>alert('Updated successfully.');
                        window.location.href = 'view.php';
                    </script>";
        }
        
    }else
    {
        $query = mysql_query("INSERT INTO `registration`(`reg_id`, `first_name`, `last_name`, `email`, `phone_no`, `gender`, `country`, `image`) VALUES
                           ('NULL','".$first_name."','".$last_name."','".$email."','".$phone_no."','".$gender."','".$country."','".$image."')");
        if($query === TRUE)
        {
            echo "<script>alert('Inserted successfully.');
                    window.location.href = 'index.php';
                </script>";
        }
    }
    
   
}


?>
<html>
    <head>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.0.min.js"> </script>
        <style>
            .err{color:red; width:70%; float:left;}
        </style>
    </head>
    <body>
    <center>
        <form action="" method="post" name="registration" enctype="multipart/form-data">
            <table style="width:50%">
                <tr>
                    <th>Welcome</th>
                </tr>
                <tr>
                    <td>Enter Your First Name :-</td>
                    <td><input type="text" name="first_name" id="first_name" value="<?php echo $row['first_name']; ?>" ></td>
                </tr>
                <tr>
                    <td>Enter Your Last Name :-</td>
                    <td><input type="text" name="last_name" id="last_name" value="<?php echo $row['last_name']; ?>" ></td>
                </tr>
                <tr>
                    <td>Enter Your Email :-</td>
                    <td><input type="text" name="email" id="email" value="<?php echo $row['email']; ?>" ></td>
                </tr>
                <tr>
                    <td>Enter Your Phone No :-</td>
                    <td><input type="text" name="phone_no" id="phone_no" value="<?php echo $row['phone_no']; ?>" ></td>
                </tr>
                <tr>
                    <td>Select Your Gender :-</td>
                    <td><input type="radio" name="gender" value="male" id="gendermale" <?php if($row['gender']=='male'){echo "checked='checked'";} ?> >Male &nbsp;
                        <input type="radio" name="gender" value="female" id="genderfemale" <?php if($row['gender']=='female'){echo "checked='checked'";} ?> >Female</td>
                </tr>
                <tr>
                    <td>Select Country :-</td>
                    <td> <select name="country" id="country">
                        <option <?php if($row['country']=="india"){ echo "selected='selected'"; } ?>  value="india">India</option>
                        <option <?php if($row['country']=="us"){ echo "selected='selected'"; } ?> value="us">US</option>
                        <option <?php if($row['country']=="uk"){ echo "selected='selected'"; } ?> value="uk">UK</option>
                        <option <?php if($row['country']=="caneda"){ echo "selected='selected'"; } ?> value="caneda">caneda</option>
                    </select> </td>
                </tr>
                <tr>
                    <td>Select Image:-</td>
                    <td><?php 
                        if($_GET['id'])
                        {
                            echo '<img src="uploads/'.$row['image'].'" height="42" width="42">';
                        }
                    ?></td>
                    <td><input type="file" name="image" id="image"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Submit" onclick="return validation();" name="submit"></td>
                </tr>
            </table>
        </form>
    </center>
<script>
function validation()
{
	jQuery('.err').remove();
	var temp = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	var t = /[0-9 -()+]+$/;
	
	var first_name = registration.first_name.value;
	if(first_name=="") { 
            jQuery("#first_name").after("<p class='err'>Please enter First Name.</p>");
            registration.first_name.focus();
            return false;
	}
	
        var last_name = registration.last_name.value;
	if(last_name=="") { 
            jQuery("#last_name").after("<p class='err'>Please enter Last Name.</p>");
            registration.last_name.focus();
            return false;
	}
        
        
// email vaildation        
	var email = registration.email.value;
	if(email=="") { 
            jQuery("#email").after("<p class='err'>Please enter email.</p>");
            registration.email.focus();
            return false;
	}
	
	if((email.trim()=="")  || (!temp.test(email)))
	{
            if(/^\s/.test(email))
            {
                jQuery("#email").after("<p class='err'>Email address should not start with space.</p>");
                registration.email.focus();
                return false;
            }else{ 
                jQuery("#email").after("<p class='err'>The e-mail address you entered appears to be incorrect.</p>");
                registration.email.focus();
                return false;
            }
	}
        
// phone number validation
        var phone_no = registration.phone_no.value;
	if(phone_no=="") { 
		jQuery("#phone_no").after("<p class='err'>Please enter Telephone.</p>");
		registration.phone_no.focus();
		return false;
	}else if(!t.test(phone_no)){
                jQuery("#phone_no").after("<p class='err'>Please enter Correct Telephone.</p>");
		registration.phone_no.focus();
		return false;
        }
        
// gender radio button validation
        if(jQuery('input[name=gender]:checked').length<=0)
        {
            jQuery("#genderfemale").after("<p class='err'>Please select gender.</p>");
            registration.genderfemale.focus();
            return false;
        }
        
}
</script>
</body>
</html>
