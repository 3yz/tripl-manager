<div>
  <hr>
  <ul class="breadcrumb">
    <li>
      <a href="<?php echo URL::base(true) . 'manager' ?>">Home</a> <span class="divider">/</span>
    </li>
    <li>
      <a href="<?php echo URL::base(true) . 'manager/users' ?>">Usuários</a>
    </li>
  </ul>
  <hr>
</div>

<?php echo View::factory('manager/templates/notices')->set('messages', Notices::get()) ?>

<div class="row-fluid">    
  <div class="box span12">
    <div class="box-header" data-original-title>
      <h2><i class="icon-user"></i><span class="break"></span>Visualização</h2>
    </div>
    <div class="box-content">
      <dl>
        <dt>Nome</dt>
        <dd><?php echo $user->name; ?></dd>
      </dl>            
    </div>         
  </div><!--/span-->

</div><!--/row-->
