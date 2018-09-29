<?php 
require 'ResourceManager.php';
include_once 'staff-header.php'; 
reset_success_msg();

if($_GET){
	$resID = $_GET['resID'];
}elseif($_POST){
	$resID = $_POST['resID'];
}

//var_dump($_POST);
?>
<!-- <pre>
<?php //var_dump($_POST); ?>	
</pre>
 -->
 <script> 	
	function checkYearLength(elem){

		currentDate = new Date;
		currentYear = currentDate.getFullYear();

	    if (elem.value >= currentYear) {
	        elem.value = currentYear; 
	    }
	}

	function checkMonthLength(elem){

	    if (elem.value >= 12) {
	        elem.value = 12; 
	    }
	}

	function checkDateLength(elem){

	    if (elem.value >= 31) {
	        elem.value = 31; 
	    }
	}
 </script>

				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a href="resources-add.php" class="nav-item nav-link">Add Resources</a>
							<a href="resources-search.php" class="nav-item nav-link">Search Resources</a>
							<a href="resources-reports.php" class="nav-item nav-link">Reports</a>
							<a class="nav-item nav-link active">Edit Resources</a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<form method="post" action="resources-edit.php?resID=<?php print $resID?>" enctype="multipart/form-data">
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Resource ID</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<label class="col-sm-2 col-form-label"><?php 
													if($_GET){
														$resID = $_GET['resID']; print $resID;
													}elseif($_POST){
														$resID = $_POST['resID'];
														print $resID;
													}?>
														
												</label>
												<input type="hidden" name="resID" value="<?php 
													if($_GET){
														$resID = $_GET['resID']; print $resID;
													}elseif($_POST){
														$resID = $_POST['resID'];
														print $resID;
													}?>"
												>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Resource Category</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<select name="rCategory" class="form-control">
													<option value="Furniture">Furnitures</option>
													<option value="Electronic">Electronic</option>
													<option value="Vehicles">Vehicles</option>
													<option value="Property">Property</option>
													<option value="Others">Exam</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Resource Name</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-3">
												<?php
													$resourceLoad = new Resource();
													$resourceLoad->loadResource($resID);

													$resDate = $resourceLoad->getProperty('dateofp');

													list($resYear, $resMonth, $resDate) =explode("-",$resDate);

												?>
												<input type="text" class="form-control" name="rName" placeholder="eg: Damro Wooden Chair" pattern="[A-Za-z]" title="Numbers and Special characters are not allowed for the Name Field." required value="<?php echo $resourceLoad->getProperty('resName');?>">
											</div>
											<div class="col-md-3">
												<input type="text" class="form-control" name="rVersion" placeholder="Type/Version ID eg: Wood CH6732" required value="<?php echo $resourceLoad->getProperty('resVersion');?>">
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Quantity</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-2">
												<input type="number" class="form-control" name="rQty" placeholder="# Items" required value="<?php echo $resourceLoad->getProperty('resQty');?>">
											</div>
										</div>
									</div>
								</div>	
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Additional Information</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<textarea class="form-control" name="rAdditional_info" placeholder="" rows="5"><?php echo $resourceLoad->getProperty('resDesc');?></textarea>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Assign to</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-3">
													<?php 
														$allStaffResult = Resource::getAllStaff();

														if ($allStaffResult->num_rows > 0) { 
													?>
														  <select name="staffid" class="form-control">
													<?php   // output data of each row
														    while($row = $allStaffResult->fetch_assoc()) {
													?>
																<option value="<?php print $row['userid'] ?>"><?php print $row['fname'].$row['lname'] ?></option>
																
														        
													<?php   } ?>
														</select>
														<?php
														} else {
														    echo "No Employess Available.";
														}
													?>

												
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Unit Price</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input type="number" class="form-control" name="rPrice" placeholder="eg: 250.00" required value="<?php echo $resourceLoad->getProperty('resPrice');?>" onblur ="this.value = Number(this.value).toFixed(2)"">
											</div>
										</div>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Date of Purchase</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-2">
												<input type="number" class="form-control" name="rDopy" placeholder="Year" required oninput="checkYearLength(this);" value="<?php echo $resYear;?>">
											</div>
											<div class="col-md-2">
												<input type="number" class="form-control" name="rDopm" placeholder="Month" required oninput="checkMonthLength(this);" value="<?php echo $resMonth;?>">
											</div>
											<div class="col-md-2">
												<input type="number" class="form-control" name="rDopd" placeholder="Date" required oninput="checkDateLength(this);" value="<?php echo $resDate;?>">
											</div>
										</div>
									</div>
								</div>
								<fieldset class="form-group">
									<div class="row">
										<legend class="col-form-label col-sm-2 pt-0">Resource Image</legend>
										<div class="col-sm-10 col-md-2">
											<input type="file" class="" name="rImage"/>
										</div>
									</div>
								</fieldset>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Status</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-4">
												<select name="resStatus" clas="form-control">
													<option value="1">Available</option>
													<option value="2">Lost/Unvailable</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-10">
										<button type="submit" class="btn btn-dark">Update Resource</button>
									</div>
								</div>
								<input type ="hidden" name="submitted" value="1">
							</form>
						</div>
					</div>
				</div>
<?php 
	if (isset($_POST['submitted'])){

		// var_dump($_POST);

		$imageName = $_FILES['rImage']['name'];
		$targetImage = "images/".basename($_FILES['rImage']['name']);
		$purchaseDate = Resource::getDate($_POST['rDopy'], $_POST['rDopm'],$_POST['rDopd']);
		$resArray = array(

			'resCategory' => $_POST['rCategory'],
			'resName' => $_POST['rName'],
			'resVersion' => $_POST['rVersion'],
			'resQty' => $_POST['rQty'],
			'resDesc' => $_POST['rAdditional_info'],
			'staffID' => $_POST['staffid'],
			'resPrice' => $_POST['rPrice'],
			'dateofp' => $purchaseDate,
			// 'resImage' => $imageName,
			'resStatus' => $_POST['resStatus'],
	);

		$resMang = new Resource;

		$resMang->setResource($resArray);

		$resMang->resourceUpdate($resID);

		if(mysqli_affected_rows(Database::$DB_CONN) >= 0){ 
			set_success_msg('Resource Successfully Updated!');
		}

		move_uploaded_file($_FILES['rImage']['name'], $targetImage);

		echo "<meta http-equiv='refresh' content='0'>";
	}
	
?>
<?php include_once 'staff-footer.php'; ?>