<?php 
include_once 'staff-header.php';
include_once "DB_Connection.php" ;
			if(isset($_POST["update"]))
			{
				$paymethod = ucwords(strtolower($_POST["pay_method"]));
				$id = $_POST["income_id"];
				$added_by = $session->get_session('userid');
				date_default_timezone_set('Asia/Colombo');
				$added_date = date("Y-m-d h:i:s",time());
				$sql_check = "select * from incomes where payment_method = '$paymethod' and id = '$id'";
				$result_check = $conn->query($sql_check);
				if($result_check->num_rows>0){
								  set_error_msg("<strong>Oops!</strong> Already available in database!...!");
								  header("Location: payments-search-examination-payment.php");
				}
				else{
				$sql_ins = "update incomes set payment_method='$paymethod',status='pending',last_updated_by='$added_by',last_updated_date='$added_date'
				where id = '$id'";
				
						  if($conn->query($sql_ins) == true){
							  		set_success_msg("<strong>Success!</strong> Exam fee has been successfully updated!");
									header("Location: payments-search-examination-payment.php");
							  }
						  else{
								  set_error_msg("<strong>Oops!</strong> Something went wrong!...!");
								  header("Location: payments-search-examination-payment.php");
						  }
				}
			}
			
			if(isset($_POST["delete"]))
			{
				$id = $_POST["income_id"];
				
				$sql_ins = "delete from incomes where id = '$id'";
				
						  if($conn->query($sql_ins) == true){
							  		set_success_msg("<strong>Success!</strong> Exam fee has been successfully deleted!");
									header("Location: payments-search-examination-payment.php");
							  }
						  else{
								  set_error_msg("<strong>Oops!</strong> Something went wrong!...!");
								  header("Location: payments-search-examination-payment.php");
						  }
				
			}
 ?>



				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a href="payments-search-course-enroll.php" class="nav-item nav-link ">Course Enrollment Fees</a>
							<a href="payments-search-student-registration.php" class="nav-item nav-link ">Student Registration Fees</a>
							<a class="nav-item nav-link active">Examination Fees</a>
							<a href="payments-search-library-membership.php" class="nav-item nav-link ">Library Membership Payment</a>
                            <a href="payments-search-renew-library-membership.php" class="nav-item nav-link ">Library Membership Renewal Payment</a>
							<a href="payments-search-overdue.php" class="nav-item nav-link ">Library Overdue Payment</a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<form method="post" action="payments-search-examination-payment.php">
								<div class="row">
									<div class="col-md-12">
										<div class="input-group mb-3">
											<input type="text" class="form-control" name = "search"  placeholder="Exam name">
											<div class="input-group-append">
												<button class="btn btn-dark" type="submit">Search</button>
											</div>
										</div>
									</div>
								</div>
							</form>
                            	<!--div class="row">
									<div class="col-md-12">
										<div class="input-group mb-3">
											<div class="btn-group btn-group-lg" role="group">
  												<button type="button" class="btn btn-lg btn-danger active">Course Enrollment Fees</button>
  												<button type="button" class="btn btn-secondary">Student Registration Fees</button>
                                                <button type="button" class="btn btn-secondary">Examination Fees</button>
  												<button type="button" class="btn btn-secondary">Library Membership Payment</button>
                                                <button type="button" class="btn btn-secondary">Library Renewal Payment</button>
                                                <button type="button" class="btn btn-secondary">Library Overdue Payment</button>
											</div>
										</div>
									</div>
								</div-->
								<div class="row">
									<div class="col-md-12">
										<table class="table table-bordered">
											<thead>
												<tr>
                                                    <th scope="col"><center>Enrollment ID</center></th>
                                                    <th scope="col"><center>Student ID</center></th>
													<th scope="col"><center>Name</center></th>
													<th scope="col"><center>Grade</center></th>
                                                    <th scope="col"><center>Exam Name</center></th>
													<!--th scope="col"><center>Subject</center></th-->
													<th scope="col"><center>Fees</center></th>
                                                    <th scope="col"><center>Payment Method</center></th>
                                                    <th scope="col"><center>Paid Status</center></th>
													<th scope="col"></th>
												</tr>
											</thead>

												<?php
														if(isset($_POST['search']))
															{
																$searchq = $_POST['search'];
																$sql  = "select * from incomes WHERE description LIKE '%$searchq%' and catogory = 'Exam Management' ";	}
															else {
																		$sql = "SELECT * FROM incomes where catogory = 'Exam Management'";
															}

																		$result = $conn->query($sql);
															if($result->num_rows>0){
																		while($row = $result->fetch_assoc()){


																	?>

												<tbody>
												<form action="payments-search-examination-payment.php" method="post">
												<tr>
																<th scope="row"><center><?php echo $row['exam_enrollment_id']; ?></center></th>
																<td><center><?php echo $row['paid_by']; ?></center></td>
                                                                <?php
                                                                $sql_student = "select * from students where sid = '".$row['paid_by']."'";
																$result_student = $conn->query($sql_student);
																$row_student = $result_student->fetch_assoc();
																?>
                                                                <td><center><?php echo $row_student['fname'].".".$row_student["lname"]; ?></center></td>
																<td><center><?php echo $row_student['grade']; ?></center></td>
                                                                <td>
                                                                <center><?php echo $row['description']; ?></center>
                                                                </td>
																<td>
                                                                <center><?php echo $row['amount']; ?></center>
                                                                </td>
                                                                <td>
                                                                <input type="text" placeholder=" Payment Method " value="<?php echo $row['payment_method']; ?>" name="pay_method" class="form-control" required>
                                                                </td>
																<td class="<?php echo $row['status']; ?>"><center><?php echo $row['status']; ?></center></td>
													<td>
                                                    	<div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
																	<input type="hidden" value="<?php echo $row['id']; ?>" name="income_id">
                                                                    <input type="submit" value="Update" class="btn btn-success" name="update">
																	<input type="submit" value="Delete" class="btn btn-danger" name="delete">
                                                        </div>
													</td>
												</tr>
                                                </form>
											</tbody>
										<?php }
											}else{
												echo "<thead>
												<tr>
                                                    <th scope='col' colspan='9'><center>No Results Found</center></th>
												</tr>
											</thead>";
											}
										 ?>

										</table>
									</div>
								</div>
						</div>
					</div>
				</div>
<?php include_once 'staff-footer.php'; ?>
