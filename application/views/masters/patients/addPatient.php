<div class="row">
	<div class="col-md-12">
		<div class="col-md-12 col-lg-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title"><?php echo "Add New ".$pageHeading;?></h3>
				</div>
				<div class="card-body">
					<?php 
	          $attributes = array('class' => 'form form-horizontal form-bordered', 'id' => 'form');
	          echo form_open_multipart($loginRedirect,$attributes);
	        ?>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">First Name *</label>
								<input type="text" class="form-control" name="patientFName" placeholder="First Name" required="required">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Last Name *</label>
								<input type="text" class="form-control" name="patientLName" placeholder="Last Name" required="required">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Phone Number *</label>
								<input type="text" class="form-control" name="patientPhone" placeholder="Phone Number" required="required">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Email Address </label>
								<input type="email" class="form-control" name="patientEmail" placeholder="Email Address" >
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Address (Line 1) *</label>
								<input type="text" class="form-control" name="patientAddress1" placeholder="Address (Line 1)" required="required">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Address (Line 2) *</label>
								<input type="text" class="form-control" name="patientAddress2" placeholder="Address (Line 2)" required="required">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">City *</label>
								<input type="text" class="form-control" name="patientCity" placeholder="City" required="required">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">State *</label>
								<input type="text" class="form-control" name="patientState" placeholder="State" required="required">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">OP Number *</label>
								<input type="text" class="form-control" name="patientOPNumber" placeholder="OP Number" required="required">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<div class="form-label"></div>
								<input type="submit" class="btn btn-primary" name="" value="Submit">
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