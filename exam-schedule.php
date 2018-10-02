<?php include_once 'staff-header.php';
	require_once 'database_credentials.php';

	$dbconn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if($dbconn->connect_error) {
		die("Database connection error: " . $dbconn->connect_error);
	}

?>
				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a href="exam-add.php" class="nav-item nav-link disabled">Add</a>
							<a href="exam-search.php" class="nav-item nav-link disabled">Search</a>
							<a href="exam-schedule.php" class="nav-item nav-link active">Schedule</a>
							<a href="exam-overview.php" class="nav-item nav-link disabled">Overview</a>
							<a href="exam-reports.php" class="nav-item nav-link disabled">Reports</a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<form method="post" action="exam-schedule.php">
								<div class="row">
									<div class="col-md-12">
										<div class="input-group mb-3">
											<input name="s" type="text" class="form-control" placeholder="Exam name" aria-label="Recipient's username" aria-describedby="basic-addon2" pattern="[A-Za-z0-9 ]{1,50}" required>
											<div class="input-group-append">
												<button class="btn btn-dark" type="submit">Search</button>
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
													<th scope="col">Time</th>
													<th scope="col"></th>
												</tr>
											</thead>
											<?php
                                            if (isset($_POST['s'])) {
                                                $keyword = $_POST['s'];
                                                $sql = "select * from exams
                                                        WHERE
                                                            name LIKE '%$keyword%' OR
                                                            course_id LIKE '%$keyword%'
														ORDER BY date ASC";
                                            } else {
                                                $sql = "SELECT * FROM exams ORDER BY date ASC";
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
													<td>
														<?php $time = date('H'); ?>
														<span class="hr <?php echo ( (substr($row['time_start'], 0, 2) <= 6) && substr($row['time_end'], 0, 2) >= 6) ? 'hr-act': ''; ?> <?php echo ($time == 6) ? 'hr-curr' : '' ; ?>">6</span>
														<span class="hr <?php echo ( (substr($row['time_start'], 0, 2) <= 7) && substr($row['time_end'], 0, 2) >= 7) ? 'hr-act': ''; ?> <?php echo ($time == 7) ? 'hr-curr' : '' ; ?>">7</span>
														<span class="hr <?php echo ( (substr($row['time_start'], 0, 2) <= 8) && substr($row['time_end'], 0, 2) >= 8) ? 'hr-act': ''; ?> <?php echo ($time == 8) ? 'hr-curr' : '' ; ?>">8</span>
														<span class="hr <?php echo ( (substr($row['time_start'], 0, 2) <= 9) && substr($row['time_end'], 0, 2) >= 9) ? 'hr-act': ''; ?> <?php echo ($time == 9) ? 'hr-curr' : '' ; ?>">9</span>
														<span class="hr <?php echo ( (substr($row['time_start'], 0, 2) <= 10) && substr($row['time_end'], 0, 2) >= 10) ? 'hr-act': ''; ?> <?php echo ($time == 10) ? 'hr-curr' : '' ; ?>">10</span>
														<span class="hr <?php echo ( (substr($row['time_start'], 0, 2) <= 11) && substr($row['time_end'], 0, 2) >= 11) ? 'hr-act': ''; ?> <?php echo ($time == 11) ? 'hr-curr' : '' ; ?>">11</span>
														<span class="hr <?php echo ( (substr($row['time_start'], 0, 2) <= 12) && substr($row['time_end'], 0, 2) >= 12) ? 'hr-act': ''; ?> <?php echo ($time == 12) ? 'hr-curr' : '' ; ?>">12</span>
														<span class="hr <?php echo ( (substr($row['time_start'], 0, 2) <= 13) && substr($row['time_end'], 0, 2) >= 13) ? 'hr-act': ''; ?> <?php echo ($time == 13) ? 'hr-curr' : '' ; ?>">13</span>
														<span class="hr <?php echo ( (substr($row['time_start'], 0, 2) <= 14) && substr($row['time_end'], 0, 2) >= 14) ? 'hr-act': ''; ?> <?php echo ($time == 14) ? 'hr-curr' : '' ; ?>">14</span>
														<span class="hr <?php echo ( (substr($row['time_start'], 0, 2) <= 15) && substr($row['time_end'], 0, 2) >= 15) ? 'hr-act': ''; ?> <?php echo ($time == 15) ? 'hr-curr' : '' ; ?>">15</span>
														<span class="hr <?php echo ( (substr($row['time_start'], 0, 2) <= 16) && substr($row['time_end'], 0, 2) >= 16) ? 'hr-act': ''; ?> <?php echo ($time == 16) ? 'hr-curr' : '' ; ?>">16</span>
														<span class="hr <?php echo ( (substr($row['time_start'], 0, 2) <= 17) && substr($row['time_end'], 0, 2) >= 17) ? 'hr-act': ''; ?> <?php echo ($time == 17) ? 'hr-curr' : '' ; ?>">17</span>
														<span class="hr <?php echo ( (substr($row['time_start'], 0, 2) <= 18) && substr($row['time_end'], 0, 2) >= 18) ? 'hr-act': ''; ?> <?php echo ($time == 18) ? 'hr-curr' : '' ; ?>">18</span>
													</td>
													<td>
														<form action="exam-update.php" method="post">
															<input type="hidden" value="<?php echo $row['id']; ?>" name="examid">
															<input type="submit" value="Reschedule" class="btn btn-dark" name="update">
														</form>
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
