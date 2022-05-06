<div class="row">
	<div class="col-md-12">
		<div class="col-md-12 col-lg-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title"><?php echo "Edit ".$pageHeading;?></h3>
				</div>
				<div class="card-body">
					<?php 
	          $attributes = array('class' => 'form form-horizontal form-bordered', 'id' => 'form');
	          echo form_open_multipart($loginRedirect,$attributes);
	        ?>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label class="form-label">Day *</label>
								<input type="text" class="form-control" name="day" value="<?php echo $timeslots[0]['day'];?>" placeholder="Day" required="required" readonly>
								<input type="hidden" name="doctorSlotId" value="<?php echo $timeslots[0]['doctorSlotId'];?>">
								<input type="hidden" name="doctor" value="<?php echo $doctor;?>">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="form-label">Slot *</label>
								<input type="text" class="form-control" name="slotName" value="<?php echo $timeslots[0]['slotName'];?>" placeholder="Day" required="required" readonly>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="form-label">Max Tokens*</label>
								<input type="numbers" class="form-control" name="maxTokens" value="<?php echo $timeslots[0]['maxTokens'];?>" placeholder="Max Tokens" required="required">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<div class="form-label"></div>
								<input type="submit" class="btn btn-primary" name="" value="Update">
								<a href="<?php echo $loginRedirectCancel;?>" class="btn btn-primary">Cancel</a>
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