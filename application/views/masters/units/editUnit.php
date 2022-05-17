<div class="row">
	<div class="col-md-12">
		<div class="col-md-12 col-lg-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title"><?php echo "Edit ".$pageHeading;?></h3>
				</div>
				<div class="card-body">
					<?php 
	          $attributes = array('class' => 'form form-horizontal form-bordered', 'id' => 'form');
	          echo form_open_multipart($loginRedirect,$attributes);
	        ?>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Medicine Name *</label>
								<input type="text" class="form-control" name="medicineUnitName" value="<?php echo $units[0]['medicineUnitName'];?>" placeholder="Medicine Name" required="required">
								<input type="hidden" name="medicineUnitId" value="<?php echo $units[0]['medicineUnitId'];?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Medicine Symbol *</label>
								<input type="text" class="form-control" name="medicineUnitSF" value="<?php echo $units[0]['medicineUnitSF'];?>" placeholder="Medicine Symbo" required="required">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<div class="form-label"></div>
								<input type="submit" class="btn btn-primary" name="" value="Update">
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
									<th class="wd-15p">Medicine Name</th>
									<th class="wd-15p">Medicine Symbol</th>
									<th class="wd-10p">Status</th>
									<th class="wd-25p">Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php
									if(is_array($singleunit)){
										foreach($singleunit as $singleunits){
								?>
											<tr>
												<td><?php echo $singleunits['medicineUnitName'];?></td>
												<td><?php echo $singleunits['medicineUnitSF'];?></td>
												<td>
		                  	<?php 
													if($singleunits['isActive'] == 1){
														echo "Active";
													}else{
														echo "Inactive";
													}
												?>
		                  </td>
											<td>
												<?php 
													if($singleunits['isActive'] == 1){
												?>
												<?php
												     	if($this->session->userdata('logged_in_type') == "admin")
														 {
														 ?>
														<a href="<?php echo base_url()?>masters/Units/makeinactive/<?php echo $singleunits['medicineUnitId'];?>" class="btn btn-danger waves-effect waves-light width-md"> 
															<i class="icon icon-dislike" data-toggle="tooltip" title="Make Inactive"></i> 
														</a>
														<?php
														 }
														 if($this->session->userdata('logged_in_type') == "pharmacy")
														 {
															 ?>
															<a href="<?php echo base_url()?>medicines/Units/makeinactive/<?php echo $singleunits['medicineUnitId'];?>" class="btn btn-danger waves-effect waves-light width-md"> 
															<i class="icon icon-dislike" data-toggle="tooltip" title="Make Inactive"></i> 
														</a>
														<?php
														 }
														 ?>

												<?php
													}else{
												
														if($this->session->userdata('logged_in_type') == "admin")
														 {
														 ?>
														<a href="<?php echo base_url()?>masters/Units/makeactive/<?php echo $singleunits['medicineUnitId'];?>" class="btn btn-success waves-effect waves-light width-md"> 
															<i class="icon icon-like" data-toggle="tooltip" title="Make Active"></i> 
														</a>
														<?php
														 }
														 if($this->session->userdata('logged_in_type') == "pharmacy")
														 {
														 ?>
														 <a href="<?php echo base_url()?>medicines/Units/makeactive/<?php echo $singleunits['medicineUnitId'];?>" class="btn btn-success waves-effect waves-light width-md"> 
															<i class="icon icon-like" data-toggle="tooltip" title="Make Active"></i> 
														</a>
												<?php
														 }
													}
												
												
												      if($this->session->userdata('logged_in_type') == "admin")
														 {
														 ?>
		                  							<a href="<?php echo base_url()?>masters/Units/edit/<?php echo $singleunits['medicineUnitId'];?>" class="btn btn-success waves-effect waves-light width-md" title="Edit"> 
													<i class="icon icon-note" data-toggle="tooltip" title="Edit"></i> 
												</a>
												<?php
														 }
														 if($this->session->userdata('logged_in_type') == "pharmacy")
														 {
															 ?>
															 	<a href="<?php echo base_url()?>medicines/Units/edit/<?php echo $singleunits['medicineUnitId'];?>" class="btn btn-success waves-effect waves-light width-md" title="Edit"> 
													<i class="icon icon-note" data-toggle="tooltip" title="Edit"></i> 
												</a>
														 <?php
														 }
														 if($this->session->userdata('logged_in_type') == "admin")
														 {
														 ?>

												<a href="<?php echo base_url()?>masters/Units/delete/<?php echo $singleunits['medicineUnitId'];?>" class="btn btn-danger waves-effect waves-light width-md" title="Delete"> 
													<i class="icon icon-trash" data-toggle="tooltip" title="Delete"></i> 
												</a>
												<?php
														 }
														 if($this->session->userdata('logged_in_type') == "pharmacy")
														 {
															 ?>
															 <a href="<?php echo base_url()?>medicines/Units/delete/<?php echo $singleunits['medicineUnitId'];?>" class="btn btn-danger waves-effect waves-light width-md" title="Delete"> 
													<i class="icon icon-trash" data-toggle="tooltip" title="Delete"></i> 
												</a>
												<?php
														 }
														 ?>

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