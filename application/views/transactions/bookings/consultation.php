<div class="row">
	<div class="col-md-12">
		<div class="col-md-12 col-lg-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title"><?php echo $singleHeading." : ".$singleBooking[0]['patientOPNumber']." - ".$singleBooking[0]['patientFName']." ".$singleBooking[0]['patientLName'];?></h3>
				</div>
				<div class="card-body">
					<div class="wideget-user">
						<div class="row">
							<div class="col-lg-6 col-md-12">
								<div class="wideget-user-desc d-sm-flex">
									<div class="user-wrap">
										<h4><?php echo $singleHeading." : ".$singleBooking[0]['patientOPNumber']." - ".$singleBooking[0]['patientFName']." ".$singleBooking[0]['patientLName'];?></h4>
										<h5><?php echo "Token Number : ".$singleBooking[0]['tokenNumber'];?></h5>
										<h6 class="text-muted mb-3">Date: <?php echo date('d F Y',strtotime($singleBooking[0]['consultationDate']));?></h6>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<?php 
    $attributes = array('class' => 'form form-horizontal form-bordered', 'id' => 'form');
    echo form_open_multipart($loginRedirect,$attributes);
  ?>
  <div class="row">
		<div class="col-md-8">
			<div class="col-md-12 col-lg-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Consultation Summary</h3>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<div class="doctorListOuter">
										<label class="form-label">Diseases *</label>
										<?php 
			                $designationsOptionsJs = 'id="patient" class="form-control patient select2-show-search" multiple';
			                echo form_dropdown('disease[]', $diseases, '', $designationsOptionsJs);
			              ?>
										<input type="hidden" name="bookingId" value="<?php echo $singleBooking[0]['bookingId'];?>">
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<div class="doctorListOuter">
										<textarea class="form-control consultationSummary" name="consultationSummary" rows="5">
											<?php echo $singleBooking[0]['consultationSummary'];?>
										</textarea>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="col-md-12 col-lg-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Previous Visits to Me</h3>
					</div>
					<div class="card-body">
						<?php
							if(is_array($pvSameDrList)){
						?>
								<ul class="list-group">
						<?php
								foreach($pvSameDrList as $pvSameDr){
						?>
									<li class="list-group-item">
										<a href="<?php echo base_url()?>Doctor/viewbookings/<?php echo $pvSameDr['bookingId'];?>" class="" title="View" target="_blank">
											<?php echo date('d-m-Y',strtotime($pvSameDr['consultationDate']));?>
										</a>
									</li>
						<?php
								}
						?>
								</ul>
						<?php
							}else{
								echo "No Previous Visits";
							}
						?>
					</div>
				</div>
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Previous Visits to Others</h3>
					</div>
					<div class="card-body">
						<?php
							if(is_array($pvOthDrList)){
						?>
								<ul class="list-group">
						<?php
								foreach($pvOthDrList as $pvOthDr){
						?>
									<li class="list-group-item">
										<a href="<?php echo base_url()?>Doctor/viewbookings/<?php echo $pvOthDr['bookingId'];?>" class="" title="View" target="_blank">
											<?php echo date('d-m-Y',strtotime($pvOthDr['consultationDate']));?>
										</a>
									</li>
						<?php
								}
						?>
								</ul>
						<?php
							}else{
								echo "No Previous Visits";
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-12 col-lg-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Medicines</h3>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-8">
								<div class="form-group">
									<label class="form-label">Medicines </label>
									<div class="doctorListOuter">
										<?php 
			                $designationsOptionsJs = 'id="medicine" class="form-control medicine select2-show-search"';
			                echo form_dropdown('medicine', $medicines, '', $designationsOptionsJs);
			              ?>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="form-label">&nbsp;</label>
									<button class="btn btn-primary" id="addMedicineBtn">Add Medicine</button>
								</div>	
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="table-responsive">
									<table id="" class="table table-striped table-bordered text-nowrap w-100">
										<thead>
											<tr>
												<th class="wd-15p">Medicine Name</th>
												<th class="wd-15p">Dosage</th>
												<th class="wd-15p">Period</th>
												<th class="wd-15p">Remarks</th>
												<th class="wd-25p">Actions</th>
											</tr>
										</thead>
										<tbody class="medicineTableList">
											
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Lab Tests</h3>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-8">
								<div class="form-group">
									<label class="form-label">Lab Test </label>
									<div class="doctorListOuter">
										<?php 
			                $designationsOptionsJs = 'id="labtest" class="form-control labtest select2-show-search"';
			                echo form_dropdown('labtest', $labtests, '', $designationsOptionsJs);
			              ?>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="form-label">&nbsp; </label>
									<button class="btn btn-primary" id="addlabtestBtn">Add Lab Test</button>
								</div>	
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="table-responsive">
									<table id="" class="table table-striped table-bordered text-nowrap w-100">
										<thead>
											<tr>
												<th class="wd-15p">Lab Test</th>
												<th class="wd-15p">Remarks</th>
												<th class="wd-25p">Actions</th>
											</tr>
										</thead>
										<tbody class="labtestTableList">
											
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Other Remarks</h3>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<div class="doctorListOuter">
										<textarea class="form-control bookingRemarks" name="bookingRemarks" rows="5">
											<?php echo $singleBooking[0]['bookingRemarks'];?>
										</textarea>
									</div>
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
		        
					</div>
				</div>		
			</div>
		</div>
	</div>
	<?php echo form_close();?>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#addMedicineBtn').click(function(){
			var medicine = $('#medicine').val();
			$.ajax({
				type: "POST",
				url: "<?php echo base_url()?>doctor/get_medicine_table/",
				data: {medicine:medicine},
				success: function (data) {
					//alert(data);
					$('.medicineTableList').append(data);
					$('#medicine').val('Select');
				},
				error: function () {
					alert("Server Error! Please try again later.");
				}
			});
		});

		$(".medicineTableList").on('click', '.removeMedicineBtn', function () {
		    $(this).closest('tr').remove();
		});

		$('#addlabtestBtn').click(function(){
			var labtest = $('#labtest').val();
			$.ajax({
				type: "POST",
				url: "<?php echo base_url()?>doctor/get_labtest_table/",
				data: {labtest:labtest},
				success: function (data) {
					//alert(data);
					$('.labtestTableList').append(data);
					$('#labtest').val('Select');
				},
				error: function () {
					alert("Server Error! Please try again later.");
				}
			});
		});

		$(".labtestTableList").on('click', '.removeLabtestBtn', function () {
		    $(this).closest('tr').remove();
		});
	});
</script>