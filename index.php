<?php 
    include 'inc/header.php';
    include "Config.php";
    include 'Database.php';
?>
<?php 
    $db = new Database();
    $query = "SELECT * FROM tbl_user";
    $read = $db->select($query);
    
?>
<?php 
    if(isset($_GET["msg"])){
        echo "<span style='color:green;'>".$_GET["msg"]."</span>";
    }
?>
<table class="tblone">
    <tr>
        <th>No</th>
        <th>Image</th>
        <th>Name</th>
        <th>Email</th>
        <th>Skill</th>
        <th>Action</th>
    </tr>
    <?php if($read){?>
        <?php $i=0; while($row = $read->fetch_assoc()){ $i++;?>
    <tr>
        <td><?php echo $i; ?></td>
        <td><img class="p-image" src="<?php echo $row["image"]; ?>" alt="<?php echo $row["name"]; ?>"></td>
        <td><?php echo $row["name"]; ?></td>
        <td><?php echo $row["email"]; ?></td>
        <td><?php echo $row["skill"]; ?></td>
        <td><a href="update.php?id=<?php echo urlencode($row['id']); ?>">Edit</a></td>
    </tr>
    <?php } ?>
    <?php }else{?>
        <p>Data is not available!</p>
        <?php } ?>
</table>
<a href="create.php">Create</a>

		
		









		

<?php include 'inc/footer.php'; ?>