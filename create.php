<?php 
    include 'inc/header.php';
    include "Config.php";
    include 'Database.php';
?>
<?php 
    $db = new Database();
    if(isset($_POST["submit"])){
        $name = mysqli_real_escape_string($db->link,$_POST["name"]);
        $email = mysqli_real_escape_string($db->link,$_POST["email"]);
        $skill = mysqli_real_escape_string($db->link,$_POST["skill"]);

        $parmited = array("jpg", "jpeg", "png");
        $file_name = $_FILES["image"]["name"];
        $file_size = $_FILES["image"]["size"];
        $file_tmp_name = $_FILES["image"]["tmp_name"];

        $divi = explode(".", $file_name);
        $file_extn = end($divi);
        $unique_image  = substr(md5(time()), 0, 10).".".$file_extn;
        $uploaded_image = "uploads/".$unique_image;
        
        
        if($name == "" || $email == "" || $skill == ""){
            $error = "Field must not be empty";
        }elseif($file_size > 1048576){
            $error = "Upload image size should be 1 MB";
        }elseif(in_array($file_extn, $parmited) == false){
            $error = "You can upload only:-".implode(", ", $parmited);
        }else{
            move_uploaded_file($file_tmp_name, $uploaded_image);
            $query = "INSERT INTO tbl_user(name,email,skill,image) VALUES('$name', '$email', '$skill', '$uploaded_image')";
            $create = $db->insert($query);
        }

    }
    
?>

<?php 
    if(isset($error)){
        echo "<span style='color:red;'>".$error."</span>";
    }
?>

<form action="" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>Name: </td>
            <td><input type="text" name="name"></td>
        </tr>
        <tr>
            <td>Email: </td>
            <td><input type="text" name="email"></td>
        </tr>
        <tr>
            <td>Skill: </td>
            <td><input type="text" name="skill"></td>
        </tr>
        <tr>
            <td>Image: </td>
            <td><input type="file" name="image"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="Create"></td>
        </tr>
    </table>
</form>
<a href="index.php">Go Back</a>













<?php include 'inc/footer.php'; ?>