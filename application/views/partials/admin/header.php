<nav class="top-bar">
    <ul class="title-area">
      <!-- Title Area -->
      <li class="name">
        <h1><a href="<?php echo URL::base() ?>"> <?php echo Kohana::$config->load('config')->get( 'site.name', '' ) ?> </a></h1>
      </li>
      <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
      <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
    </ul>

    <section class="top-bar-section">
      <!-- Right Nav Section -->
      <ul class="right">
        
        <li class="<?php echo ($currentPage == 'users')?'active':'' ?>"><a href="<?php echo ($currentPage == 'users')?'javascript:void(0)':URL::site('admin/panel/users') ?>">Users</a></li>
        <li class="<?php echo ($currentPage == 'jobs')?'active':'' ?>"><a href="<?php echo ($currentPage == 'jobs')?'javascript:void(0)':URL::site('admin/panel/jobs?show_unpaid=1&show_already_approved=1') ?>">Jobs</a></li>
        <li class="divider show-for-small"></li>
        <li class="has-form">
          <a class="button" href="<?php echo URL::site('admin/session/logout') ?>">Logout</a>
        </li>
      </ul>
    </section>
</nav>