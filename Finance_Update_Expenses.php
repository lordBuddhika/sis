<?php include_once 'staff-header.php';
include_once 'DB_Connection.php';
 ?>
				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
                        	<a href="Finance_Expense_Overview.php" class="nav-item nav-link"> Expenses Overview </a>
                        	<a href="Finance_Add_Expenses.php" class="nav-item nav-link"> Add Expenses </a>
                            <a class="nav-item nav-link active"> Update Expenses </a>
                            <a href="Finance_Delete_Expenses.php" class="nav-item nav-link"> Delete Expenses </a>
                            <a href="Finance_Verify_Expenses.php" class="nav-item nav-link"> Verify Expenses </a>
                            <a href="Finance_Closed_Expenses.php" class="nav-item nav-link"> Closed Expenses </a>
							<a class="nav-item nav-link disabled"> Expenses Reports </a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<form method="post" action="Finance_Update_Expenses.php">
								<div class="row">
									<div class="col-md-12">
										<div class="input-group mb-3">
                                        	<select name="search_opt" class="form-control col-md-2" >
                                            	<option value="catogory"> Catogory </option>
                                                <option value="description"> Description </option>
                                                <option value="payment_method"> Payment Method </option>
                                                <option value="status"> Status </option>
                                            </select>
											<input name="s_text" type="text" class="form-control" value="<?php echo (isset($_POST['s_text'])) ? $_POST['s_text'] : '' ; ?>" placeholder=" Search Text " >
											<div class="input-group-append">
													<button class="btn btn-dark" type="submit" name="search"> Search </button>
                                                    <a class="btn btn-secondary" href="Finance_Update_Expenses.php"> Refresh </a>
											</div>
										</div>
									</div>
								</div>
                              </form>
								<div class="row">
									<div class="col-md-12">
                                            <?php
												if(isset($_POST["search"])){
													$search = $_POST["search_opt"];
													$s_text = $_POST["s_text"];
													if(empty($s_text)){
														echo "<script>alert(' Search Text is Empty!... ')</script>";
														$sql_delete = "select * from expenses";
													}else{
														$sql_delete = "select * from expenses where ".$search." = '".$s_text."'";
													}
													
												}else{
													$sql_delete = "select * from expenses";
												}
												$result = $conn->query($sql_delete);
												
												if($result->num_rows>0){
											
                                            		echo "<table class='table table-bordered'>";
											?>			<thead class="odd">
															<tr>
																<th scope="col"><center>Expense ID</center></th>
																<th scope="col"><center>Category</center></th>
																<th scope="col"><center>Descripton</center></th>
																<th scope="col"><center>Payment Method</center></th>
																<th scope="col"><center>Amount</center></th>
                                               				    <th scope="col" colspan="2"><center>Paid For</center></th>
																<th scope="col" colspan="2"><center>Added By</center></th>
                                                    			<th scope="col"><center>Added Date</center></th>
                                                    			<th scope="col" colspan="2"><center>Last Updated By</center></th>
                                                    			<th scope="col"><center>Last Updated Date</center></th>
                                                    			<th scope="col" colspan="2"><center>Verified By</center></th>
                                                    			<th scope="col"><center>Verified Date</center></th>
                                                    			<th scope="col"><center>Status</center></th>
                                                    			<th scope="col"><center>Operation</center></th>   
															</tr>
														</thead>
                                            <?php
													$b = 0;
													while($row = $result->fetch_assoc()){
														$bg_color = ($b++%2==1) ? 'odd' : 'even';
											?>
                                            			<tbody>
															<tr class="<?php echo $bg_color; ?>">
                                                            <?php $inc_id = $row["id"]; ?>
																<th scope="row">EXP<?php echo $inc_id; ?></th>
																<td><?php echo $row["catogory"]; ?></td>
																<td><?php echo $row["description"]; ?></td>
																<td><?php echo $row["payment_method"]; ?></td>
                                                    			<td><?php echo $row["amount"]; ?></td>
                                                    			<?php if(is_numeric($row["paid_for"]) && $row["paid_for"] != 0 && $row["paid_for"] != 0){
																		$result_paid_by = $row["paid_for"];
																		$result_paid_by_btn = "";
																	}else if(is_string($row["paid_for"])){
																		$result_paid_by = $row["paid_for"];
																		$result_paid_by_btn = "message-hide";
																	}
																	else{
																		$result_paid_by = " _ ";
																		$result_paid_by_btn = "message-hide";
																	} 
																?>
                                                    			<td><center><?php echo $result_paid_by; ?></center></td>
                                                                <td><center><button class="btn btn-outline-info <?php echo $result_paid_by_btn;  ?>" type="button" onclick="openWin();"><span class="glyphicon glyphicon-user"></span></button></center></td>
																<?php if($row["added_by"]==0 || $row["added_by"]==""){
																		$result_added_by = " _ ";
																		$result_added_by_btn = "message-hide";
																	}else{
																		$result_added_by = $row["added_by"];
																		$result_added_by_btn = "";
																	} 
																?>
                                                                <td><center><?php echo $result_added_by; ?></center></td>
                                                                <td><center><button class="btn btn-outline-info <?php echo $result_added_by_btn;  ?>" type="button" onclick="openWinStaff(<?php echo $row["added_by"]; ?>);"><span class="glyphicon glyphicon-user"></span></button></center></td>
                                                                <?php if($row["added_date"]=="0000-00-00 00:00:00"){
																		$result_added_date = " _ ";
																	}else{
																		$result_added_date = $row["added_date"];
																	} 
																?>
																<td><center><?php echo $result_added_date; ?></center></td>
                                                                <?php if(empty($row["last_updated_by"])){
																		$result_last_updated_by = " _ ";
																		$result_last_updated_by_btn = "message-hide";
																	}else{
																		$result_last_updated_by = $row["last_updated_by"];
																		$result_last_updated_by_btn = "";
																	} 
																?>
																<td><center><?php echo $result_last_updated_by; ?></center></td>
                                                                <td><button class="btn btn-outline-info <?php echo $result_last_updated_by_btn; ?>" type="button" onclick="openWinStaff(<?php echo $row["last_updated_by"]; ?>);"><span class="glyphicon glyphicon-user"></span></button></td>
                                                                <?php if($row["last_updated_date"]=="0000-00-00 00:00:00"){
																		$result_last_date = " _ ";
																	}else{
																		$result_last_date = $row["last_updated_date"];
																	} 
																?>
                                                    			<td><?php echo $result_last_date; ?></td>
                                                    			
                                                                <?php if(empty($row["verified_by"])){
																		$result_verified_by = " _ ";
																		$result_verified_by_btn = "message-hide";
																	}else{
																		$result_verified_by = $row["verified_by"];
																		$result_verified_by_btn = "";
																	} 
																?>
                                                                <td><?php echo $result_verified_by; ?></td>
                                                                <td><button class="btn btn-outline-info <?php echo $result_verified_by_btn; ?>" type="button" onclick="openWinStaff(<?php echo $row["verified_by"]; ?>);"><span class="glyphicon glyphicon-user"></span></button></td>
                                                                <?php if($row["verified_date"]=="0000-00-00 00:00:00"){
																		$result_ver_date = " _ ";
																	}else{
																		$result_ver_date = $row["verified_date"];
																	} 
																?>
                                                    			<td><?php echo $result_ver_date; ?></td>
                                                    			<th scope="row" class="<?php echo $row["status"]; ?>"><?php echo $row["status"]; ?></th>
                                                   				<th scope="row">
                                             					<form action="Finance_Update_Expense_View.php" method="post" onSubmit="return confirm('WARNING!\n\n1. Accidentally updation of records cannot backup from the system.\n2. There is no way to undo this action.\n\nDo you still really want to update EXP<?php echo $row["id"]; ?>?');">
                                                               		<input type="hidden" value="<?php echo $row["id"]; ?>" name="expense_id">
                                                                	<input type="submit" value=" Update " name="update" class="btn btn-outline-success">
                                                        		</form>

                                                                </th>
															</tr>
														</tbody>

                                            <?php
									
                                                	}
													echo "</table>";
													
											
													$conn->close();
												}else{
													?>
															<tr>
                                               				    <th scope="col" colspan="18"><center>No Results Available</center></th>   
															</tr>
											<?php
													}
												 
											?>
											
									</div>
								</div>
						</div>
					</div>
				</div>
 

 
<?php include_once 'staff-footer.php'; ?>