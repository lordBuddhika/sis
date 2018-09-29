<?php include_once 'staff-header.php'; ?>
				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a href="resources-add.php"class="nav-item nav-link">Add Resources</a>
							<a href="resources-search.php"class="nav-item nav-link">Search Resources</a>
							<a href="resources-reports.php active" class="nav-item nav-link active">Reports</a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<div class="row">
								<div class="col-md-3">
									<div class="card bg-light mb-3">
										<div class="card-header">Reource Purchased History</div>
										<div class="card-body">
											<p class="card-text">View reource during a specific period of time.</p>
											<form action="staff-reports-employeement-history.php" method="get">
												<div class="form-group">
													<small class="form-text text-muted">Start Date</small>
													<input type="date" name="startdate" class="form-control">
												</div>
												<div class="form-group">
													<small class="form-text text-muted">End Date</small>
													<input type="date" name="startdate" class="form-control">
												</div>
												<div class="form-group">
													<small class="form-text text-muted">Category</small>
													<select name="department" class="form-control">
													<option value="Furniture">Furnitures</option>
													<option value="Electronic">Electronic</option>
													<option value="Vehicles">Vehicles</option>
													<option value="Property">Property</option>
													<option value="Exam">Exam</option>
												</select>
											</div>
												<button class="btn btn-dark btn-block" type="submit">View Report</button>			
											</form>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="card bg-light mb-3">
										<div class="card-header">Resource Price list</div>
										<div class="card-body">
											<p class="card-text">Resource Price list as per category.</p>
											<form action="staff-reports-employeement-history.php" method="get">
												<div class="form-group">
													<small class="form-text text-muted">Category</small>
													<select name="department" class="form-control">
														<option value="Furniture">Furnitures</option>
														<option value="Electronic">Electronic</option>
														<option value="Vehicles">Vehicles</option>
														<option value="Property">Property</option>
														<option value="Exam">Exam</option>
													</select>
												</div>
												<button class="btn btn-dark btn-block" type="submit">View Report</button>			
											</form>
										</div>
									</div>
									</div>
								
								<div class="col-md-3">
									<div class="card bg-light mb-3">
										<div class="card-header">Complete Resource Analysis</div>
										<div class="card-body">
											<p class="card-text">View complete analysis of reources</p>
											<form action="staff-reports-employeement-history.php" method="get">
												<button class="btn btn-dark btn-block" type="submit">View Report</button>			
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
<?php include_once 'staff-footer.php'; ?>