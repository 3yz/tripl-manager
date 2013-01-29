<div>
  <hr>
  <ul class="breadcrumb">
    <li>
      <a href="<?php echo URL::base(true) . 'manager/'; ?>">Home</a> <span class="divider">/</span>
    </li>
    <li>
      <a href="<?php echo URL::base(true) . 'manager/users'; ?>">Usuários</a>
    </li>
  </ul>
  <hr>
</div> 
<?php echo View::factory('manager/templates/notices')->set('messages', Notices::get()) ?>
<div class="row-fluid">
  <div class="box span12">
    <div class="box-header" data-original-title>
      <h2><i class="icon-edit"></i><span class="break"></span>Perfil</h2>
      <!-- <div class="box-icon">
        <a href="#" class="btn-setting"><i class="icon-wrench"></i></a>
        <a href="#" class="btn-minimize"><i class="icon-chevron-up"></i></a>
        <a href="#" class="btn-close"><i class="icon-remove"></i></a>
      </div> -->
    </div>
    <div class="box-content">
    <?php echo Form::open('manager/users/profile/', array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data')) ?>
    <?php 
      echo View::factory('manager/users/_form')
        ->set('user', $user) 
        ->set('roles', $roles) 
        ->set('errors', $errors) 
    ?>
    <?php echo Form::close() ?>

    </div>
  </div><!--/span-->

</div><!--/row-->
