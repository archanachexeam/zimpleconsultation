 <div class="row">
  <div class="col-md-12">
		<div class="col-md-12 col-lg-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title"><?php echo "Search ".$pageHeading;?></h3>
				</div>
				<div class="card-body">
					<?php 
	          $attributes = array('class' => 'form form-horizontal form-bordered', 'id' => 'form');
	          echo form_open_multipart($loginRedirect,$attributes);
	        ?>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Consultation Date *</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text">
											<i class="fa fa-calendar tx-16 lh-0 op-6"></i>
										</div>
									</div>
									<input type="text" class="form-control fc-datepicker" name="consultationDate" placeholder="DD/MM/YYYY" id="consultationDate" required="required">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<div class="form-label"></div>
								<input type="submit" class="btn btn-primary" name="" value="Search">
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
	<div class="col-md-12">
		<div class="col-md-12 col-lg-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title"><?php echo "Bookings for :".date('d-m-Y',strtotime($consultationDate));?></h3>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table id="example" class="table table-striped table-bordered text-nowrap w-100">
							<thead>
								<tr>
									<th class="wd-15p">Date</th>
									<th class="wd-15p">Patient</th>
									<th class="wd-15p">Timeslot</th>
									<th class="wd-15p">Token #</th>
									<th class="wd-10p">Status</th>
									<th class="wd-25p">Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php
									if(is_array($bookings)){
										foreach($bookings as $booking){
								?>
											<tr>
												<td>
													<?php echo date('d-m-Y',strtotime($booking['consultationDate']));?>
												</td>
												<td><?php echo $booking['patientOPNumber'].'-'.$booking['patientFName']." ".$booking['patientLName'];?></td>
												<td><?php echo $booking['slotName'];?></td>
												<td><?php echo $booking['tokenNumber'];?></td>
												<td><?php echo $booking['bookingStatusName'];?></td>
												<td>
													<?php 
														if($booking['bookingStatus'] == 2){
													?>
															<a href="<?php echo base_url()?>Doctor/consultation/<?php echo $booking['bookingId'];?>" class="btn btn-success waves-effect waves-light width-md" title="View"> 
															Consultation 
														</a>
													<?php
														}
													?>
													<a href="<?php echo base_url()?>Doctor/viewbookings/<?php echo $booking['bookingId'];?>" class="btn btn-success waves-effect waves-light width-md" title="View"> 
														<i class="icon icon-eye" data-toggle="tooltip" title="View"></i> 
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