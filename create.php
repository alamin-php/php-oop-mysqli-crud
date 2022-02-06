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

        if($name == "" || $email == "" || $skill == ""){
            $error = "Field must not be empty";
        }else{
            $query = "INSERT INTO tbl_user(name,email,skill) VALUES('$name', '$email', '$skill')";
            $create = $db->insert($query);
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
            <td></td>
            <td><input type="submit" name="submit" value="Create"></td>
        </tr>
    </table>
</form>
<a href="index.php">Go Back</a>













<?php include 'inc/footer.php'; ?>