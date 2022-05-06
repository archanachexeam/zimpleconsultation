<div class="row">
	<div class="col-md-12">
		<div class="col-md-12 col-lg-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Search Patient</h3>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">OP Number *</label>
								<input type="text" class="form-control" name="patientOpNumber" id="patientOpNumber" placeholder="OP Number" required="required">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">&nbsp;</label>
								<button type="button" class="btn btn-primary" id="searchByOPNumber">Search By OP Number</button>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Phone Number *</label>
								<input type="text" class="form-control" name="patientPhone" id="patientPhone" placeholder="Phone Number" required="required">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">&nbsp;</label>
								<button type="button" class="btn btn-primary" id="searchByPhone">Search By Phone Number</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			</div>
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
						<div class="table-responsive">
						<table id="" class="table table-striped table-bordered text-nowrap w-100">
							<thead>
								<tr>
									<th class="wd-15p">OP Number</th>
									<th class="wd-15p">Name</th>
									<th class="wd-15p">Phone Number</th>
									<th class="wd-15p">OTP</th>
									<th class="wd-25p">Actions</th>
								</tr>
							</thead>
							<tbody id="patientDetails">

							</tbody>
						</table>
					</div>
					<div class="resultShow" style="color: red;">
						
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
		$('#searchByOPNumber').click(function(){
			var patientOPNumber = $('#patientOpNumber').val();
			$.ajax({
				type: "POST",
				url: "<?php echo base_url()?>Patient/get_patient_by_opnumber/",
				data: {patientOPNumber:patientOPNumber},
				success: function (data) {
					//alert(data);
					$('#patientDetails').html(data);
				},
				error: function () {
					alert("Server Error! Please try again later.");
				}
			});
		});

		$('#searchByPhone').click(function(){
			var patientPhone = $('#patientPhone').val();
			$.ajax({
				type: "POST",
				url: "<?php echo base_url()?>Patient/get_patient_by_phone/",
				data: {patientPhone:patientPhone},
				success: function (data) {
					//alert(data);
					$('#patientDetails').html(data);
				},
				error: function () {
					alert("Server Error! Please try again later.");
				}
			});
		});

		$('body').on('click', '.addPatient', function() {
			var patientId = $(this).parent().find('.patientId').val();
			var patientOTP = $(this).parents('tr').find('.patientOTP').val();
			var thisObject = $(this);
			$.ajax({
				type: "POST",
				url: "<?php echo base_url()?>Patient/addFamilyMember/",
				data: {patientId:patientId, patientOTP:patientOTP},
				success: function (data) {
					if(data == 1){
						$('.resultShow').html("<p>Patient Linked Successfully</p>");
						thisObject.parents('tr').find('.addPatient').hide();
						thisObject.parents('tr').find('.actionCol').html('Added');
						thisObject.parents('tr').find('.patientOTP').css('readonly','readonly');
					}else if(data == 2){
						$('.resultShow').html("<p>OTP Expired</p>");
					}else if(data == 3){
						$('.resultShow').html("<p>Invalid OTP</p>");
					}else{

					}
					
				},
				error: function () {
					alert("Server Error! Please try again later.");
				}
			});
		});
	});
</script>