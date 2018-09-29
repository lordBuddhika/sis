<?php 
include_once 'staff-header.php';
include_once "DB_Connection.php" ;
if(isset($_POST["update"]))
			{
				$paymethod = ucwords(strtolower($_POST["pay_method"]));
				$amount = $_POST["amount"];
				$id = $_POST["income_id"];
				$added_by = $session->get_session('userid');
				date_default_timezone_set('Asia/Colombo');
				$added_date = date("Y-m-d h:i:s",time());
				$sql_check = "select * from incomes where payment_method = '$paymethod' and id = '$id' and amount = '$amount'";
				$result_check = $conn->query($sql_check);
				if($result_check->num_rows>0){
								  set_error_msg("<strong>Oops!</strong> Already available in database!...!");
								  header("Location: payments-search-overdue.php");
				}
				else{
				$sql_ins = "update incomes set amount='$amount',payment_method='$paymethod',status='pending',last_updated_by='$added_by',last_updated_date='$added_date'
				where id = '$id'";
				
						  if($conn->query($sql_ins) == true){
							  		set_success_msg("<strong>Success!</strong> Library Overdue fee has been successfully updated!");
									header("Location: payments-search-overdue.php");
							  }
						  else{
								  set_error_msg("<strong>Oops!</strong> Something went wrong!...!");
								  header("Location: payments-search-overdue.php");
						  }
				}
			}
			
			if(isset($_POST["delete"]))
			{
				$id = $_POST["income_id"];
				
				$sql_ins = "delete from incomes where id = '$id'";
				
						  if($conn->query($sql_ins) == true){
							  		set_success_msg("<strong>Success!</strong> Library Overdue fee has been successfully deleted!");
									header("Location: payments-search-overdue.php");
							  }
						  else{
								  set_error_msg("<strong>Oops!</strong> Something went wrong!...!");
								  header("Location: payments-search-overdue.php");
						  }
				
			}

 ?>



				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a href="payments-search-course-enroll.php" class="nav-item nav-link ">Course Enrollment Fees</a>
							<a href="payments-search-student-registration.php" class="nav-item nav-link ">Student Registration Fees</a>
							<a href="payments-search-examination-payment.php" class="nav-item nav-link ">Examination Fees</a>
							<a href="payments-search-library-membership.php" class="nav-item nav-link ">Library Membership Payment</a>
                            <a href="payments-search-renew-library-membership.php" class="nav-item nav-link ">Library Membership Renewal Payment</a>
							<a class="nav-item nav-link active">Library Overdue Payment</a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<form method="post" action="payments-search-overdue.php">
								<div class="row">
									<div class="col-md-12">
										<div class="input-group mb-3">
											<input type="text" class="form-control" name = "search"  placeholder="Overdue Days, Payment Method, Status">
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
													<th scope="col"><center>Borrow ID</center></th>
                                                    <th scope="col"><center>Memeber ID</center></th>
													<th scope="col"><center>Book Name</center></th>
													<th scope="col"><center>Borrowed Date</center></th>
                                                    <th scope="col"><center>Returned Date</center></th>
                                                    <th scope="col"><center>Overdue Days</center></th>
                                                    <th scope="col"><center>Overdue Amount</center></th>
                                                    <th scope="col"><center>Payment Method</center></th>
                                                    <th scope="col"><center>Paid Status</center></th>
													<th scope="col"></th>
												</tr>
											</thead>

												<?php
														if(isset($_POST['search']))
															{
																$searchq = $_POST['search'];
																$sql  = "select * from incomes WHERE catogory='Library Management' and description='Overdue' and
																												(status LIKE '%$searchq%' OR
																												payment_method LIKE '%$searchq%' OR
																												overdue_days LIKE '%$searchq%')
																												";	}
															else {
																		$sql = "SELECT * FROM incomes where catogory='Library Management' and description='Overdue'";
															}

																		$result = $conn->query($sql);
														if($result->num_rows>0){
																		while($row = $result->fetch_assoc()){


																	?>

												<tbody>
												<form action="payments-search-overdue.php" method= "post">
												<tr>
																<th scope="row">
                                                                <center><?php echo $row['library_overdue_id']; ?></center>
                                                                </th>
																<td>
                                                                <center><?php echo $row['paid_by']; ?></center>
                                                                </td>
                                                                <?php
                                                                #$sql_student = "select * from students where sid = '".$row['userid']."'";
																#$result_student = $conn->query($sql_student);
																#$row_student = $result_student->fetch_assoc();
																?>
                                                                <?php
																$sql_borrow = "select * from library_borrows where bbid = '".$row['library_overdue_id']."'";
																$result_borrow = $conn->query($sql_borrow);
																$row_borrow = $result_borrow->fetch_assoc();
                                                                $sql_book = "select * from library_books where bid = '".$row_borrow['book_id']."'";
																$result_book = $conn->query($sql_book);
																$row_book = $result_book->fetch_assoc();
																?>
                                                                <td><center><?php echo $row_book['name']; ?></center></td>
                                                                <td><center><?php echo $row_borrow['borrowed_date']; ?></center></td>
                                                                <td><center><?php echo $row_borrow['returned_date']; ?></center></td>
                                                                <td>
                                                                <center><?php echo $row["overdue_days"]; ?></center>
                                                                </td>
																<td>
                                                                <input type="number" value="<?php echo $row["amount"]; ?>" name="amount" min="0" required="required" placeholder=" Overdue Fee " class="form-control" />
                                                                </td>
                                                                <td>
                                                                <input type="text" value="<?php echo $row["payment_method"]; ?>" name="pay_method" placeholder="Payment Method" class="form-control" required>
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
										<?php }}else{
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
