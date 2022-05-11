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
						<div class="col-md-12">
							<div class="row">
								<div class="form-group col-md-6">
									<label class="form-label">Medicine Name *</label>
									<input type="text" class="form-control" name="medicineName" placeholder="Medicine Name" required="required" value="<?php echo $singlemedicine[0]['medicineName'];?>">
									<input type="hidden" name="medicineId" value="<?php echo $singlemedicine[0]['medicineId'];?>">
								</div>
								<div class="form-group col-md-6">
									<label class="form-label">Medicine Generic Name *</label>
									<input type="text" class="form-control" name="medicineGenericName" placeholder="Medicine Generic Name" required="required" value="<?php echo $singlemedicine[0]['medicineGenericName'];?>">
								</div>
                                <div class="form-group col-md-6">
									<label class="form-label">Medicine Unit</label>
									<?php 
		                $designationsOptionsJs = 'id="medicineUnit" class="form-control medicineUnit select2-show-search"';
		                echo form_dropdown('medicineUnit', $medicineUnit, $singlemedicine[0]['medicineUnit'], $designationsOptionsJs);
		              ?>
								</div>
                                <div class="form-group col-md-6">
									<label class="form-label">Medicine Shelf</label>
									<?php 
		                $designationsOptionsJs = 'id="medicineShelf" class="form-control medicineShelf select2-show-search"';
		                echo form_dropdown('medicineShelf', $medicineShelf, $singlemedicine[0]['medicineShelf'], $designationsOptionsJs);
		              ?>
								</div>
                                <div class="form-group col-md-6">
									<label class="form-label">Medicine Details *</label>
									<input type="text" class="form-control" name="medicineDetails" placeholder="Medicine Details" required="required" value="<?php echo $singlemedicine[0]['medicineDetails'];?>">
								</div>
                                <div class="form-group col-md-6">
									<label class="form-label">Medicine Category</label>
									<?php 
		                $designationsOptionsJs = 'id="medicineCategory" class="form-control medicineCategory select2-show-search"';
		                echo form_dropdown('medicineCategory', $medicineCategory, $singlemedicine[0]['medicineCategory'], $designationsOptionsJs);
		              ?>
								</div>
                                <div class="form-group col-md-6">
									<label class="form-label">Medicine Type</label>
									<?php 
		                $designationsOptionsJs = 'id="medicineType" class="form-control medicineType select2-show-search"';
		                echo form_dropdown('medicineType', $medicineType, $singlemedicine[0]['medicineType'], $designationsOptionsJs);
		              ?>
								</div>
                                <div class="form-group col-md-6">
									<label class="form-label">Medicine Price *</label>
									<input type="text" class="form-control" name="medicinePrice" placeholder="Medicine Price" required="required" value="<?php echo $singlemedicine[0]['medicinePrice'];?>">
								</div>
                                <div class="form-group col-md-6">
									<label class="form-label">Medicine Manufacturer</label>
									<?php 
		                $designationsOptionsJs = 'id="medicineManufacturer" class="form-control medicineManufacturer select2-show-search"';
		                echo form_dropdown('medicineManufacturer', $medicineManufacturer, $singlemedicine[0]['medicineManufacturer'], $designationsOptionsJs);
		              ?>
								</div>
                                <div class="form-group col-md-6">
									<label class="form-label">Medicine Manufacturer Price *</label>
									<input type="text" class="form-control" name="medicineManufacturerPrice" placeholder="Medicine Manufacturer Price" required="required" value="<?php echo $singlemedicine[0]['medicineManufacturerPrice'];?>">
								</div>
                                <div class="form-group col-md-6">
									<label class="form-label">Medicine Barcode *</label>
									<input type="text" class="form-control" name="medicineBarcode" placeholder="Medicine Barcode" required="required" value="<?php echo $singlemedicine[0]['medicineBarcode'];?>">
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
</div>