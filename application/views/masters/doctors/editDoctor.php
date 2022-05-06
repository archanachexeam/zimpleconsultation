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
						<div class="col-md-12">
							<div class="row">
								<div class="form-group col-md-6">
									<label class="form-label">First Name *</label>
									<input type="text" class="form-control" name="doctorFName" placeholder="First Name" required="required" value="<?php echo $singledoctor[0]['doctorFName'];?>">
									<input type="hidden" name="doctorId" value="<?php echo $singledoctor[0]['doctorId'];?>">
								</div>
								<div class="form-group col-md-6">
									<label class="form-label">Last Name *</label>
									<input type="text" class="form-control" name="doctorLName" placeholder="Last Name" required="required" value="<?php echo $singledoctor[0]['doctorLName'];?>">
								</div>
								<div class="form-group col-md-6">
									<label class="form-label">Contact Number *</label>
									<input type="text" class="form-control" name="doctorPhone" placeholder="Phone Number" required="required" value="<?php echo $singledoctor[0]['doctorPhone'];?>">
								</div>
								<div class="form-group col-md-6">
									<label class="form-label">Email *</label>
									<input type="email" class="form-control" name="doctorEmail" placeholder="Email Address" required="required" value="<?php echo $singledoctor[0]['doctorEmail'];?>">
								</div>
								<div class="form-group col-md-6">
									<label class="form-label">Department</label>
									<?php 
		                $designationsOptionsJs = 'id="doctorDepartment" class="form-control doctorDepartment select2-show-search"';
		                echo form_dropdown('doctorDepartment', $departments, $singledoctor[0]['doctorDepartment'], $designationsOptionsJs);
		              ?>
								</div>
								<div class="form-group col-md-6">
									<label class="form-label">Qualifications *</label>
									<input type="text" class="form-control" name="doctorQualifications" placeholder="Qulifications" required="required" value="<?php echo $singledoctor[0]['doctorQualifications'];?>">
								</div>
								<div class="form-group col-md-6">
									<label class="form-label">Consultation Fee *</label>
									<input type="numbers" class="form-control" name="doctorConsultationFee" placeholder="Consultation Fee" required="required" value="<?php echo $singledoctor[0]['doctorConsultationFee'];?>">
								</div>
								<div class="form-group col-md-6">
									<label class="form-label">Username *</label>
									<input type="text" class="form-control" name="doctorLogin" placeholder="Username" required="required" value="<?php echo $singledoctor[0]['doctorLogin'];?>">
								</div>
								<div class="form-group col-md-6">
									<label class="form-label">Password</label>
									<input type="password" class="form-control" name="doctorPassword" placeholder="Password">
								</div>
							</div>
						</div>
						<div class="col-md-8">
							<div class="row">
								<div class="form-group col-md-6">
									<label class="form-label">Doctor Photo (Max Size : 1Mb) </label>
									<input type="file" class="dropify" data-height="300" data-max-file-size="1M" name="doctorPhoto" required="required" data-default-file="<?php echo base_url()?>/uploads/doctors/<?php echo $singledoctor[0]['doctorPhoto'];?>">
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