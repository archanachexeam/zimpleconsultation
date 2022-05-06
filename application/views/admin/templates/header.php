<?php
  if($this->session->userdata('site_lang') != ""){
    if($this->session->userdata('site_lang') == "arabic"){
      $hexAssetPath = base_url().'assets/rtl/';
    }else{
      $hexAssetPath = base_url().'assets/';
    }
  }else{
    $hexAssetPath = base_url().'assets/';
  }
  //echo $hexAssetPath;
?>

<!doctype html>
<html lang="en" dir="ltr">
  <head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $hexAssetPath;?>images/brand/favicon.ico" />

    <!-- TITLE -->
    <title><?php echo $pageTitle;?></title>

    <!-- BOOTSTRAP CSS -->
    <link href="<?php echo $hexAssetPath;?>plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <!-- STYLE CSS -->
    <link href="<?php echo $hexAssetPath;?>css/style.css" rel="stylesheet"/>
    <link href="<?php echo $hexAssetPath;?>css/skin-modes.css" rel="stylesheet"/>
    
    <!-- SIDE-MENU CSS -->
    <link href="<?php echo $hexAssetPath;?>plugins/sidemenu/closed-sidemenu.css" rel="stylesheet">

    <!-- SINGLE-PAGE CSS -->
    <link href="<?php echo $hexAssetPath;?>plugins/single-page/css/main.css" rel="stylesheet" type="text/css">

    <!--C3 CHARTS CSS -->
    <link href="<?php echo $hexAssetPath;?>plugins/charts-c3/c3-chart.css" rel="stylesheet"/>

    <!-- CUSTOM SCROLL BAR CSS-->
    <link href="<?php echo $hexAssetPath;?>plugins/scroll-bar/jquery.mCustomScrollbar.css" rel="stylesheet"/>

    <!--- FONT-ICONS CSS -->
    <link href="<?php echo $hexAssetPath;?>css/icons.css" rel="stylesheet"/>
    
    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="<?php echo $hexAssetPath;?>colors/color1.css" />

    <!-- FILE UPLODE CSS -->
    <link href="<?php echo $hexAssetPath;?>plugins/fileuploads/css/fileupload.css" rel="stylesheet" type="text/css"/>

    <!-- DATA TABLE CSS -->
    <link href="<?php echo $hexAssetPath;?>plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet"/>

    <!--BOOTSTRAP-DATERANGEPICKER CSS-->
    <link rel="stylesheet" href="<?php echo $hexAssetPath;?>plugins/bootstrap-daterangepicker/daterangepicker.css">
    
    <!-- TIME PICKER CSS -->
    <link href="<?php echo $hexAssetPath;?>plugins/time-picker/jquery.timepicker.css" rel="stylesheet"/>

    <!-- DATE PICKER CSS -->
    <link href="<?php echo $hexAssetPath;?>plugins/date-picker/spectrum.css" rel="stylesheet"/>

    <!-- SELECT2 CSS -->
    <link href="<?php echo $hexAssetPath;?>plugins/select2/select2.min.css" rel="stylesheet"/>

    <link href="<?php echo $hexAssetPath;?>plugins/summernote/summernote-bs4.css" rel="stylesheet">
    <link href="<?php echo $hexAssetPath;?>plugins/wysiwyag/richtext.css" rel="stylesheet">

    <!-- JQUERY JS -->
    <script src="<?php echo $hexAssetPath;?>js/jquery-3.4.1.min.js"></script>
    
  </head>
  <body class="app sidebar-mini">

    <!-- GLOBAL-LOADER -->
    <div id="global-loader">
      <img src="<?php echo base_url()?>assets/images/loader.svg" class="loader-img" alt="Loader">
    </div>
    <!-- /GLOBAL-LOADER -->

    <!-- PAGE -->
    <div id="app" class="page">
      <div class="page-main">

        <?php
          if($this->session->userdata('logged_in_type') == "user"){
            include 'menu/patient.php';
          }else if($this->session->userdata('logged_in_type') == "doctor"){
            include 'menu/doctor.php';
          }else if($this->session->userdata('logged_in_type') == "frontoffice"){
            include 'menu/frontoffice.php';
          }else if($this->session->userdata('logged_in_type') == "admin"){
            include 'menu/superadmin.php';
          }else{
            include 'menu/superadmin.php';
          }
          
        ?>
        

        <!-- Mobile Header -->
        <div class="mobile-header">
          <div class="container-fluid">
            <div class="d-flex">
              <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-toggle="sidebar" href="#"></a><!-- sidebar-toggle-->
              <a class="header-brand" href="index.html">
                <img src="<?php echo base_url()?>assets/images/brand/logo.png" class="header-brand-img desktop-logo" alt="logo">
                <img src="<?php echo base_url()?>assets/images/brand/logo-3.png" class="header-brand-img desktop-logo mobile-light" alt="logo">
              </a>
              <div class="d-flex order-lg-2 ml-auto header-right-icons">
                <button class="navbar-toggler navresponsive-toggler d-md-none" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4"
                  aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon fe fe-more-vertical text-white"></span>
                </button>
                <div class="dropdown profile-1">
                  <a href="#" data-toggle="dropdown" class="nav-link pr-2 leading-none d-flex">
                    <span>
                      <img src="<?php echo base_url()?>assets/images/users/user.png" alt="profile-user" class="avatar  profile-user brround cover-image">
                    </span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <div class="drop-heading">
                      <div class="text-center">
                        <h5 class="text-dark mb-0"><?php echo $this->session->userdata['userName'];?></h5>
                        <small class="text-muted">Administrator</small>
                      </div>
                    </div>
                    <div class="dropdown-divider m-0"></div>
                    <a class="dropdown-item" href="<?php echo base_url().'profile/'?>">
                      <i class="dropdown-icon mdi mdi-account-outline"></i> Profile
                    </a>
                    <a class="dropdown-item" href="<?php echo base_url().'settings/'?>">
                      <i class="dropdown-icon  mdi mdi-settings"></i> Settings
                    </a>
                    <a class="dropdown-item" href="<?php echo base_url().'admin/logout/'?>">
                      <i class="dropdown-icon mdi  mdi-logout-variant"></i> Sign out
                    </a>
                  </div>
                </div>
                <div class="dropdown d-md-flex header-settings">
                  <a href="#" class="nav-link icon " data-toggle="sidebar-right" data-target=".sidebar-right">
                    <i class="fe fe-align-right"></i>
                  </a>
                </div><!-- SIDE-MENU -->
              </div>
            </div>
          </div>
        </div>
        <div class="mb-1 navbar navbar-expand-lg  responsive-navbar navbar-dark d-md-none bg-white">
          <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
            <div class="d-flex order-lg-2 ml-auto">
              <div class="dropdown d-sm-flex">
                <a href="#" class="nav-link icon" data-toggle="dropdown">
                  <i class="fe fe-search"></i>
                </a>
                <div class="dropdown-menu header-search dropdown-menu-left">
                  <div class="input-group w-100 p-2">
                    <input type="text" class="form-control " placeholder="Search....">
                    <div class="input-group-append ">
                      <button type="button" class="btn btn-primary ">
                        <i class="fa fa-search" aria-hidden="true"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div><!-- SEARCH -->
              <div class="dropdown d-md-flex">
                <a class="nav-link icon full-screen-link nav-link-bg">
                  <i class="fe fe-maximize fullscreen-button"></i>
                </a>
              </div><!-- FULL-SCREEN -->
              <div class="dropdown d-md-flex notifications">
                <a class="nav-link icon" data-toggle="dropdown">
                  <i class="fe fe-bell"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                  <div class="notifications-menu">
                    <?php
                      if(is_array($notifications) && !empty($notifications)){
                        foreach($notifications as $notification){
                    ?>
                          <a class="dropdown-item d-flex pb-3" href="<?php echo base_url()?>/transactions/Orders/view/<?php echo $notification['orderId'];?>" onclick="markRead(this, event, <?php echo $notification['notificationId'];?>)">
                            <div class="fs-16 text-success mr-3">
                              <i class="fa fa-thumbs-o-up"></i>
                            </div>
                            <div class="">
                              <strong><?php echo $notification['notificationContent'];?></strong>
                            </div>
                          </a>
                    <?php
                        }
                      }else{
                    ?>

                    <?php
                      }
                    ?>
                    
                    <!-- <a class="dropdown-item d-flex pb-3" href="#">
                      <div class="fs-16 text-primary mr-3">
                        <i class="fa fa-commenting-o"></i>
                      </div>
                      <div class="">
                        <strong>3 New Comments.</strong>
                      </div>
                    </a>
                    <a class="dropdown-item d-flex pb-3" href="#">
                      <div class="fs-16 text-danger mr-3">
                        <i class="fa fa-cogs"></i>
                      </div>
                      <div class="">
                        <strong>Server Rebooted</strong>
                      </div>
                    </a> -->
                  </div>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item text-center">View all Notification</a>
                </div>
              </div><!-- NOTIFICATIONS -->
            </div>
          </div>
        </div>
        <!-- /Mobile Header -->

        <!--app-content open-->
        <div class="app-content">
          <div class="side-app">

            <!-- PAGE-HEADER -->
            <div class="page-header">
              <a aria-label="Hide Sidebar" class="app-sidebar__toggle close-toggle" data-toggle="sidebar" href="#"></a><!-- sidebar-toggle-->
              <div>
                <h1 class="page-title"><?php echo $pageHeading;?></h1>
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page"><?php echo $pageHeading;?></li>
                </ol>
              </div>
              <div class="d-flex  ml-auto header-right-icons header-search-icon">

                <div class="dropdown d-md-flex">
                  <a class="nav-link icon full-screen-link nav-link-bg">
                    <i class="fe fe-maximize fullscreen-button"></i>
                  </a>
                </div><!-- FULL-SCREEN -->

                <div class="dropdown profile-1">
                  <a href="#" data-toggle="dropdown" class="nav-link pr-2 leading-none d-flex">
                    <span>
                      <img src="<?php echo base_url()?>assets/images/users/user.png" alt="profile-user" class="avatar  profile-user brround cover-image">
                    </span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <div class="drop-heading">
                      <div class="text-center">
                        <h5 class="text-dark mb-0"><?php echo $this->session->userdata['userName'];?></h5>
                        <small class="text-muted">
                          <?php
                            if($this->session->userdata('logged_in_type') == "user"){
                              echo "User";
                              $profileLink = base_url().'patient/Profile';
                              $logoutLink = base_url().'patient/logout';
                            }else if($this->session->userdata('logged_in_type') == "doctor"){
                              echo "Doctor";
                              $profileLink = base_url().'doctor/Profile';
                              $logoutLink = base_url().'doctor/logout';
                            }else if($this->session->userdata('logged_in_type') == "frontoffice"){
                              echo "Front Office";
                              $profileLink = base_url().'frontoffice/Profile';
                              $logoutLink = base_url().'frontoffice/logout';
                            }else if($this->session->userdata('logged_in_type') == "admin"){
                              echo "Administrator";
                              $profileLink = base_url().'Profile';
                              $logoutLink = base_url().'Admin/logout';
                            }else{
                              echo "";
                            }
                          ?>
                        </small>
                      </div>
                    </div>
                    <div class="dropdown-divider m-0"></div>
                    <?php if($this->session->userdata('logged_in_type') == "admin" || $this->session->userdata('logged_in_type') == "frontoffice" || $this->session->userdata('logged_in_type') == "user"){?>
                    <a class="dropdown-item" href="<?php echo $profileLink;?>">
                      <i class="dropdown-icon mdi mdi-account-outline"></i> Profile
                    </a>
                    <?php } ?>
                    <?php if($this->session->userdata('logged_in_type') == "admin"){?>
                      <a class="dropdown-item" href="<?php echo base_url().'Settings/'?>">
                        <i class="dropdown-icon  mdi mdi-settings"></i> Settings
                      </a>
                    <?php } ?>
                    <a class="dropdown-item" href="<?php echo $logoutLink;?>">
                      <i class="dropdown-icon mdi  mdi-logout-variant"></i> Sign out
                    </a>
                  </div>
                </div>
              </div>
              <!-- <div class="switc-dir">
                <?php 
                  // if($this->session->userdata('site_lang') != ""){
                  //   $selectedLang = $this->session->userdata('site_lang');
                  // }else{
                  //   $selectedLang = "english";
                  // }
                  // $languages = array('english' => 'EN','arabic' => 'AR');
                  // $designationsOptionsJs = 'id="hexLang" class="form-control hexLang"';
                  // echo form_dropdown('hexLang', $languages, $selectedLang, $designationsOptionsJs);
                ?>
              </div> -->
            </div>
            <!-- PAGE-HEADER END -->

        