<div class="row">
	<div class="col-md-12">
		<div class="col-md-12 col-lg-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title"><?php echo "View ".$singleHeading." : ".$singledoctor[0]['doctorFName']." ".$singledoctor[0]['doctorLName'];?></h3>
				</div>
				<div class="card-body">
					<div class="wideget-user">
						<div class="row">
							<div class="col-lg-6 col-md-12">
								<div class="wideget-user-desc d-sm-flex">
									<div class="wideget-user-img">
										<img class="" src="<?php echo base_url()?>/uploads/doctors/<?php echo $singledoctor[0]['doctorPhoto'];?>" alt="img" width="150" height="auto">
									</div>
									<div class="user-wrap">
										<h4><?php echo $singledoctor[0]['doctorFName']." ".$singledoctor[0]['doctorLName'];?></h4>
										<h5><?php echo $singledoctor[0]['departmentName'];?></h5>
										<a href="tel:<?php echo $singledoctor[0]['doctorPhone'];?>" class="btn btn-primary mt-1 mb-1"><i class="fa fa-phone"></i> Call</a>
										<a href="mailto:<?php echo $singledoctor[0]['doctorEmail'];?>" class="btn btn-secondary mt-1 mb-1"><i class="fa fa-envelope"></i> E-mail</a>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-12">

							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-body">
					<div class="border-0">
						<div id="profile-log-switch">
							<div class="media-heading">
								<h4><strong>General Information</strong></h4>
							</div>
							<div class="table-responsive ">
								<table class="table row table-borderless">
									<tbody class="col-lg-12 col-xl-4 p-0">
										<tr>
											<td><strong>First Name :</strong> <?php echo $singledoctor[0]['doctorFName'];?></td>
										</tr>
										<tr>
											<td><strong>Last Name :</strong> <?php echo $singledoctor[0]['doctorLName'];?></td>
										</tr>
									</tbody>
									<tbody class="col-lg-12 col-xl-4 p-0">
										<tr>
											<td><strong>Department :</strong> <?php echo $singledoctor[0]['departmentName'];?></td>
										</tr>
										<tr>
											<td><strong>Qulifications :</strong> <?php echo $singledoctor[0]['doctorQualifications'];?></td>
										</tr>
									</tbody>
									<tbody class="col-lg-12 col-xl-4 p-0">
										<tr>
											<td><strong>Contact Number :</strong> <?php echo $singledoctor[0]['doctorPhone'];?></td>
										</tr>
										<tr>
											<td><strong>Email :</strong> <?php echo $singledoctor[0]['doctorEmail'];?></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>