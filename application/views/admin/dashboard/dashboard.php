<!-- ROW-1 -->
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xl-6">
    <div class="row">
      <div class="col-lg-6 col-md-12 col-sm-12 col-xl-6">
        <div class="card card-box-clr">
          <div class="card-body text-center statistics-info">
            <div class="counter-icon  mb-0 box-primary-shadow circlr-bg">
              <!-- <i class="fe fe-trending-up text-white"></i> -->
              <i class="side-menu__icon fe fe-grid"></i>
            </div>
           
            <h2 class="mt-4 mb-0 number-font"><?php echo $departmentCount;?></h2>
            
          </div>
           <h6 class=" mb-0 card-box-head"><?php echo $this->lang->line('totalDepartment'); ?></h6>
        </div>
      </div>
      <div class="col-lg-6 col-md-12 col-sm-12 col-xl-6">
        <div class="card card-box-clr">
          <div class="card-body text-center statistics-info">
            <div class="counter-icon bg-secondary mb-0 box-secondary-shadow circlr-bg">
              <!-- <i class="fe fe-codepen text-white"></i> -->
              <i class="side-menu__icon fa fa-address-card-o"></i>
            </div>
    
            <h2 class="mt-4 mb-0 number-font"><?php echo $doctorsCount;?></h2>
          </div>
            <h6 class=" mb-0 card-box-head"><?php echo $this->lang->line('totalDoctors'); ?></h6>
        </div>
      </div>
      <div class="col-lg-6 col-md-12 col-sm-12 col-xl-6">
        <div class="card card-box-clr">
          <div class="card-body text-center statistics-info">
            <div class="counter-icon bg-success mb-0 box-success-shadow circlr-bg">
              <!-- <i class="fe fe-dollar-sign text-white"></i> -->
              <i class="side-menu__icon fa fa-sitemap"></i>
            </div>
           
            <h2 class="mt-4 mb-0 number-font"><?php echo $frontofficesCount;?></h2>
          </div>
            <h6 class=" mb-0 card-box-head"><?php echo $this->lang->line('totalFrontOffice'); ?></h6>
        </div>
      </div>
      <div class="col-lg-6 col-md-12 col-sm-12 col-xl-6">
        <div class="card card-box-clr">
          <div class="card-body text-center statistics-info">
            <div class="counter-icon bg-info mb-0 box-info-shadow circlr-bg">
              <!-- <i class="fe fe-briefcase text-white"></i> -->
              <i class="side-menu__icon ti ti-save"></i>
            </div>
             
            <h2 class="mt-4 mb-0 number-font"><?php echo $bookingsCount;?></h2>
          </div>
            <h6 class=" mb-0 card-box-head"><?php echo $this->lang->line('totalBooking'); ?></h6>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-12 col-md-12 col-sm-12 col-xl-6">
    <div class="row">
      <div class="col-12 col-sm-12">
        <div class="card ">
          <div class="card-header card-box-head-t">
            <h3 class="card-title mb-0"><?php echo $this->lang->line('todaysBooking'); ?></h3>
          </div>
          <div class="card-body">
            <div class="grid-margin">
              <div class="">
                <div class="table-responsive">
                  <table class="table card-table border table-vcenter text-nowrap align-items-center">
                    <thead class="">
                      <tr>
                        <th>Date</th>
                        <th>Doctor</th>
                        <th>Patient</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        if(is_array($bookings)){
                          foreach($bookings as $booking){
                      ?>
                            <tr>
                              <td class="text-sm font-weight-600">
                                <?php echo date('d-m-Y', strtotime($booking['consultationDate']));?>
                              </td>
                              <td>
                                <?php echo $booking['doctorFName']." ".$booking['doctorLName'];?>
                              </td>
                              <td>
                                <?php echo $booking['patientFName']." ".$booking['patientLName'];?>
                              </td>
                              <td><?php echo $booking['bookingStatusName'];?></td>
                            </tr>
                      <?php
                          }
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div><!-- COL END -->
    </div>
  </div>
</div>
    <!-- ROW-1 END -->


  