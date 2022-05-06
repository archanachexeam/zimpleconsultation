<div class="row">
	<div class="col-md-12">
		<div class="col-md-12 col-lg-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title"><?php echo $pageHeading;?></h3>
				</div>
				<div class="card-body">
					<?php if($this->session->userdata('logged_in_type') == "admin")
					{ ?>
					<div class="row" style="margin-bottom: 25px;">
						<div class="col-md-12">
							<a href="<?php echo $loginRedirect;?>" class="btn btn-primary">Add New Doctor</a>
						</div>
					</div>
					<?php } ?>
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
									<th class="wd-15p">Name</th>
									<th class="wd-15p">Department</th>
									<th class="wd-15p">Qualifications</th>
									<th class="wd-15p">Fee</th>
									<th class="wd-15p">Contact #</th>
									<th class="wd-10p">Status</th>
									<?php if($this->session->userdata('logged_in_type') == "admin"){ ?>
										<th class="wd-10p">Slots</th>
									<?php } ?>
									<th class="wd-25p">Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php
									if(is_array($doctors)){
										foreach($doctors as $doctor){
								?>
											<tr>
												<td><?php echo $doctor['doctorFName'].' '.$doctor['doctorLName'];?></td>
												<td><?php echo $doctor['departmentName'];?></td>
												<td><?php echo $doctor['doctorQualifications'];?></td>
												<td><?php echo $doctor['doctorConsultationFee'];?></td>
												<td><?php echo $doctor['doctorPhone'];?></td>
												<td>
													<?php 
														if($doctor['isActive'] == 1){
															echo "Active";
														}else{
															echo "Inactive";
														}
													?>
												</td>
												<?php if($this->session->userdata('logged_in_type') == "admin"){ ?>
												<td>
													<a href="<?php echo base_url()?>masters/Doctors/timeslots/<?php echo $doctor['doctorId'];?>" class="btn btn-info waves-effect waves-light width-md">Slots</a>
												</td>
												<?php } ?>
												<td>
													<?php 
														if($this->session->userdata('logged_in_type') == "admin"){ 
															if($doctor['isActive'] == 1){
													?>
																<a href="<?php echo base_url()?>masters/Doctors/makeinactive/<?php echo $doctor['doctorId'];?>" class="btn btn-danger waves-effect waves-light width-md"> 
																	<i class="icon icon-dislike" data-toggle="tooltip" title="Make Inactive"></i> 
																</a>
													<?php
															}else{
													?>
																<a href="<?php echo base_url()?>masters/Doctors/makeactive/<?php echo $doctor['doctorId'];?>" class="btn btn-success waves-effect waves-light width-md"> 
																	<i class="icon icon-like" data-toggle="tooltip" title="Make Active"></i> 
																</a>
													<?php
															}
														}
													?>
													<a href="<?php echo base_url()?>masters/Doctors/view/<?php echo $doctor['doctorId'];?>" class="btn btn-success waves-effect waves-light width-md" title="View"> 
														<i class="icon icon-eye" data-toggle="tooltip" title="View"></i> 
													</a>
													<?php if($this->session->userdata('logged_in_type') == "admin"){ ?>
			                  	<a href="<?php echo base_url()?>masters/Doctors/edit/<?php echo $doctor['doctorId'];?>" class="btn btn-success waves-effect waves-light width-md" title="Edit"> 
														<i class="icon icon-note" data-toggle="tooltip" title="Edit"></i> 
													</a>
													<a href="<?php echo base_url()?>masters/Doctors/delete/<?php echo $doctor['doctorId'];?>" class="btn btn-danger waves-effect waves-light width-md" title="Delete"> 
														<i class="icon icon-trash" data-toggle="tooltip" title="Delete"></i> 
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