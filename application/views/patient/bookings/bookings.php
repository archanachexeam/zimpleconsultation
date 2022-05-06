  <div class="row">
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
									<th class="wd-15p">Date</th>
									<th class="wd-15p">Patient</th>
									<th class="wd-15p">Phone #</th>
									<th class="wd-15p">Doctor</th>
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
												<td><?php echo $booking['patientPhone'];?></td>
												<td><?php echo $booking['doctorFName']." ".$booking['doctorLName'];?></td>
												<td><?php echo $booking['slotName'];?></td>
												<td><?php echo $booking['tokenNumber'];?></td>
												<td><?php echo $booking['bookingStatusName'];?></td>
												<td>
													<?php if($booking['bookingStatus'] <= 2){ ?>
														<a href="<?php echo base_url()?>transactions/Bookings/cancel/<?php echo $booking['bookingId'];?>" class="btn btn-danger waves-effect waves-light width-md" title="Cancel"> 
														<i class="icon icon-trash" data-toggle="tooltip" title="Cancel"></i> 
													</a>
													<?php } ?>
													<a href="<?php echo base_url()?>Patient/viewbookings/<?php echo $booking['bookingId'];?>" class="btn btn-success waves-effect waves-light width-md" title="View"> 
														<i class="icon icon-eye" data-toggle="tooltip" title="View"></i> 
													</a>
													<?php if($booking['bookingStatus'] == 5){ ?>
														<a href="<?php echo base_url()?>Patient/viewMedicineList/<?php echo $booking['bookingId'];?>" class="btn btn-success waves-effect waves-light width-md" title="View Medicines"> 
															<i class="icon icon-list" data-toggle="tooltip" title="View Medicines"></i> 
														</a>
														<a href="<?php echo base_url()?>Patient/viewLabTestList/<?php echo $booking['bookingId'];?>" class="btn btn-success waves-effect waves-light width-md" title="View Lab Tests"> 
															<i class="icon icon-chemistry" data-toggle="tooltip" title="View Lab Tests"></i> 
														</a>
													<?php } ?>
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