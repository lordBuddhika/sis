<?php 
require 'ResourceManager.php';
include_once 'staff-header.php';

if($_GET){
	$resID = $_GET['resID'];
}elseif($_POST){
	$resID = $_POST['resID'];
}

$resourceLoad = new Resource();
$resourceLoad->loadResource($resID);
$resDate = $resourceLoad->getProperty('dateofp');
//var_dump($_POST);
?>
<!-- <pre>
<?php //var_dump($_POST); ?>	
</pre>
 -->
				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a href="resources-add.php" class="nav-item nav-link">Add Resources</a>
							<a href="resources-search.php" class="nav-item nav-link">Search Resources</a>
							<a href="resources-reports.php" class="nav-item nav-link">Reports</a>
							<a href="resources-search.php" class="nav-item nav-link active">View Resource</a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Resource ID</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<label class="col-sm-2 col-form-label" name="rId"><?php echo $resourceLoad->getProperty('resID');?></label>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Resource Category</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<label name="rCategory" class="col-sm-2 col-form-label" name=rCategory">
													<?php echo $resourceLoad->getProperty('resCategory');?>
												</label>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Resource Name</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-3">
												<label class="col-md-6 col-form-label" name="rName"><?php echo $resourceLoad->getProperty('resName')." ".$resourceLoad->getProperty('resVersion');?></label>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Quantity</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-2">
												<label class="col-sm-2 col-form-label" name="rQty"><?php echo $resourceLoad->getProperty('resQty');?></label>
											</div>
										</div>
									</div>
								</div>	
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Additional Information</label>
									<div class="col-md">
										<div class="form-row">
											<div class="col-md-6">
												<textarea class="col-md-6 col-form-label" name="rAdditional_info" rows="5" readonly><?php echo $resourceLoad->getProperty('resDesc');?></textarea>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Assign to</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-3">
													<label name="staffID" class="col-sm-2 col-form-label name=rCategory">
													<?php echo $resourceLoad->getProperty('staffID');?>
												</label>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Unit Price (LKR)</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<label class="col-sm-2 col-form-label" name="rPrice"><?php echo $resourceLoad->getProperty('resPrice');?></label>
											</div>
										</div>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Date of Purchase</label>
									<div class="col-md-10">
										<div class="form-row">
											<div class="col-md">
												<label class="col-sm-2 col-form-label" name="rDopy"><?php echo $resDate;?></label>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Status</label>
									<div class="col-md">
										<div class="form-row">
											<div class="col-md-4">
												<label class="col-md-4 col-form-label" name="resStatus"><?php print ($resourceLoad->getProperty('resStatus') == 1)?'Available':'Not Available'?></label>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-10">
										<a class="btn btn-dark" href = "resources-edit.php?resID=<?php print $_GET["resID"]?>">Edit</a>
									</div>
								</div>
							
						</div>
					</div>
				</div>
<?php include_once 'staff-footer.php'; ?>