<?php include_once 'staff-header.php';
    require_once 'database_credentials.php';

    $dbconn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if($dbconn->connect_error) {
        die("Database connection error: " . $dbconn->connect_error);
    } else {
        $conn_status = true;
    }


    if(isset($_POST['updatedata'])) {
        $sid = $_POST['sid'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $grade = $_POST['grade'];
        $mobile = $_POST['mobile_no'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $reg_date = $_POST['reg_date'];

        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $sql = "update students set fname='$fname',lname='$lname',email='$email',grade='$grade',mobile_no='$mobile',dob='$dob',gender='$gender',reg_date='$reg_date' where sid='$sid'";
            $result = $dbconn->query($sql);
            set_success_msg("<strong>Success!</strong> Student has been successfully updated!");

        } else {
            set_error_msg( "Email address in invalid");
        }
        header("location:student-update.php");
    }

if(isset($_POST["update"])) {
    $sid = $_POST["sid"];
    $sql_update = "select * from students WHERE sid='$sid'";
    $result_update = $dbconn->query($sql_update);
    $row = $result_update->fetch_assoc();


    ?>
    <div class="col-md-10">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a href="student-update.php" class="nav-item nav-link active"> Update Students </a>
            </div>
        </nav>
        <div class="tab-content">
            <div class="tab-pane mt-4 show active">
                <form method="post" action="student-update.php">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"> Student ID </label>
                        <div class="col-sm-10">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="sid"
                                           value="<?php echo $row["sid"]; ?>" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"> Name </label>
                        <div class="col-sm-10">
                            <div class="form-row">
                                <div class="col-md-3">
                                    <input type="text" class="form-control" value="<?php echo $row["fname"]; ?>"
                                           name="fname" placeholder="First name" required>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" value="<?php echo $row["lname"]; ?>"
                                           name="lname" placeholder="Last name" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"> Contacts </label>
                        <div class="col-sm-10">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" value="<?php echo $row["mobile_no"]; ?>"
                                           name="mobile_no" placeholder="Mobile" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" value="<?php echo $row["email"]; ?>"
                                           name="email" placeholder="Email" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Grade</label>
                        <div class="col-sm-10">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <input type="number" min="1" max="13" value="<?php echo $row["grade"]; ?>"
                                           class="form-control" name="grade" placeholder="Grade" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"> Date of Birth</label>
                        <div class="col-sm-10">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <input type="date" class="form-control" value="<?php echo $row["dob"]; ?>"
                                           name="dob" placeholder="Date of Birth" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"> Registration Date </label>
                        <div class="col-sm-10">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <input type="date" class="form-control" value="<?php echo $row["reg_date"]; ?>"
                                           name="reg_date" placeholder="Registration Date" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
                            <div class="col-sm-10 col-md-2">
                                <select name="gender" class="form-control" required>
                                    <?php
                                    if ($row["gender"] == 1) {
                                        $select_male = "selected";
                                        $select_female = "";
                                    } else {
                                        $select_male = "";
                                        $select_female = "selected";
                                    }
                                    ?>
                                    <option value="-1">Please Select</option>
                                    <option value="1" <?php echo $select_male; ?>>Male</option>
                                    <option value="0" <?php echo $select_female; ?>>Female</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button name="updatedata" type="submit" class="btn btn-success"> Update Student</button>
                            <a href="student-search.php" class="btn btn-danger"> Back to Search </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include_once 'staff-footer.php';
}
?>
