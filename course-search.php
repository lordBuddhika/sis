<?php include_once 'staff-header.php';
    require_once 'database_credentials.php';

    $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if($db->connect_error)
			{
				die("Falie to connect Databass  :" . $db->connect_error);
			}

			if(isset($_POST["delete"]))
				{
					$courseid  = $_POST['courseid'];
					$sql = "DELETE from courses WHERE cid ='$courseid'";
						if(!$db->query($sql))
							{
								echo "Error   " . $db->error;
							}
					}
 ?>



				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a href="course-add.php" class="nav-item nav-link disabled">Add</a>
							<a class="nav-item nav-link active">Search</a>
							<a href="course-schedule.php" class="nav-item nav-link disabled">Schedule</a>
							<a href="course-overview.php" class="nav-item nav-link disabled">Overview</a>
							<a href="course-reports.php" class="nav-item nav-link disabled">Reports</a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<form method="post" action="course-search.php">
								<div class="row">
									<div class="col-md-12">
										<div class="input-group mb-3">
											<input type="text" class="form-control" name = "search"  placeholder="Course name, id,">
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
													<th scope="col">Course ID</th>
													<th scope="col">Name</th>
													<th scope="col">Grade</th>
													<th scope="col">Day </th>
													<th scope="col">Strat-Time</th>
													<th scope="col">End-Time</th>
													<th scope="col">Hall</th>
													<th scope="col">Fee</th>
													<th scope="col"></th>
												</tr>
											</thead>

												<?php
														if(isset($_POST['search']))
															{
																$searchq = $_POST['search'];
																$sql  = "select * from courses WHERE
																												name LIKE '%$searchq%' OR
																												cid LIKE '%$searchq%'";	}
															else {
																		$sql = "SELECT * FROM courses";
															}

																		$result = $db->query($sql);

																		while($row = $result->fetch_assoc()){


																	?>

												<tbody>

												<tr>
													<th scope="row"><?php echo $row['cid']; ?></th>
															<td><?php echo $row['name']; ?></td>
																<td><?php echo $row['grade']; ?></td>
																<td><?php echo $row['day']; ?></td>
																<td><?php echo $row['time_start']; ?></td>
																<td><?php echo $row['time_end']; ?></td>
																<td><?php echo $row['hall_no']; ?></td>
																<td><?php echo $row['fee']; ?></td>
													<td>
														<div class="btn-group" role="group" >

															<form action="course-updateing.php" method= "post">
																	<input type="hidden" value="<?php echo $row['cid']; ?>" name="courseid">
																	<input type="submit" value=" Update " class="btn btn-dark" name="update">
															</form>

															<form  action="course-search.php" method="post">
																<input type="hidden" value="<?php echo $row['cid'];  ?>" name="courseid">
																<input type="submit" value="Delete" class="btn btn-danger" name="delete">
															</form>
															</div>
													</td>
												</tr>
											</tbody>
										<?php }
										 ?>

										</table>
									</div>
								</div>
						</div>
					</div>
				</div>
<?php include_once 'staff-footer.php'; ?>
