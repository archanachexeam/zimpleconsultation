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
								<label class="form-label">Doctor *</label>
								<?php 
	                $designationsOptionsJs = 'id="doctor" class="form-control doctor select2-show-search"';
	                echo form_dropdown('doctor', $doctors, '', $designationsOptionsJs);
	              ?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Leave Date *</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text">
											<i class="fa fa-calendar tx-16 lh-0 op-6"></i>
										</div>
									</div>
									<input type="text" class="form-control fc-datepicker" name="leaveDate" placeholder="DD/MM/YYYY" id="leaveDate" required="required">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
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
	<div class="col-md-12">
		<div class="col-md-12 col-lg-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title"><?php echo $pageHeading;?></h3>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table id="example" class="table table-striped table-bordered text-nowrap w-100">
							<thead>
								<tr>
									<th class="wd-15p">Doctor</th>
									<th class="wd-15p">Phone</th>
									<th class="wd-15p">Department</th>
									<th class="wd-10p">Leave Date</th>
									<th class="wd-25p">Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php
									if(is_array($doctorLeaves)){
										foreach($doctorLeaves as $doctorLeave){
								?>
											<tr>
												<td>
													<?php 
														echo $doctorLeave['doctorFName']." ".$doctorLeave['doctorLName'];
													?>
												</td>
												<td><?php echo $doctorLeave['doctorPhone'];?></td>
												<td><?php echo $doctorLeave['departmentName'];?></td>
												<td>
													<?php echo date('d-m-Y',strtotime($doctorLeave['leaveDate']));?>
												</td>
												<td>
													<a href="<?php echo base_url()?>transactions/Doctorleaves/delete/<?php echo $doctorLeave['doctorLeaveId'];?>" class="btn btn-danger waves-effect waves-light width-md" title="Delete"> 
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