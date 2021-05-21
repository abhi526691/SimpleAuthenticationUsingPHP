<?php
session_start();
include 'include/database.php';
if(!isset($_SESSION["ID"]))
{
	header("location:login.php");
}
?>


<?php
if(isset($_POST["submit"])){
    $eid = $_SESSION["ID"];
    $encrypted = md5($_POST["password"]);
    $regNo = $_POST["regNo"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $gender = $_POST["gender"];
    $email = $_POST["email"];
    $contactNo = $_POST["contactNo"];

    $sql = "update registeration set 
    regNo = ?,
    firstName = ?,
    lastName = ?,
    email = ?,
    gender = ?,
    contactNo = ?,
    password = ?,
    confirmPassword = ?
    where ID = ?
    ";
    $rec = $db -> prepare($sql);
    $rc = $rec -> bind_param('issssissi', $regNo, $fname, $lname, $email, $gender, $contactNo, $encrypted, $encrypted, $eid);
    $rec -> execute();
    echo "
    <script>alert('Updated Successfully'); </script>
    ";
}
?>

<html>


    <?php
    include 'include/navbar.php';
    ?>
<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post"  name="registration"  id="frm" enctype="multipart/form-data" onsubmit="if (document.getElementById('password').value != document.getElementById('Cpassword').value) { alert('Password and confirm password not matched'); return false; }">
    <!-- <div class="container col-md-12">
        <div class="form-group">
            <label> Reg No. </label>
            <input type="text" class="form-control" name="regNo" id="regNo" placeholder="Registration Number"></input>
        </div>
    </div> -->
    <br><br>

    <?php
    $sql = "SELECT * FROM registeration WHERE ID='$_SESSION[ID]'";
    $res = $db -> query($sql);
    if($res -> num_rows > 0){
        echo '<form action="'.$_SERVER["REQUEST_URI"].'" method="post">';
        if($row = $res -> fetch_assoc()){
             echo '
             <div class="col d-flex justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-body bg-light">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Reg No.</label>
                            <input type="number" class="form-control" value='.$row['regNo'].' name="regNo" id="regNo" placeholder="Enter Your registeration No" required></input>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" class="form-control" value='.$row['firstName'].' name="fname" id="fname" placeholder="Enter Your first Name" required></input>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control" value='.$row['lastName'].' name="lname" id="lname" placeholder="Enter Your last Name" required></input>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Gender</label>
                            <select name="gender" id="gender" class="form-control" required >
                                <option value='.$row['gender'].'>'.$row['gender'].'</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Contact No</label>
                            <input type="number" value='.$row['contactNo'].' name="contactNo" id="contactNo" placeholder="Enter Your Contact Number" class="form-control" required></input>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" value='.$row['email'].' name="email" id="email" placeholder="Enter Your Email Address" class="form-control" required></input>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" id="password" placeholder="Enter Your password" class="form-control" required></input>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" name="Cpassword" id="Cpassword" placeholder="Re-enter Your password" class="form-control" required></input>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-control btn btn-primary"></input>
                        </div>
                    </div>
                </div>


                
            </div>
        </div>
    </div>
</div>
             ';
        }
    }
    ?>
    

<!-- <div class="row">
    <div class="col-md-12">
        <button type="submit" class="btn btn-primary "id="submit" name="submit">Submit</button>
    </div>
</div> -->

</form>
</body>



    <?php
    include 'include/footer.php';
    ?>
</html>