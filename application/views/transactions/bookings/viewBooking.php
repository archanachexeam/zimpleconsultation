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
	<div class="col-md-12">
		<div class="col-md-12 col-lg-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Consultation Details</h3>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="form-label">Consultation Summary </label>
								<div class="doctorListOuter">
									<label><?php echo $singleBooking[0]['consultationSummary'];?></label>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label class="form-label">Medicines </label>
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
													</tr>
												</thead>
												<tbody class="medicineTableList">
													<?php
														if(is_array($bookingMedicines)){
															foreach($bookingMedicines as $bookingMedicine){
													?>
														<tr>
															<td><?php echo $bookingMedicine['medicineName'];?></td>
															<td><?php echo $bookingMedicine['dosage'];?></td>
															<td><?php echo $bookingMedicine['period'];?> Days</td>
															<td><?php echo $bookingMedicine['remarks'];?></td>
														</tr>
													<?php
															}
														}
													?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label class="form-label">Lab Tests </label>
								<div class="row">
									<div class="col-md-12">
										<div class="table-responsive">
											<table id="" class="table table-striped table-bordered text-nowrap w-100">
												<thead>
													<tr>
														<th class="wd-15p">Labtest Name</th>
														<th class="wd-15p">Remarks</th>
													</tr>
												</thead>
												<tbody class="medicineTableList">
													<?php
														if(is_array($bookingLabtests)){
															foreach($bookingLabtests as $bookingLabtest){
													?>
														<tr>
															<td><?php echo $bookingLabtest['labTestName'];?></td>
															<td><?php echo $bookingLabtest['remarks'];?></td>
														</tr>
													<?php
															}
														}
													?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label class="form-label">Other Remarks </label>
								<div class="doctorListOuter">
									<label><?php echo $singleBooking[0]['bookingRemarks'];?></label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>