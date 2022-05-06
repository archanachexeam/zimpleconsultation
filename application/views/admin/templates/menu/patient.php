<!--APP-SIDEBAR-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
  <div class="side-header" style="border: none;">
    <a class="header-brand1" href="<?php echo base_url().'patient/dashboard/'?>">
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
        <h6 class=" mb-0 text-dark"><?php echo $this->session->userdata['userName'];?></h6>
        <span class="text-muted app-sidebar__user-name text-sm">User</span>
      </div>
    </div>
  </div>
  <ul class="side-menu">
    <li><h3><?php echo $this->lang->line('Main'); ?></h3></li>
    <li class="slide">
      <a class="side-menu__item" href="<?php echo base_url().'patient/dashboard/'?>">
        <i class="side-menu__icon ti-home"></i>
        <span class="side-menu__label"><?php echo $this->lang->line('Dashboard'); ?></span>
      </a>
    </li>
    <li><h3><?php echo $this->lang->line('Transactions'); ?></h3></li>
    <li class="slide">
      <a class="side-menu__item" href="<?php echo base_url().'patient/searchDoctor/'?>">
        <i class="side-menu__icon ti ti-search"></i>
        <span class="side-menu__label"><?php echo $this->lang->line('Search Doctor'); ?></span>
      </a>
    </li>
    <li class="slide">
      <a class="side-menu__item" href="<?php echo base_url().'patient/bookings/'?>">
        <i class="side-menu__icon ti ti-save"></i>
        <span class="side-menu__label"><?php echo $this->lang->line('Bookings'); ?></span>
      </a>
    </li>
    <li class="slide">
      <a class="side-menu__item" href="<?php echo base_url().'patient/familymembers/'?>">
        <i class="side-menu__icon fe fe-share-2"></i>
        <span class="side-menu__label"><?php echo $this->lang->line('Family Members'); ?></span>
      </a>
    </li>
  </ul>
</aside>
<!--/APP-SIDEBAR-->