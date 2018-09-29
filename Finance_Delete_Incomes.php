<?php
include_once 'staff-header.php';
include_once 'DB_Connection.php';

if(isset($_POST["delete"])){
	$id = $_POST["income_id"];
	reset_error_msg();
	reset_success_msg();
	
	$sql_del = "delete from incomes where id='$id'";
						if($conn->query($sql_del) == true){
							  		set_success_msg("<strong>Success!</strong> INC".$id." successfully deleted!");
									header("Location: Finance_Delete_Incomes.php");
							  }
						  else{
								  set_error_msg("<strong>Oops!</strong> Something went wrong!...!");
								  header("Location: Finance_Delete_Incomes.php");
						  }
}
?>
				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
                        	<a href="Finance_Income_Overview.php" class="nav-item nav-link"> Income Overview </a>
                        	<a href="Finance_Add_Incomes.php" class="nav-item nav-link"> Add Incomes </a>
                            <a href="Finance_Update_Incomes.php" class="nav-item nav-link"> Update Incomes </a>
                            <a class="nav-item nav-link active"> Delete Incomes </a>
                            <a href="Finance_Verify_Incomes.php" class="nav-item nav-link"> Verify Incomes </a>
                            <a href="Finance_Closed_Incomes.php" class="nav-item nav-link"> Closed Incomes </a>
							<a class="nav-item nav-link disabled"> Income Reports </a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<form method="post" action="Finance_Delete_Incomes.php" >
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
                                                    <a class="btn btn-secondary" href="Finance_Delete_Incomes.php"> Refresh </a>
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
														$sql_delete = "select * from incomes";
													}else{
														$sql_delete = "select * from incomes where ".$search." = '".$s_text."'";
													}
													
												}else{
													$sql_delete = "select * from incomes";
												}
												$result = $conn->query($sql_delete);
												
												if($result->num_rows>0){
											
                                            		echo "<table class='table table-bordered'>";
											?>			<thead class="odd">
															<tr>
																<th scope="col"><center>Income ID</center></th>
																<th scope="col"><center>Category</center></th>
																<th scope="col"><center>Descripton</center></th>
																<th scope="col"><center>Payment Method</center></th>
																<th scope="col"><center>Amount</center></th>
                                               				    <th scope="col" colspan="2"><center>Paid By</center></th>
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
																<th scope="row"><center>INC<?php echo $row["id"]; ?></center></th>
																<td><center><?php echo $row["catogory"]; ?></center></td>
																<td><center><?php echo $row["description"]; ?></center></td>
																<td><center><?php echo $row["payment_method"]; ?></center></td>
                                                    			<td><center><?php echo $row["amount"]; ?></center></td>
                                                                <?php if(is_numeric($row["paid_by"]) && $row["paid_by"] != 0 && $row["paid_by"] != 0){
																		$result_paid_by = $row["paid_by"];
																		$result_paid_by_btn = "";
																	}else if(is_string($row["paid_by"])){
																		$result_paid_by = $row["paid_by"];
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
                                             
                                                                <form action="" method="post" onSubmit="return confirm('WARNING!\n\n1. Accidentally deletion of records cannot backup from the system.\n2. There is no way to undo this action.\n\nDo you still really want to delete INC<?php echo $row["id"]; ?>?');">
                                                               		<input type="hidden" value="<?php echo $row["id"]; ?>" name="income_id">
                                                                	<input type="submit" value=" Delete " name="delete" class="btn btn-outline-danger">
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