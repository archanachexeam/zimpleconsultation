<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="clearfix">
          <div class="float-left">
            <img src="<?php echo base_url()?>/uploads/settings/<?php echo $settings[0]['hospitalLogo'];?>" alt="<?php echo $settings[0]['hospitalName'];?>">
          </div>
          <div class="float-right">
            <p class="h3"><?php echo $settings[0]['hospitalName'];?></p>
            <address>
              <?php echo $settings[0]['hospitalAddress1'].", ".$settings[0]['hospitalAddress2'];?><br/>
              <?php echo $settings[0]['hospitalCity'].", ".$settings[0]['hospitalState'].", ".$settings[0]['hospitalCountry'];?><br/>
              Pincode : <?php echo $settings[0]['hospitalPincode'];?><br/>
              Phone : <?php echo $settings[0]['hospitalContactNumber'];?> <br/>
              Website : <?php echo $settings[0]['hospitalWebsite'];?>
            </address>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-lg-6 ">
            <p class="h3">Doctor:</p>
            <address>
              <strong>
                Dr. <?php echo $singleBooking[0]['doctorFName']." ".$singleBooking[0]['doctorLName'];?>
              </strong>
              <br/>
              <?php echo $singleBooking[0]['doctorQualifications'];?> <br/>
              Date: <?php echo date('d-m-Y',strtotime($singleBooking[0]['consultationDate']));?><br/>
              Token # : <?php echo $singleBooking[0]['tokenNumber'];?>
            </address>
          </div>
          <div class="col-lg-6 text-right">
            <p class="h3">Patient:</p>
            <address>
              <strong>
                <?php echo $singleBooking[0]['patientFName']." ".$singleBooking[0]['patientLName'];?>
              </strong><br/>
              OP Number : <?php echo $singleBooking[0]['patientOPNumber'];?><br/>
              <?php echo $singleBooking[0]['patientAddress1']?><br/>
              <?php echo $singleBooking[0]['patientAddress2'];?><br/>
              <?php echo $singleBooking[0]['patientCity'].", ".$singleBooking[0]['patientState'];?><br/>
              Phone : <?php echo $singleBooking[0]['patientPhone'];?> <br/>
            </address>
          </div>
        </div>
        <div class="table-responsive push">
          <table id="" class="table table-striped table-bordered text-nowrap w-100">
            <thead>
              <tr>
                <th class="wd-15p">Medicine Name</th>
                <th class="wd-15p">Dosage</th>
                <th class="wd-15p">Period</th>
                <th class="wd-15p">Remarks</th>
              </tr>
            </thead>
            <tbody class="medicineTableList">
              <?php
                if(is_array($bookingMedicines)){
                  foreach($bookingMedicines as $bookingMedicine){
              ?>
                <tr>
                  <td><?php echo $bookingMedicine['medicineName'];?></td>
                  <td><?php echo $bookingMedicine['dosage'];?></td>
                  <td><?php echo $bookingMedicine['period'];?> Days</td>
                  <td><?php echo $bookingMedicine['remarks'];?></td>
                </tr>
              <?php
                  }
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer text-right">
        <button type="button" class="btn btn-info mb-1" onclick="javascript:window.print();"><i class="si si-printer"></i> Print Medicine List</button>
      </div>
    </div>
  </div><!-- COL-END -->
</div>