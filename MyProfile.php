<?php
session_start();
include 'include/database.php';
?>

<html>
<?php
include 'include/navbar.php';
?>


<form action="" method="POST">
    <?php
        $sql = "select * from registeration where id = '$_SESSION[ID]'";
        $res = $db -> query($sql);
        if($res -> num_rows > 0){
            if($row = $res -> fetch_assoc()){
                echo '
                Hello World!!!
                ';
            }
        }
    ?>

</form>




<?php
include 'include/footer.php';
?>
</html>