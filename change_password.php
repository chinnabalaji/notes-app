<?php 
include_once("header.php");
include_once("../includes/function.php");
 
?>
<div class="main-content">
<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading clearfix">
							<h3 class="panel-title"><?php echo $sitedata['site_name'];?> - Admin Id and Password Settings</h3>
							<ul class="panel-tool-options"> 
								<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
								<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
								<li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
							</ul>
						</div>
						<div class="panel-body">
						<?php if($_REQUEST['msg'] && $_REQUEST['error_type']=='success') {?><div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong><?php echo $_REQUEST['msg'];?></strong>  </div><?php echo $_REQUEST[msg]?></span></div>
<?php }elseif($_REQUEST['error_type']=='error'){?><div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong><?php echo $_REQUEST['msg'];?></strong>  </div><?php } ?>
							<form method="post" action="lib/login.php" id="rootwizard-2" class="form-wizard validate-form-wizard validate">
							<div class="row">
											<div class="col-md-6"> 
												<div class="form-group"> 
													<label for="confirmpassword" class="control-label">Admin Login Id (*)</label>
													<input placeholder="User login id." type="text" class="form-control required" name="admin_username" id="admin_username" value="<?php echo $_SESSION['admin_username'];?>">
												</div>
											</div>	
							            </div>
							  <div class="row">
											<div class="col-md-6"> 
												<div class="form-group"> 
													<label for="confirmpassword" class="control-label">Admin Old Password(*)</label>
													<input placeholder="Old Password" type="text" class="form-control required" name="old_pass" id="old_pass">
												</div>
											</div>	
							            </div>
										<div class="row">
											<div class="col-md-6"> 
												<div class="form-group"> 
													<label for="confirmpassword" class="control-label">Admin New Password (*)</label>
													<input placeholder="New Password" type="text" class="form-control required" name="new_pass" id="new_pass">
												</div>
											</div>	
							            </div>
									<div class="row">
											<div class="col-md-6"> 
												<div class="form-group"> 
													<label for="confirmpassword" class="control-label">Confirm New Password (*)</label>
													<input placeholder="Confirm Password" type="text" class="form-control required" name="con_pass" id="con_pass">
												</div>
											</div>	
							            </div>	
		
							 <div style="margin-left:5px;"> <button class="btn btn-success" type="submit">Update Password</button></div>
							 <br />
							 </div>
								 <input type="hidden" name="act" value="change_password" />
							</form>
						</div>
					</div>
				</div>
			</div>
			



<?php include_once("footer.php");?>