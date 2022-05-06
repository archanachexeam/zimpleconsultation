<div class="row">
	<div class="col-md-12">
		<div class="col-md-12 col-lg-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title"><?php echo $pageHeading;?></h3>
				</div>
				<div class="card-body">
					<?php 
	          $attributes = array('class' => 'form form-horizontal form-bordered', 'id' => 'form');
	          echo form_open_multipart($loginRedirect,$attributes);
	        ?>
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								<div class="form-group col-md-6">
									<label class="form-label">Hospital Name *</label>
									<input type="text" class="form-control" name="hospitalName" placeholder="Hospital Name" required="required" value="<?php echo $settings[0]['hospitalName'];?>">
								</div>
								<div class="form-group col-md-6">
									<label class="form-label">Email Address *</label>
									<input type="email" class="form-control" name="hospitalEmail" placeholder="Email Address" required="required" value="<?php echo $settings[0]['hospitalEmail'];?>">
								</div>
								<div class="form-group col-md-6">
									<label class="form-label">Address (Line 1) *</label>
									<input type="text" class="form-control" name="hospitalAddress1" placeholder="Address (Line 1)" required="required" value="<?php echo $settings[0]['hospitalAddress1'];?>">
								</div>
								<div class="form-group col-md-6">
									<label class="form-label">Address (Line 2) *</label>
									<input type="text" class="form-control" name="hospitalAddress2" placeholder="Address (Line 2)" required="required" value="<?php echo $settings[0]['hospitalAddress2'];?>">
								</div>
								<div class="form-group col-md-6">
									<label class="form-label">City *</label>
									<input type="text" class="form-control" name="hospitalCity" placeholder="City" required="required" value="<?php echo $settings[0]['hospitalCity'];?>">
								</div>
								<div class="form-group col-md-6">
									<label class="form-label">State *</label>
									<input type="text" class="form-control" name="hospitalState" placeholder="State" required="required" value="<?php echo $settings[0]['hospitalState'];?>">
								</div>
								<div class="form-group col-md-6">
									<label class="form-label">Country *</label>
									<input type="text" class="form-control" name="hospitalCountry" placeholder="Country" required="required" value="<?php echo $settings[0]['hospitalCountry'];?>">
								</div>
								<div class="form-group col-md-6">
									<label class="form-label">Pincode *</label>
									<input type="numbers" class="form-control" name="hospitalPincode" placeholder="Pincode" required="required" value="<?php echo $settings[0]['hospitalPincode'];?>">
								</div>
								<div class="form-group col-md-6">
									<label class="form-label">Contact Number *</label>
									<input type="text" class="form-control" name="hospitalContactNumber" placeholder="Contact Number" required="required" value="<?php echo $settings[0]['hospitalContactNumber'];?>">
								</div>
								<div class="form-group col-md-6">
									<label class="form-label">Website *</label>
									<input type="text" class="form-control" name="hospitalWebsite" placeholder="Website" required="required" value="<?php echo $settings[0]['hospitalWebsite'];?>">
								</div>
							</div>
						</div>
						<div class="col-md-8">
							<div class="row">
								<div class="form-group col-md-6">
									<label class="form-label">Hospital Logo (Max Size : 1Mb) </label>
									<input type="file" class="dropify" data-height="300" data-max-file-size="1M" name="hospitalLogo" required="required" data-default-file="<?php echo base_url()?>/uploads/settings/<?php echo $settings[0]['hospitalLogo'];?>">
								</div>
							</div>
						</div>
						<div class="col-md-1"></div>
						<div class="col-md-3">

						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<div class="form-label"></div>
								<input type="submit" class="btn btn-primary" name="" value="Update Settings">
							</div>
						</div>
					</div>
					<?php echo form_close();?>
					<?php if($this->session->flashdata('registerMessage')){ ?>
	          <div class="alert alert-warning ">
	            <a class="panel-close close " data-dismiss="alert">×</a> 
	            <i class="fa fa-coffe"></i>
	            <?php echo $this->session->flashdata('registerMessage');?>
	          </div>
	        <?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>