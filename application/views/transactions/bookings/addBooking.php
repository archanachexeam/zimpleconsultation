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
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Patient *</label>
								<?php 
	                $designationsOptionsJs = 'id="patient" class="form-control patient select2-show-search"';
	                echo form_dropdown('patient', $patients, '', $designationsOptionsJs);
	              ?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Department *</label>
								<?php 
	                $designationsOptionsJs = 'id="doctorDepartment" class="form-control doctorDepartment select2-show-search"';
	                echo form_dropdown('doctorDepartment', $departments, '', $designationsOptionsJs);
	              ?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Doctor </label>
								<div class="doctorListOuter">
									<input type="email" class="form-control" name="patientEmail" placeholder="Email Address" disabled="disabled">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Booking Slots *</label>
								<div class="slotListOuter">
									<input type="text" class="form-control" name="patientAddress1" placeholder="Booking Slots" disabled="disabled">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Available Tokens *</label>
								<input type="text" class="form-control" name="availableTokens" id="availableTokens" placeholder="Available Tokens" required="required" readonly="readonly">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Consultation Fee *</label>
								<input type="text" class="form-control" name="consulationFee" id="consulationFee" placeholder="Consultation Fee" required="required" readonly="readonly">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Payment Status *</label>
								<?php 
									$paymentStatusArray = array('1' => 'Paid', '0' => 'Not Paid');
	                $designationsOptionsJs = 'id="paymentStatus" class="form-control paymentStatus select2-show-search"';
	                echo form_dropdown('paymentStatus', $paymentStatusArray, '', $designationsOptionsJs);
	              ?>
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
<script type="text/javascript">
	$(document).ready(function(){
		$('#doctorDepartment').change(function(){
			var department = $(this).val();
			var consultationDate = $('#consultationDate').val();
			$.ajax({
				type: "POST",
				url: "<?php echo base_url()?>transactions/bookings/get_doctors_list/",
				data: {department:department, consultationDate:consultationDate},
				success: function (data) {
					//alert(data);
					$('.doctorListOuter').html(data);
				},
				error: function () {
					alert("Server Error! Please try again later.");
				}
			});
		});
		$('body').on('change', '#doctor', function() {
			var doctor = $(this).val();
			//alert(doctor);
			var consultationDate = $('#consultationDate').val();
			$.ajax({
				type: "POST",
				url: "<?php echo base_url()?>transactions/bookings/get_slots/",
				data: {doctor:doctor, consultationDate:consultationDate},
				success: function (data) {
					//alert(data);
					$('.slotListOuter').html(data);
				},
				error: function () {
					alert("Server Error! Please try again later.");
				}
			});
			$.ajax({
				type: "POST",
				url: "<?php echo base_url()?>transactions/bookings/get_consultation_fee/",
				data: {doctor:doctor},
				success: function (data) {
					//alert(data);
					$('#consulationFee').val(data);
				},
				error: function () {
					alert("Server Error! Please try again later.");
				}
			});
		});
		$("#consultationDate").datepicker({
			dateFormat: 'dd/mm/yy',
	    onSelect: function() {
	      $(this).change();
	    }
		});
		$('body').on('change', '#consultationDate', function() {
			var consultationDate = $(this).val();
			//alert(consultationDate);
			var doctor = $('#doctor').val();
			if(doctor > 0){
				$.ajax({
					type: "POST",
					url: "<?php echo base_url()?>transactions/bookings/get_slots/",
					data: {doctor:doctor, consultationDate:consultationDate},
					success: function (data) {
						//alert(data);
						$('.slotListOuter').html(data);
					},
					error: function () {
						alert("Server Error! Please try again later.");
					}
				});
				$.ajax({
					type: "POST",
					url: "<?php echo base_url()?>transactions/bookings/get_consultation_fee/",
					data: {doctor:doctor},
					success: function (data) {
						//alert(data);
						$('#consulationFee').val(data);
					},
					error: function () {
						alert("Server Error! Please try again later.");
					}
				});
			}
			
		});
		$('body').on('change', '#bookingSlot', function() {
			var slotId = $(this).val();
			var doctor = $('#doctor').val();
			var consultationDate = $('#consultationDate').val();
			$.ajax({
				type: "POST",
				url: "<?php echo base_url()?>transactions/bookings/get_available_tokens/",
				data: {doctor:doctor, consultationDate:consultationDate, slotId:slotId},
				success: function (data) {
					//alert(data);
					$('#availableTokens').val(data);
				},
				error: function () {
					alert("Server Error! Please try again later.");
				}
			});
		});
	});
</script>