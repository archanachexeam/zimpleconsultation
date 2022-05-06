<!doctype html>
<html lang="en" dir="ltr">
  <head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url()?>assets/images/brand/favicon.ico" />

    <!-- TITLE -->
    <title><?php echo $pageTitle;?></title>

    <!-- BOOTSTRAP CSS -->
    <link href="<?php echo base_url()?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <!-- STYLE CSS -->
    <link href="<?php echo base_url()?>assets/css/style.css" rel="stylesheet"/>
    <link href="<?php echo base_url()?>assets/css/skin-modes.css" rel="stylesheet"/>
    
    <!-- SIDE-MENU CSS -->
    <link href="<?php echo base_url()?>assets/plugins/sidemenu/closed-sidemenu.css" rel="stylesheet">

    <!-- SINGLE-PAGE CSS -->
    <link href="<?php echo base_url()?>assets/plugins/single-page/css/main.css" rel="stylesheet" type="text/css">

    <!--C3 CHARTS CSS -->
    <link href="<?php echo base_url()?>assets/plugins/charts-c3/c3-chart.css" rel="stylesheet"/>

    <!-- CUSTOM SCROLL BAR CSS-->
    <link href="<?php echo base_url()?>assets/plugins/scroll-bar/jquery.mCustomScrollbar.css" rel="stylesheet"/>

    <!--- FONT-ICONS CSS -->
    <link href="<?php echo base_url()?>assets/css/icons.css" rel="stylesheet"/>
    
    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="<?php echo base_url()?>assets/colors/color1.css" />
    
  </head>
  <body>
    <!-- BACKGROUND-IMAGE -->
    <div class="login-img">

      <!-- GLOABAL LOADER -->
      <div id="global-loader">
        <img src="<?php echo base_url()?>assets/images/loader.svg" class="loader-img" alt="Loader">
      </div>
      <!-- /GLOABAL LOADER -->

      <!-- PAGE -->
      <div class="page" style="background-image: url('<?php echo base_url()?>assets/images/backgrounds/patient.jpg'); background-size: contain; background-size: cover; background-position: bottom; background-repeat: no-repeat;">
        <div class="">
            <!-- CONTAINER OPEN -->
          <div class="col col-login mx-auto">
            <div class="text-center">
              <img src="../assets/images/brand/logo.png" class="header-brand-img" alt="logo">
            </div>
          </div>
          <div class="container-login100">
            <div class="wrap-login100 p-6">
              <?php
                $attributes = array('class' => 'login100-form validate-form', 'id' => 'form');
                echo form_open($loginRedirect,$attributes);
              ?>
                <span class="login100-form-title">
                  Patient Registration
                </span>
                <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                  <input class="input100" type="text" name="userFName" placeholder="First name">
                  <span class="focus-input100"></span>
                  <span class="symbol-input100">
                    <i class="mdi mdi-account" aria-hidden="true"></i>
                  </span>
                </div>
                <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                  <input class="input100" type="text" name="userLName" placeholder="Last name">
                  <span class="focus-input100"></span>
                  <span class="symbol-input100">
                    <i class="mdi mdi-account" aria-hidden="true"></i>
                  </span>
                </div>
                <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                  <input class="input100" type="text" name="userPhone" placeholder="Phone Number">
                  <span class="focus-input100"></span>
                  <span class="symbol-input100">
                    <i class="mdi mdi-phone" aria-hidden="true"></i>
                  </span>
                </div>
                <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                  <input class="input100" type="text" name="userEmail" placeholder="Email">
                  <span class="focus-input100"></span>
                  <span class="symbol-input100">
                    <i class="zmdi zmdi-email" aria-hidden="true"></i>
                  </span>
                </div>
                <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                  <input class="input100" type="text" name="userLogin" placeholder="Username">
                  <span class="focus-input100"></span>
                  <span class="symbol-input100">
                    <i class="mdi mdi-account" aria-hidden="true"></i>
                  </span>
                </div>
                <div class="wrap-input100 validate-input" data-validate="Password is required">
                  <input class="input100" type="password" name="userPassword" placeholder="Password">
                  <span class="focus-input100"></span>
                  <span class="symbol-input100">
                    <i class="zmdi zmdi-lock" aria-hidden="true"></i>
                  </span>
                </div>
                <div class="container-login100-form-btn">
                  <input type="submit" name="" class="login100-form-btn btn-primary" value="Register">
                </div>
                <div class="text-center pt-3">
                  <p class="text-dark mb-0">Already have account?<a href="<?php echo $loginRedirectLogin;?>" class="text-primary ml-1">Sign In</a></p>
                </div>
              <?php echo form_close();?>
              <?php 
                if($this->session->flashdata('registerMessage')){ ?>
                  <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show" style="margin-top:5px;margin-bottom:5px;">
                    <center><?php echo $this->session->flashdata('registerMessage');?></center>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
              <?php } ?>
            </div>
          </div>
          <!-- CONTAINER CLOSED -->
        </div>
      </div>
      <!-- End PAGE -->

    </div>
    <!-- BACKGROUND-IMAGE CLOSED -->

    <!-- JQUERY JS -->
    <script src="<?php echo base_url()?>assets/js/jquery-3.4.1.min.js"></script>

    <!-- BOOTSTRAP JS -->
    <script src="<?php echo base_url()?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url()?>assets/plugins/bootstrap/js/popper.min.js"></script>

    <!-- SPARKLINE JS -->
    <script src="<?php echo base_url()?>assets/js/jquery.sparkline.min.js"></script>

    <!-- CHART-CIRCLE JS -->
    <script src="<?php echo base_url()?>assets/js/circle-progress.min.js"></script>

    <!-- RATING STAR JS -->
    <script src="<?php echo base_url()?>assets/plugins/rating/jquery.rating-stars.js"></script>

    <!-- INPUT MASK JS -->
    <script src="<?php echo base_url()?>assets/plugins/input-mask/jquery.mask.min.js"></script>

    <!-- CUSTOM SCROLL BAR JS-->
    <script src="<?php echo base_url()?>assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>

    <!-- CUSTOM JS-->
    <script src="<?php echo base_url()?>assets/js/custom.js"></script>
  </body>
</html>