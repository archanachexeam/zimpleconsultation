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
								<label class="form-label">Medicine Catagory *</label>
								<input type="text" class="form-control" name="medicineCategoryName" value="<?php echo $categories[0]['medicineCategoryName'];?>"placeholder="Medicine Catagory" required="required">
								<input type="hidden" name="medicineCategoryName" value="<?php echo $categories[0]['medicineCategoryId'];?>">
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
									<th class="wd-15p">Medicine Catagory Name</th>
								    <th class="wd-10p">Status</th>
									<th class="wd-25p">Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php
									if(is_array($categories)){
										foreach($categories as $category){
								?>
											<tr>
												<td><?php echo $category['medicineCategoryName'];?></td>
												<td>
		                  	<?php 
													if($category['isActive'] == 1){
														echo "Active";
													}else{
														echo "Inactive";
													}
												?>
		                  </td>
											<td>
												<?php 
													if($category['isActive'] == 1){
												?>
														<a href="<?php echo base_url()?>medicines/categories/makeinactive/<?php echo $category['medicineCategoryId'];?>" class="btn btn-danger waves-effect waves-light width-md"> 
															<i class="icon icon-dislike" data-toggle="tooltip" title="Make Inactive"></i> 
														</a>
												<?php
													}else{
												?>
														<a href="<?php echo base_url()?>medicines/catagories/makeactive/<?php echo $category['medicineCategoryId'];?>" class="btn btn-success waves-effect waves-light width-md"> 
															<i class="icon icon-like" data-toggle="tooltip" title="Make Active"></i> 
														</a>
												<?php
													}
												?>
		                  	                    <a href="<?php echo base_url()?>medicines/categories/edit/<?php echo $category['medicineCategoryId'];?>" class="btn btn-success waves-effect waves-light width-md" title="Edit"> 
													<i class="icon icon-note" data-toggle="tooltip" title="Edit"></i> 
												</a>
												<a href="<?php echo base_url()?>medicines/categories/delete/<?php echo $category['medicineCategoryId'];?>" class="btn btn-danger waves-effect waves-light width-md" title="Delete"> 
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