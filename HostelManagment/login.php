<?php
session_start();
include 'include/database.php';
?>

<html>
<?php
include 'include/navbar.php';
?>

<?php
if(isset($_POST["submit"])){
    $eid= $_SESSION['ID'];
    $encrypted = md5($_POST["password"]);
    $sql = "select * from registeration where email = '{$_POST["email"]}' AND password = '{$encrypted}'";
    $res = $db -> query($sql);
    if($res-> num_rows > 0){
        $row = $res -> fetch_assoc();
        $_SESSION["ID"]=$row["ID"];
        header("location:editProfile.php");
        
        
    }
    else{
        echo "<p>Wrong Info</p>";
    }
}
?>

<br><br>
<form action="<?php echo $_SERVER["PHP_SELF"];?>" id="frm" enctype="multipart/form-data" method="POST">
    <div class="col d-flex justify-content-center"> 
        <div class="col-md-8">
            <div class="card">
                <div class="card-body bg-light">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Email</label>
                            <input type="email" placeholder="Enter Your Email" class="form-control" name="email" id="email"></input>
                        </div>

                        <div class="col-md-12">
                            <label>Password</label>
                            <input type="password" placeholder="Enter Your Password" class="form-control" name="password" id="password"></input>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="submit" class="form-control btn btn-primary" name="submit" id="submit" ></input>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>



<?php
include 'include/footer.php';
?>
</html>