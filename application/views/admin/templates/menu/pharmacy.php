<!--APP-SIDEBAR-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
  <div class="side-header" style="border: none;">
    <a class="header-brand1" href="<?php echo base_url().'admin/dashboard/'?>">
      <img src="<?php echo base_url()?>assets/images/brand/logo.png" class="header-brand-img desktop-logo" alt="logo">
      <img src="<?php echo base_url()?>assets/images/brand/logo-1.png" class="header-brand-img toggle-logo" alt="logo">
      <img src="<?php echo base_url()?>assets/images/brand/logo-2.png" class="header-brand-img light-logo" alt="logo">
      <img src="<?php echo base_url()?>assets/images/brand/logo-3.png" class="header-brand-img light-logo1" alt="logo">
    </a><!-- LOGO -->
    <a aria-label="Hide Sidebar" class="app-sidebar__toggle ml-auto" data-toggle="sidebar" href="#"></a><!-- sidebar-toggle-->
  </div>
  <div class="app-sidebar__user">
    <div class="dropdown user-pro-body text-center">
      <div class="user-pic">
        <img src="<?php echo base_url()?>assets/images/users/user.png" alt="user-img" class="avatar-xl rounded-circle">
      </div>
      <div class="user-info">
        <h6 class=" mb-0 text-dark">Hex Hospital</h6>
        <span class="text-muted app-sidebar__user-name text-sm"><?php echo $this->session->userdata['userName'];?></span>
      </div>
    </div>
  </div>
  <div class="sidebar-navs">
    <ul class="nav  nav-pills-circle">
     <li class="nav-item" data-toggle="tooltip" data-placement="top" title="Logout">
        <a class="nav-link text-center m-2" href="<?php echo base_url().'Pharmacy/logout/'?>">
          <i class="fe fe-power"></i>
        </a>
      </li>
    </ul>
  </div>
  <ul class="side-menu">
    <li><h3><?php echo $this->lang->line('Main'); ?></h3></li>
    <li class="slide">
      <a class="side-menu__item" href="<?php echo base_url().'Pharmacy/dashboard/'?>">
        <i class="side-menu__icon ti-home"></i>
        <span class="side-menu__label"><?php echo $this->lang->line('Dashboard'); ?></span>
      </a>
    </li>
    
    <li><h3><?php echo $this->lang->line('Masters'); ?></h3></li>
   
 
  
  
    
    <!-- <li class="slide">
      <a class="side-menu__item" href="<?php //echo base_url().'masters/Medicines/'?>">
        <i class="side-menu__icon fa fa-plus-square"></i>
        <span class="side-menu__label"><?php //echo $this->lang->line('Medicines'); ?></span>
      </a>
    </li> -->
   
     
    <li class="slide">
      <a class="side-menu__item" href="<?php echo base_url().'medicines/medicineDetails/'?>">
        <i class="side-menu__icon fa fa-medkit"></i>
        <span class="side-menu__label"><?php echo $this->lang->line('Medicines'); ?></span>
      </a>
      
      
      <ul class="side-menu">
         
          <li class="slide">
            <a class="side-menu__item" href="<?php echo base_url().'index.php/medicines/Units/'?>">
            <i class="side-menu__icon fa fa-plus-circle"></i>
            <span class="side-menu__label"><?php echo $this->lang->line('Units'); ?>Units</span>
          </a>
          </li>
          <li class="slide">
            <a class="side-menu__item" href="<?php echo base_url().'index.php/medicines/shelves/'?>">
            <i class="side-menu__icon fa fa-table"></i>
            <span class="side-menu__label"><?php echo $this->lang->line('Shelves'); ?>Shelves</span>
          </a>
          </li>
          <li class="slide">
          <a class="side-menu__item" href="<?php echo base_url().'index.php/medicines/Categories/'?>">
            <i class="side-menu__icon fa fa-tasks"></i>
            <span class="side-menu__label"><?php echo $this->lang->line('Medicine Catagory'); ?>Medicine Catagory</span>
          </a>
          </li>
          <li class="slide">
          <a class="side-menu__item" href="<?php echo base_url().'index.php/medicines/Types/'?>">
            <i class="side-menu__icon fa fa-asterisk"></i>
            <span class="side-menu__label"><?php echo $this->lang->line('Medicine Type'); ?>Medicine Type</span>
          </a>
          </li>
          <li class="slide">
          <a class="side-menu__item" href="<?php echo base_url().'index.php/medicines/Manufacturers/'?>">
            <i class="side-menu__icon fa fa-square"></i>
            <span class="side-menu__label"><?php echo $this->lang->line('Medicine Manufacturers'); ?>Medicine Manufacturers</span>
          </a>
          </li>
          <li class="slide">
          <a class="side-menu__item" href="<?php echo base_url().'index.php/masters/Boxpattern/'?>">
            <i class="side-menu__icon fa fa-archive"></i>
            <span class="side-menu__label"><?php echo $this->lang->line('Medicine Box Pattern'); ?>Medicine Box Pattern</span>
          </a>
          </li>
      </ul>
      </li>
   
     <li class="slide">
      <a class="side-menu__item" href="<?php echo base_url().'Pharmacy/purchaseInvoice/'?>">
        <i class="side-menu__icon fa fa-plus-square"></i>
        <span class="side-menu__label"><?php echo $this->lang->line('Purchase Invoice'); ?>Purchase Invoice</span>
      </a>
    </li> 
    <li class="slide">
      <a class="side-menu__item" href="<?php echo base_url().'SaleInvoice/'?>">
        <i class="side-menu__icon fa fa-plus-square"></i>
        <span class="side-menu__label"><?php echo $this->lang->line('Sale Invoice'); ?>Sale Invoice</span>
      </a>
    </li> 
 
    
  
    <!-- <li class="slide">
      <a class="side-menu__item" href="<?php //echo base_url().'masters/Pharmacies/'?>">
        <i class="side-menu__icon fa fa-sign-in"></i>
        <span class="side-menu__label"><?php //echo $this->lang->line('Pharmacies'); ?></span>
      </a>
    </li> -->
    <!-- <li class="slide">
      <a class="side-menu__item" href="<?php //echo base_url().'masters/Laboratories/'?>">
        <i class="side-menu__icon fe fe-file-text"></i>
        <span class="side-menu__label"><?php //echo $this->lang->line('Laboratories'); ?></span>
      </a>
    </li> -->
   
  </ul>
</aside>
<!--/APP-SIDEBAR-->