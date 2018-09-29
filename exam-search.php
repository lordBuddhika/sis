<?php include_once 'staff-header.php';
    $dbconn = new mysqli('localhost', 'root', '', 'itpprojectdb');
    if($dbconn->connect_error) {
        die("Database connection error: " . $dbconn->connect_error);
    }

    if(isset($_POST["delete"])){
        $examid = $_POST["examid"];
        $sql = "DELETE from exams WHERE id='$examid'";
        if (!$dbconn->query($sql)) {
            echo "Error updating record: " . $dbconn->error;
        }
    }
    ?>
				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a href="exam-add.php" class="nav-item nav-link disabled">Add</a>
							<a href="exam-search.php" class="nav-item nav-link active">Search</a>
							<a href="exam-schedule.php" class="nav-item nav-link disabled">Schedule</a>
							<a href="exam-overview.php" class="nav-item nav-link disabled">Overview</a>
							<a href="exam-reports.php" class="nav-item nav-link disabled">Reports</a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<form method="post" action="exam-search.php">
								<div class="row">
									<div class="col-md-12">
										<div class="input-group mb-3">
											<input name="s" type="text" class="form-control" placeholder="Exam name" aria-label="Recipient's username" aria-describedby="basic-addon2" pattern="[A-Za-z0-9 ]{1,50}" required>
											<div class="input-group-append">
												<button class="btn btn-dark" type="button">Search</button>
											</div>
										</div>
									</div>
								</div>
                            </form>
                            <div class="row">
									<div class="col-md-12">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th scope="col">Exam ID</th>
													<th scope="col">Name</th>
													<th scope="col">Course</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Time Start</th>
                                                    <th scope="col">Time End</th>
                                                    <th scope="col">Fees</th>
													<th scope="col"></th>
												</tr>
											</thead>
                                            <?php
                                            if (isset($_POST['s'])) {
                                                $keyword = $_POST['s'];
                                                $sql = "select * from exams
                                                        WHERE
                                                            id LIKE '%$keyword%' OR
                                                            name LIKE '%$keyword%' OR
                                                            course_id LIKE '%$keyword%'";
                                            } else {
                                                $sql = "SELECT * FROM exams";
                                            }
                                            $result=$dbconn->query($sql);
                                            if($result->num_rows>0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    $cid = $row['course_id'];
                                                    $sql_c = "select * from courses where cid='$cid'";
                                                    $result_c=$dbconn->query($sql_c);
                                                    $row_c = $result_c->fetch_assoc();
                                            ?>
                                            <tbody>
												<tr>
													<th scope="row"><?php echo $row['id']; ?></th>
													<td><?php echo $row['name']; ?></td>
													<td><?php echo $row_c['name']; ?></td>
                                                    <td><?php echo $row['date']; ?></td>
                                                    <td><?php echo $row['time_start']; ?></td>
                                                    <td><?php echo $row['time_end']; ?></td>
                                                    <td><?php echo $row['fee']; ?></td>
													<td>
														<div class="btn-group" role="group" aria-label="Basic example">
                                                            <form action="exam-update.php" method="post">
                                                                <input type="hidden" value="<?php echo $row['id']; ?>" name="examid">
                                                                <input type="submit" value=" Update " class="btn btn-dark" name="update">
                                                            </form>
                                                            <form action="exam-search.php" method="post">
                                                                <input type="hidden" value="<?php echo $row['id']; ?>" name="examid">
                                                                <input type="submit" value=" Delete " class="btn btn-danger" name="delete">
                                                            </form>
														</div>
													</td>
												</tr>
                                            </tbody>
                                            <?php
                                                }
                                            }
                                            ?>

										</table>
									</div>
								</div>
						</div>
					</div>
				</div>
<?php include_once 'staff-footer.php'; ?>
