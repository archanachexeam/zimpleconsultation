<div class="row">
	<div class="col-md-12">
		<div class="col-md-12 col-lg-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title"><?php echo $pageHeading;?></h3>
				</div>
				<div class="card-body">
					<?php 
	          $attributes = array('class' => 'form form-horizontal form-bordered', 'id' => 'form');
	          echo form_open_multipart($loginRedirect,$attributes);
	        ?>
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								<div class="form-group col-md-6">
									<label class="form-label">Name *</label>
									<input type="text" class="form-control" name="adminName" placeholder="First Name" required="required" value="<?php echo $users[0]['adminName'];?>">
								</div>
								<div class="form-group col-md-6">
									<label class="form-label">Email Address *</label>
									<input type="email" class="form-control" name="adminEmail" placeholder="Email Address" required="required" value="<?php echo $users[0]['adminEmail'];?>" readonly>
								</div>
								<div class="form-group col-md-6">
									<label class="form-label">Username *</label>
									<input type="text" class="form-control" name="adminUsername" placeholder="Username" required="required" value="<?php echo $users[0]['adminUsername'];?>" readonly>
								</div>
								<div class="form-group col-md-6">
									<label class="form-label">Password <sup>(Only if needed)</sup> </label>
									<input type="password" class="form-control" name="adminPassword" placeholder="Password" value="">
								</div>
							</div>
						</div>
						<div class="col-md-1"></div>
						<div class="col-md-3">

						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<div class="form-label"></div>
								<input type="submit" class="btn btn-primary" name="" value="Update Profile">
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