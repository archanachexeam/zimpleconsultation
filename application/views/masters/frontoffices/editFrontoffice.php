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
								<label class="form-label">Front Office Name *</label>
								<input type="text" class="form-control" name="frontOfficeName" value="<?php echo $singlefrontoffice[0]['frontOfficeName'];?>" placeholder="Front Office Name" required="required">
								<input type="hidden" name="frontOfficeId" value="<?php echo $singlefrontoffice[0]['frontOfficeId'];?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Phone Number </label>
								<input type="text" class="form-control" name="frontOfficePhone" placeholder="Phone Number" value="<?php echo $singlefrontoffice[0]['frontOfficePhone'];?>" >
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Email Address </label>
								<input type="email" class="form-control" name="frontOfficeEmail" placeholder="Email Address" value="<?php echo $singlefrontoffice[0]['frontOfficeEmail'];?>" >
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Username *</label>
								<input type="text" class="form-control" name="frontOfficeLogin" placeholder="Username" required="required" value="<?php echo $singlefrontoffice[0]['frontOfficeLogin'];?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Password *</label>
								<input type="password" class="form-control" name="frontOfficePassword" placeholder="Password" required="required">
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
									<th class="wd-15p">Front Office</th>
									<th class="wd-15p">Contact Number</th>
									<th class="wd-10p">Status</th>
									<th class="wd-25p">Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php
									if(is_array($frontoffices)){
										foreach($frontoffices as $frontoffice){
								?>
											<tr>
												<td><?php echo $frontoffice['frontOfficeName'];?></td>
												<td><?php echo $frontoffice['frontOfficePhone'];?></td>
												<td>
		                  	<?php 
													if($frontoffice['isActive'] == 1){
														echo "Active";
													}else{
														echo "Inactive";
													}
												?>
		                  </td>
											<td>
												<?php 
													if($frontoffice['isActive'] == 1){
												?>
														<a href="<?php echo base_url()?>masters/Frontofficestaff/makeinactive/<?php echo $frontoffice['frontOfficeId'];?>" class="btn btn-danger waves-effect waves-light width-md"> 
															<i class="icon icon-dislike" data-toggle="tooltip" title="Make Inactive"></i> 
														</a>
												<?php
													}else{
												?>
														<a href="<?php echo base_url()?>masters/Frontofficestaff/makeactive/<?php echo $frontoffice['frontOfficeId'];?>" class="btn btn-success waves-effect waves-light width-md"> 
															<i class="icon icon-like" data-toggle="tooltip" title="Make Active"></i> 
														</a>
												<?php
													}
												?>
		                  	<a href="<?php echo base_url()?>masters/Frontofficestaff/edit/<?php echo $frontoffice['frontOfficeId'];?>" class="btn btn-success waves-effect waves-light width-md" title="Edit"> 
													<i class="icon icon-note" data-toggle="tooltip" title="Edit"></i> 
												</a>
												<a href="<?php echo base_url()?>masters/Frontofficestaff/delete/<?php echo $frontoffice['frontOfficeId'];?>" class="btn btn-danger waves-effect waves-light width-md" title="Delete"> 
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