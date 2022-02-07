<?php 
    include 'inc/header.php';
    include "Config.php";
    include 'Database.php';
?>
<?php 
    $db = new Database();
    $id = $_GET["id"];
    
    $sql = "SELECT * FROM tbl_user WHERE id=$id";
    $getData = $db->select($sql)->fetch_assoc();

    if(isset($_POST["update"])){
        $name = mysqli_real_escape_string($db->link,$_POST["name"]);
        $email = mysqli_real_escape_string($db->link,$_POST["email"]);
        $skill = mysqli_real_escape_string($db->link,$_POST["skill"]);

        if($name == "" || $email == "" || $skill == ""){
            $error = "Field must not be empty";
        }else{
            $query = "UPDATE tbl_user SET name = '$name', email='$email', skill='$skill' WHERE id=$id";
            $update = $db->update($query);
        }

    }

    if(isset($_POST["delete"])){
        $sql = "SELECT * FROM tbl_user WHERE id=$id";
        $getImage = $db->select($sql);
        if($getImage){
            while($delimg = $getImage->fetch_assoc()){
                $image = $delimg['image'];
                unlink($image);
            }
        }
        $query = "DELETE FROM tbl_user WHERE id=$id";
        $delete = $db->delete($query);
        if($delete){
            echo "Data Deleted";
        }
    }
?>

<?php 
    if(isset($error)){
        echo "<span style='color:red;'>".$error."</span>";
    }
?>

<form action="" method="post">
    <table>
        <tr>
            <td>Name: </td>
            <td><input type="text" name="name" value="<?php echo $getData['name']; ?>"></td>
        </tr>
        <tr>
            <td>Email: </td>
            <td><input type="text" name="email" value="<?php echo $getData['email']; ?>"></td>
        </tr>
        <tr>
            <td>Skill: </td>
            <td><input type="text" name="skill" value="<?php echo $getData['skill']; ?>"></td>
        </tr>
        <tr>
            <td>Image: </td>
            <td><img class="p-image" src="<?php echo $getData["image"]; ?>" alt="<?php echo $getData["name"]; ?>"></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" name="update" value="Update">
                <input type="reset" name="clear" value="Clear">
                <input type="submit" name="delete" value="Delete">
            </td>
        </tr>
    </table>
</form>
<a href="index.php">Go Back</a>













<?php include 'inc/footer.php'; ?>