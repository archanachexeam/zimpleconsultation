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
								<label class="form-label">Medicine Name  *</label>
								<input type="text" class="form-control" name="medicineName" placeholder="Medicine Name " required="required">
							</div>
						</div>
						<div class="col-md-6">
						<div class="form-group">
								<label class="form-label">Medicine Generic Name  *</label>
								<input type="text" class="form-control" name="medicineGenericName" placeholder="Medicine Generic Name " required="required">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Medicine Unit *</label>
								<?php 
								$designationsOptionsJs = 'id="medicineUnitName"   class="form-control medicineUnitName" required="required"';
								echo form_dropdown('medicineUnitName', $medicineUnit, '', $designationsOptionsJs);
							?>
	         
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Medicine Shelf *</label>
								<?php 
								$designationsOptionsJs = 'id="medicineShelfName" class="form-control medicineShelfName "';
								echo form_dropdown('medicineShelfName', $medicineShelf, '', $designationsOptionsJs);
							?>
	         
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Medicine Details  *</label>
								<input type="text" class="form-control" name="medicineDetails" placeholder="Medicine Details" required="required">
							</div>
						</div>
					
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Medicine Category *</label>
								<?php 
								$designationsOptionsJs = 'id="medicineCategoryName" class="form-control medicineCategoryName "';
								echo form_dropdown('medicineCategoryName', $medicineCategory, '', $designationsOptionsJs);
							?>
	         
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Medicine Type *</label>
								<?php 
								$designationsOptionsJs = 'id="medicineTypeName" class="form-control medicineTypeName "';
								echo form_dropdown('medicineTypeName', $medicineType, '', $designationsOptionsJs);
							?>
	         
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Medicine Price  *</label>
								<input type="text" class="form-control" name="medicinePrice" placeholder="Medicine Price " required="required">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Medicine Manufacturer *</label>
								<?php 
								$designationsOptionsJs = 'id="manufacturerName" class="form-control manufacturerName "';
								echo form_dropdown('manufacturerName', $medicineManufacturer, '', $designationsOptionsJs);
							?>
	         
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Medicine Manufacturer Price  *</label>
								<input type="text" class="form-control" name="medicineManufacturerPrice" placeholder="Medicine Manufacturer Price " required="required">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label">Medicine Barcode *</label>
								<input type="text" class="form-control" name="medicineBarcode" placeholder="Medicine Barcode " required="required">
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
									<th class="wd-15p">Medicine Name</th>
									<th class="wd-15p">Medicine Generic Name</th>
									<th class="wd-15p">Medicine Unit</th>
									<th class="wd-15p">Medicine Shelf</th>
									<th class="wd-15p">Medicine Details</th>
									<th class="wd-15p">Medicine Category</th>
									<th class="wd-15p">Medicine Type</th>
									<th class="wd-15p">Medicine Price</th>
									<th class="wd-15p">Medicine Manufacturer</th>
									<th class="wd-15p">Medicine Manufacturer Price</th>
									<th class="wd-15p">Medicine Barcode</th>
								    <th class="wd-10p">Status</th>
									<th class="wd-25p">Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php
									if(is_array($medicines)){
										foreach($medicines as $medicine){
								?>
											<tr>
												<td><?php echo $medicine['medicineName'];?></td>
												<td><?php echo $medicine['medicineGenericName'];?></td>
												<td><?php echo $medicine['medicineUnitName'];?></td>
												<td><?php echo $medicine['medicineShelfName'];?></td>
												<td><?php echo $medicine['medicineDetails'];?></td>
												<td><?php echo $medicine['medicineCategoryName'];?></td>
												<td><?php echo $medicine['medicineTypeName'];?></td>
												<td><?php echo $medicine['medicinePrice'];?></td>
												<td><?php echo $medicine['manufacturerName'];?></td>
												<td><?php echo $medicine['medicineManufacturerPrice'];?></td>
												<td><?php echo $medicine['medicineBarcode'];?></td>
										      <td>
		                  	<?php 
							 
													if($medicine['isActive'] == 1)
													{
														echo "Active";
													}
													else
													{
														echo "Inactive";
													}
												?>
		                  </td>
											<td>
												<?php 
													if($medicine['isActive'] == 1){
												?>
														<a href="<?php echo base_url()?>masters/medicineDetails/makeinactive/<?php echo $medicine['medicineId'];?>" class="btn btn-danger waves-effect waves-light width-md"> 
															<i class="icon icon-dislike" data-toggle="tooltip" title="Make Inactive"></i> 
														</a>
												<?php
													}else{
												?>
														<a href="<?php echo base_url()?>masters/medicineDetails/makeactive/<?php echo $medicine['medicineId'];?>" class="btn btn-success waves-effect waves-light width-md"> 
															<i class="icon icon-like" data-toggle="tooltip" title="Make Active"></i> 
														</a>
												<?php
													}
												?>
		                  	                    <a href="<?php echo base_url()?>masters/medicineDetails/edit/<?php echo $medicine['medicineId'];?>" class="btn btn-success waves-effect waves-light width-md" title="Edit"> 
													<i class="icon icon-note" data-toggle="tooltip" title="Edit"></i> 
												</a>
												<a href="<?php echo base_url()?>masters/medicineDetails/delete/<?php echo $medicine['medicineId'];?>" class="btn btn-danger waves-effect waves-light width-md" title="Delete"> 
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