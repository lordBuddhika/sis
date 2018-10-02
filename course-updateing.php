<?php include_once 'staff-header.php';
require_once 'database_credentials.php';

$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if($db->connect_error) {
    die("Database connection error: " . $db->connect_error);
}

            if(isset($_POST["updateb"])){

            $courseid = $_POST["course_id"];
            $name = $_POST["name"];
            $grade = $_POST["grade"];
            $day = $_POST["day"];
            $stime = $_POST["stime"];
            $etime = $_POST["etime"];
            $hall = $_POST["hall"];
            $fee = $_POST["fee"];
            $sql  = "UPDATE courses SET name='$name',grade= '$grade',day='$day',time_start='$stime',time_end='$etime',hall_no='$hall',fee='$fee' WHERE cid ='$courseid' ";
            if (!$db->query($sql)) {
                echo "Error updating record: " . $db->error;
            } else {
                header('Location: course-search.php');
            }
            }
            if(isset($_POST['update'])) {

                    $courseid = $_POST['courseid'];
                    $sql = "select * from courses where cid = '$courseid' ";
                    $data_update = $db->query($sql) or die ($db->error);
                    $row = $data_update->fetch_assoc();


?>


    <div class="col-md-10">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a href="course-updateing.php" class="nav-item nav-link active">Update</a>
                <a href="course-search.php" class="nav-item nav-link disabled">Back</a>

            </div>
        </nav>
        <div class="tab-content">
            <div class="tab-pane mt-4 show active">
                <form method="post" action="course-updateing.php">
                  <div class="form-group row">
                <label class="col-sm-2 col-form-label">Course ID</label>
                <div class="col-sm-10">
                  <div class="form-row">
                    <div class="col-md-6">
                      <input type="number" class="form-control" name="course_id" value="<?php echo $row["cid"]; ?>" readonly>
                    </div>
                  </div>
                </div>
              </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" value="<?php echo $row["name"];  ?>" pattern= "[A-Z.]{3,30}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Grade</label>
                        <div class="col-sm-10">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <select name="grade" class="form-control">
                                        <option value="1" <?php echo ($row["grade"] == "1") ? 'selected' : '' ; ?>>Grade 01</option>
                                        <option value="2" <?php echo ($row["grade"] == "2") ? 'selected' : '' ; ?>>Grade 02</option>
                                        <option value="3" <?php echo ($row["grade"] == "3") ? 'selected' : '' ; ?>>Grade 03</option>
                                        <option value="4" <?php echo ($row["grade"] == "4") ? 'selected' : '' ; ?>>Grade 04</option>
                                        <option value="5" <?php echo ($row["grade"] == "5") ? 'selected' : '' ; ?>>Grade 05</option>
                                        <option value="6" <?php echo ($row["grade"] == "6") ? 'selected' : '' ; ?>>Grade 06</option>
                                        <option value="7" <?php echo ($row["grade"] == "7") ? 'selected' : '' ; ?>>Grade 07</option>
                                        <option value="8" <?php echo ($row["grade"] == "8") ? 'selected' : '' ; ?>>Grade 08</option>
                                        <option value="9" <?php echo ($row["grade"] == "9") ? 'selected' : '' ; ?>>Grade 09</option>
                                        <option value="10" <?php echo ($row["grade"] == "10") ? 'selected' : '' ; ?>>Grade 10</option>
                                        <option value="11" <?php echo ($row["grade"] == "11") ? 'selected' : '' ; ?>>Grade 11</option>
                                        <option value="12" <?php echo ($row["grade"] == "12") ? 'selected' : '' ; ?>>A/L ICT</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Day</label>
                        <div class="col-sm-10">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <select name="day" class="form-control">
                                        <option value="Monday" <?php echo ($row["day"] == "Monday") ? 'selected' : '' ; ?>>Monday</option>
                                        <option value="Tuesday" <?php echo ($row["day"] == "Tuesday") ? 'selected' : '' ; ?>>Tuesday</option>
                                        <option value="Wednesday" <?php echo ($row["day"] == "Wednesday") ? 'selected' : '' ; ?>>Wednesday</option>
                                        <option value="Thursday" <?php echo ($row["day"] == "Thursday") ? 'selected' : '' ; ?>>Thursday</option>
                                        <option value="Friday" <?php echo ($row["day"] == "Friday") ? 'selected' : '' ; ?>>Friday</option>
                                        <option value="Saturday" <?php echo ($row["day"] == "Saturday") ? 'selected' : '' ; ?>>Saturday</option>
                                        <option value="Sunday" <?php echo ($row["day"] == "Sunday") ? 'selected' : '' ; ?>>Sunday</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Start Time</label>
                        <div class="col-sm-10">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <input type="time" class="form-control" name="stime" value="<?php echo $row["time_start"]; ?>" required>
                                    <span class="hours">Class hours  8AM to 5PM</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">End time</label>
                        <div class="col-sm-10">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <input type="time" class="form-control" name="etime" value="<?php echo $row["time_end"]; ?>"required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Hall</label>
                        <div class="col-sm-10">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <select name="hall" class="form-control">
                                        <option value="01" <?php echo ($row["hall_no"] == "01") ? 'selected' : '' ; ?>>H01</option>
                                        <option value="02" <?php echo ($row["hall_no"] == "02") ? 'selected' : '' ; ?>>H03</option>
                                        <option value="03" <?php echo ($row["hall_no"] == "03") ? 'selected' : '' ; ?>>H03</option>
                                        <option value="04" <?php echo ($row["hall_no"] == "04") ? 'selected' : '' ; ?>>H04</option>
                                        <option value="05" <?php echo ($row["hall_no"] == "05") ? 'selected' : '' ; ?>>H05</option>
                                        <option value="06" <?php echo ($row["hall_no"] == "06") ? 'selected' : '' ; ?>>H06</option>
                                        <option value="07" <?php echo ($row["hall_no"] == "07") ? 'selected' : '' ; ?>>H07</option>
                                        <option value="08" <?php echo ($row["hall_no"] == "08") ? 'selected' : '' ; ?>>H08</option>
                                        <option value="09" <?php echo ($row["hall_no"] == "09") ? 'selected' : '' ; ?>>H09</option>
                                        <option value="10" <?php echo ($row["hall_no"] == "10") ? 'selected' : '' ; ?>>H10</option>
                                        <option value="11" <?php echo ($row["hall_no"] == "11") ? 'selected' : '' ; ?>>H11</option>
                                        <option value="12" <?php echo ($row["hall_no"] == "12") ? 'selected' : '' ; ?>>H12</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Fee</label>
                        <div class="col-sm-10">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <input type="number"  class="form-control" name="fee" value="<?php echo $row["fee"]; ?>" min="500" max="2000" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" name="updateb" class="btn btn-dark">UPDATE</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
  <?php } ?>
<?php include_once 'staff-footer.php'; ?>
