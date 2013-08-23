<ul class="nav nav-tabs nav-stacked main-menu">
  <li <?php if (Request::current()->controller() == 'dashboard'): ?>class="active"<?php endif ?>>
    <?php echo HTML::anchor('manager', '<i class="icon-home icon-white"></i><span class="hidden-tablet"> Dashboard</span>') ?>
  </li>
  <!--|new_content|-->
  <?php if(Auth::instance()->logged_in('admin')): ?>
  <li <?php if (Request::current()->controller() == 'Users'): ?>class="active"<?php endif ?>>
    <?php echo HTML::anchor('manager/users', '<i class="icon-user icon-white"></i><span class="hidden-tablet"> Usuários</span>') ?>
  </li>
  <?php endif; ?>
</ul>