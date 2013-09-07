<div class="navbar-wrapper clearfix">
  <div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
      <div class="container">
        <h1 class="brand"><a href="<?php echo URL::base() ?>" title="Designers"><img src="<?php echo URL::site('assets/img/designers_b.png') ?>"/></a></h1>
        <form action="<?php echo URL::site('jobs/search') ?>" method="get" class="navbar-search">
          <div class="in">
            <input type="text"  class="search-query" placeholder="Search" name="query" value="<?php echo $searchQuery ?>" >
          </div>
        </form>
        <nav>
          <ul id="menu-main" class="nav hidden-desktop">
            <li>
              <a title="Post a Job" href="form.html" class="btn btn-big grad">
                <span>Post a Job = Find a designer</span>
                <span class="sub-btn-big">Fast, easy, chip</span>
              </a>
            </li>
          </ul>
        </nav>
      </div> <!-- /.container -->
    </div><!-- /.navbar-inner -->
  </div><!-- /.navbar --> 
</div>