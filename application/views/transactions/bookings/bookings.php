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
	          echo form_open_multipart($loginRedirectSearch,$attributes);
	        ?>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label class="form-label">Consultation Date *</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text">
											<i class="fa fa-calendar tx-16 lh-0 op-6"></i>
										</div>
									</div>
									<input type="text" class="form-control fc-datepicker" name="consultationDate" placeholder="DD/MM/YYYY" id="consultationDate">
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="form-label">Doctor</label>
								<?php 
		              $designationsOptionsJs = 'id="doctor" class="form-control doctor select2-show-search"';
		              echo form_dropdown('doctor', $doctors, '', $designationsOptionsJs);
		            ?>
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
					<h3 class="card-title"><?php echo $pageHeading;?></h3>
				</div>
				<div class="card-body">
					<div class="row" style="margin-bottom: 25px;">
						<div class="col-md-12">
							<a href="<?php echo $loginRedirect;?>" class="btn btn-primary">Add New Booking</a>
						</div>
					</div>
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
									<th class="wd-15p">Payment</th>
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
												<td>
													<?php
														if($booking['paymentStatus'] == 1){
													?>
														<button type="button" rel="<?php echo $booking['bookingId'];?>" class="btn btn-sm btn-success makeNotPaid"> Paid </button>
													<?php
														}else{
													?>
															<button type="button" rel="<?php echo $booking['bookingId'];?>" class="btn btn-sm btn-danger makePaid"> Not Paid </button>
													<?php
														}
													?>
													
												</td>
												<td><?php echo $booking['bookingStatusName'];?></td>
												<td>
													<a href="<?php echo base_url()?>transactions/Bookings/view/<?php echo $booking['bookingId'];?>" class="btn btn-success waves-effect waves-light width-md" title="View"> 
														<i class="icon icon-eye" data-toggle="tooltip" title="View"></i> 
													</a>
													<?php if($booking['bookingStatus'] != 5){ ?>
													<a href="<?php echo base_url()?>transactions/Bookings/cancel/<?php echo $booking['bookingId'];?>" class="btn btn-danger waves-effect waves-light width-md" title="Cancel"> 
														<i class="icon icon-trash" data-toggle="tooltip" title="Cancel"></i> 
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
<script type="text/javascript">
	$(document).ready(function(){
		$('.makeNotPaid').click(function(){
			if (confirm('Do you want to Change status to Not Paid?')) {
				var bookingId = $(this).attr('rel');
				$.ajax({
					type: "POST",
					url: "<?php echo base_url()?>transactions/bookings/makeNotPaid/",
					data: {bookingId:bookingId},
					success: function (data) {
						//alert(data);
						location.reload();
					},
					error: function () {
						alert("Server Error! Please try again later.");
					}
				});
			}else{
				return false;
			}
			
		});
		$('.makePaid').click(function(){
			if (confirm('Do you want to Change status to Paid?')) {
				var bookingId = $(this).attr('rel');
				$.ajax({
					type: "POST",
					url: "<?php echo base_url()?>transactions/bookings/makePaid/",
					data: {bookingId:bookingId},
					success: function (data) {
						//alert(data);
						location.reload();
					},
					error: function () {
						alert("Server Error! Please try again later.");
					}
				});
			}else{
				return false;
			}
			
		});
	});
</script>