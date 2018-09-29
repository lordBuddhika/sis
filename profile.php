<?php include_once 'staff-header.php'; ?>
<?php
	$session = new SessionManager();
	$userid = $session->get_session('userid');
	$sm = new StaffManager();
	$user = $sm->get_single_employee($userid)[0];

	if (isset($_POST['mobile_no']) && isset($_POST['address']) && isset($_POST['email'])) {
		echo "string";
		$mobile_no = $_POST['mobile_no'];
		$address = $_POST['address'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$sm->update_employee_profile($userid, $mobile_no, $address, $email, $password);
		header('Location: profile.php');
	}
?>
				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a href="profile.php" class="nav-item nav-link active">Profile</a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<form action="profile.php" method="post">
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">User ID</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input type="text" class="form-control" value="<?php echo $user['userid']; ?>" disabled>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Departments</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
                                                <select size="5" class="form-control" multiple disabled>
													<?php
                                                        foreach ($user['departments'] as $department) {
                                                            if ($department['status']) {
                                                                $selected_did = $department['did']; ?>
																<option value="<?php echo $department['did']; ?>" <?php echo ($department['status']) ? 'selected' : '' ; ?>><?php echo $department['name']; ?></option>
                                                            <?php }
                                                        }

                                                        $dup_depts = array();
                                                        foreach($user['departments'] as $department) {
                                                            if (!is_numeric(array_search($department['name'], $dup_depts)) && ($selected_did != $department['did'])) {
                                                                array_push($dup_depts, $department['name']); ?>
															    <option value="<?php echo $department['did']; ?>" <?php echo ($department['status']) ? 'selected' : '' ; ?>><?php echo $department['name']; ?></option>
                                                            <?php }
                                                        }
                                                    ?>
                                                </select>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Name</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-3">
												<input type="text" class="form-control" value="<?php echo $user['fname']; ?>" disabled>
												<small class="form-text text-muted">First Name</small>
											</div>
											<div class="col-md-3">
												<input type="text" class="form-control" value="<?php echo $user['lname']; ?>" disabled>
												<small class="form-text text-muted">Last Name</small>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Date of Birth</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-2">
												<input type="text" class="form-control" value="<?php echo substr($user['dob'], 0, 4); ?>" disabled>
												<small class="form-text text-muted">Year</small>
											</div>
											<div class="col-md-2">
												<input type="text" class="form-control" value="<?php echo substr($user['dob'], 5, 2); ?>" disabled>
												<small class="form-text text-muted">Month</small>
											</div>
											<div class="col-md-2">
												<input type="text" class="form-control" value="<?php echo substr($user['dob'], 8, 2); ?>" disabled>
												<small class="form-text text-muted">Date</small>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">NIC</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input type="text" class="form-control" value="<?php echo $user['nic']; ?>" disabled>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Contacts</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input type="text" class="form-control" name="mobile_no" value="<?php echo $user['mobile_no']; ?>">
												<small class="form-text text-muted">Mobile</small>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label"></label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<textarea type="text" class="form-control" name="address" rows="3"><?php echo $user['address']; ?></textarea>
												<small class="form-text text-muted">Address</small>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label"></label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input type="email" class="form-control" name="email" value="<?php echo $user['email']; ?>">
												<small class="form-text text-muted">Email</small>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<legend class="col-form-label col-sm-2 pt-0">Gender</legend>
									<div class="col-sm-10 col-md-2">
										<div class="form-row">
											<div class="col-md-6">
												<input type="text" class="form-control" value="<?php echo ($user['gender']) ? 'Male' : 'Female' ; ?>" disabled>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Password</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input type="password" name="password" class="form-control">
												<small class="form-text text-muted">Leave blank if no password change required</small>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-10">
										<button type="submit" class="btn btn-dark">Update</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
<?php include_once 'staff-footer.php'; ?>
