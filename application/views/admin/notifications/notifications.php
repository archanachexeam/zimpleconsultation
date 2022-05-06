<div class="row">
  <div class="col-md-12">
    <div class="col-md-12 col-lg-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title"><?php echo $pageHeading;?></h3>
        </div>
        <div class="card-body">
          <ul class="list-group">
            <?php
              if(is_array($notifications) && !empty($notifications)){
                $notifications = array_reverse($notifications);
                foreach($notifications as $notification){
            ?>
                  <li class="list-group-item">
                    <a class="dropdown-item d-flex pb-3" href="<?php echo base_url()?>/transactions/Orders/view/<?php echo $notification['orderId'];?>" onclick="markRead(this, event, <?php echo $notification['notificationId'];?>)">
                      <div class="" style="margin-bottom: 1px solid #000;">
                        <i class="fa fa-cog text-primary" aria-hidden="true"></i> &nbsp;&nbsp;
                        <strong><?php echo $notification['notificationContent'];?></strong>
                        <small class="text-muted">
                          <?php echo date('d-m-Y', strtotime($notification['notificationDateTime']));?>
                        </small>
                      </div>
                    </a>
                  </li>
            <?php
                }
              }
            ?>
          </ul>

        </div>
      </div>
    </div>
  </div>
</div>

