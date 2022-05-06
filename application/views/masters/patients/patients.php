  <div class="row">
	<div class="col-md-12">
		<div class="col-md-12 col-lg-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title"><?php echo $pageHeading;?></h3>
				</div>
				<div class="card-body">
					<div class="row" style="margin-bottom: 25px;">
						<div class="col-md-12">
							<a href="<?php echo $loginRedirect;?>" class="btn btn-primary">Add New Patient</a>
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
									<th class="wd-15p">Name</th>
									<th class="wd-15p">OP Number</th>
									<th class="wd-15p">Contact Number</th>
									<th class="wd-15p">City</th>
									<th class="wd-10p">Status</th>
									<th class="wd-25p">Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php
									if(is_array($patients)){
										foreach($patients as $patient){
								?>
											<tr>
												<td><?php echo $patient['patientFName']." ".$patient['patientLName'];?></td>
												<td><?php echo $patient['patientOPNumber'];?></td>
												<td><?php echo $patient['patientPhone'];?></td>
												<td><?php echo $patient['patientCity'];?></td>
												<td>
		                  	<?php 
													if($patient['isActive'] == 1){
														echo "Active";
													}else{
														echo "Inactive";
													}
												?>
		                  </td>
											<td>
												<?php 
													if($patient['isActive'] == 1){
												?>
														<a href="<?php echo base_url()?>masters/Patients/makeinactive/<?php echo $patient['patientId'];?>" class="btn btn-danger waves-effect waves-light width-md"> 
															<i class="icon icon-dislike" data-toggle="tooltip" title="Make Inactive"></i> 
														</a>
												<?php
													}else{
												?>
														<a href="<?php echo base_url()?>masters/Patients/makeactive/<?php echo $patient['patientId'];?>" class="btn btn-success waves-effect waves-light width-md"> 
															<i class="icon icon-like" data-toggle="tooltip" title="Make Active"></i> 
														</a>
												<?php
													}
												?>
		                  	<a href="<?php echo base_url()?>masters/Patients/edit/<?php echo $patient['patientId'];?>" class="btn btn-success waves-effect waves-light width-md" title="Edit"> 
													<i class="icon icon-note" data-toggle="tooltip" title="Edit"></i> 
												</a>
												<a href="<?php echo base_url()?>masters/Patients/delete/<?php echo $patient['patientId'];?>" class="btn btn-danger waves-effect waves-light width-md" title="Delete"> 
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