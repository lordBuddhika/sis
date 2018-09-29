<?php
require ('ResourceManager.php');
include_once 'staff-header.php';
reset_success_msg();

?>
				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a href="resources-add.php"class="nav-item nav-link">Add Resources</a>
							<a href="resources-search.php" class="nav-item nav-link active">Search Resources</a>
							<a href="resources-reports.php" class="nav-item nav-link">Reports</a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<form method="post" action="resources-search.php">
								<div class="row">
									<div class="col-md-12">
										<div class="input-group mb-3">
											<input type="text" class="form-control" name="searchResult" placeholder="Resource name, email, id, type, assigned to" aria-label="resourceSearchFilter" aria-describedby="basic-addon2">
											<div class="input-group-append">
												<input type="submit" class="btn btn-dark" value="Search"/>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th>Resource ID</th>
													<th>Resource Category</th>
													<th>Resource Name</th>
													<th>Resource Version</th>
													<th>Quantity</th>
													<th>Additional Information</th>
													<th>Assigned To</th>
													<th>Availability Status</th>
													<th></th>
												</tr>
											</thead>
											<tbody>
											<?php
												if(isset($_POST['searchResult'])){
													$searchResult = Resource::searchResources($_POST['searchResult']);
													if ($searchResult == false){
														set_error_msg("No results Found");
													}else{
													while($row = $searchResult->fetch_assoc()) { ?>
														<tr>
															<th><?php print $row["resID"]?></th>
															<td><?php print $row["resCategory"]?></td>
															<td><?php print $row["resName"]?></td>
															<td><?php print $row["resVersion"]?></td>
															<td><?php print $row["resQty"]?></td>
															<td><a href ="resources-view.php?resID=<?php print $row["resID"]?>">Click Here for more info</td>
															<td><?php print $row["staffID"]?></td>
															<td><?php print ($row["resStatus"] == 1)?'Available':'Not Available'?></td>
															<td>
																<div class="btn-group" role="group" aria-label="Basic example">
																	<a class="btn btn-dark" href = "resources-edit.php?resID=<?php print $row["resID"]?>">Edit</a>
																	<form method="post" action="resources-search.php" onSubmit="if(!confirm('Are you sure you want to delete this?')){return false;}">
																		<input id="delConfirm" type="hidden" name="operation" value="<?php print $row["resID"]?>">
																		<input type="submit" class="btn btn-danger" value="Delete"/>
																		<!-- <script>
																			
																			function confirmDelete(e) {
																				e.preventDefault()
																				e.StopPropagation()
																			    var r = confirm("Press a button!");
																			    console.log(r);
																			    // if (r == false) {
																			    	return false
																			    // }
																			}

																		</script> -->
																	</form>
																</div>
															</td>
														</tr>
													<?php
													}
												}}
												?>
											</tbody>
										</table>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
<?php 
	// var_dump($_POST);
	
	if(isset($_POST["operation"])){
		$resDelete = new Resource();
		$resDelete->deleteResources($_POST['operation']);

		if(mysqli_affected_rows(Database::$DB_CONN) >= 0){ 
			set_success_msg('Resource Successfully Deleted!');
		}
	}

	// echo mysqli_affected_rows(Database::$DB_CONN);
?>
<?php include_once 'staff-footer.php'; ?>