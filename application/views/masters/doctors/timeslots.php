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
						<div class="col-md-4">
							<div class="form-group">
								<label class="form-label">Day *</label>
								<?php 
									$days = array(
										'Sunday'			=> 'Sunday',
										'Monday'			=> 'Monday',
										'Tuesday'			=> 'Tuesday',
										'Wednesday'		=> 'Wednesday',
										'Thursday'		=> 'Thursday',
										'Friday'			=> 'Friday',
										'Saturday'		=> 'Saturday'
									);
	                $designationsOptionsJs = 'id="day" class="form-control day select2-show-search" multiple';
	                echo form_dropdown('day[]', $days, '', $designationsOptionsJs);
	              ?>
	              <input type="hidden" name="doctor" value="<?php echo $doctor;?>">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="form-label">Slots *</label>
								<?php 
	                $designationsOptionsJs = 'id="slot" class="form-control slot select2-show-search" multiple';
	                echo form_dropdown('slot[]', $slots, '', $designationsOptionsJs);
	              ?>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="form-label">Max Tokens *</label>
								<input type="numbers" class="form-control" name="maxTokens" placeholder="Max Tokens" required="required">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<div class="form-label"></div>
								<input type="submit" class="btn btn-primary" name="" value="Submit">
								<a href="<?php echo $loginRedirectBack;?>" class="btn btn-success">Back</a>
							</div>
						</div>
					</div>
					<?php echo form_close();?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="col-md-12 col-lg-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title"><?php echo $pageHeading;?></h3>
				</div>
				<div class="card-body">
					<?php if($this->session->flashdata('registerMessage')){ ?>
	          <div class="alert alert-warning ">
	            <a class="panel-close close " data-dismiss="alert">×</a> 
	            <i class="fa fa-coffe"></i>
	            <?php echo $this->session->flashdata('registerMessage');?>
	          </div>
	        <?php } ?>
					<div class="table-responsive">
						<table id="example" class="table table-striped table-bordered text-nowrap w-100">
							<thead>
								<tr>
									<th class="wd-15p">Day</th>
									<th class="wd-15p">Slot</th>
									<th class="wd-15p">Max Tokens</th>
									<th class="wd-25p">Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php
									if(is_array($timeslots)){
										foreach($timeslots as $timeslot){
								?>
											<tr>
												<td><?php echo $timeslot['day'];?></td>
												<td><?php echo $timeslot['slotName'];?></td>
												<td><?php echo $timeslot['maxTokens'];?></td>
												<td>
													<a href="<?php echo base_url()?>masters/Doctors/editTimeslot/<?php echo $timeslot['doctorSlotId'];?>" class="btn btn-danger waves-effect waves-light width-md" title="Edit"> 
														<i class="icon icon-note" data-toggle="tooltip" title="Edit"></i>
													</a>
													<a href="<?php echo base_url()?>masters/Doctors/deleteTimeslot/<?php echo $timeslot['doctorSlotId'];?>" class="btn btn-danger waves-effect waves-light width-md" title="Delete"> 
														<i class="icon icon-trash" data-toggle="tooltip" title="Delete"></i> 
													</a>
			                  </td>
											</tr>
								<?php
										}
									}
								?>
							</tbody>
						</table>
					</div>
					<!-- table-responsive -->
				</div>
			</div>
		</div>
	</div>
</div>