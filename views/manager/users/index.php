<div>
  <hr>
  <ul class="breadcrumb">
    <li>
      <a href="<?php echo URL::base(true) . 'manager'; ?>">Home</a> <span class="divider">/</span>
    </li>
    <li>
      <a href="<?php echo URL::base(true) . 'manager/users'; ?>">Usuários</a>
    </li>
  </ul>
  <hr>
</div>

<?php echo View::factory('manager/templates/notices')->set('messages', Notices::get()) ?>

<a href="<?php echo URL::base(true) . 'manager/users/new' ?>" class="btn btn-info">Adicionar</a>

<div class="row-fluid">    
  <div class="box span12">
    <div class="box-header" data-original-title>
      <h2><i class="icon-list"></i><span class="break"></span>Listagem</h2>
      <!-- <div class="box-icon">
        <a href="#" class="btn-setting"><i class="icon-wrench"></i></a>
        <a href="#" class="btn-minimize"><i class="icon-chevron-up"></i></a>
        <a href="#" class="btn-close"><i class="icon-remove"></i></a>
      </div> -->
    </div>
    <div class="box-content">
      <table class="table table-striped table-bordered bootstrap-datatable datatable">
        <thead>
          <tr>
            <th>Nome</th>
            <th>Usuário</th>
            <th>Tipo</th>
            <th>Status</th>
            <th class="actions">Ações</th>
          </tr>
        </thead>   
        <tbody>
        <?php foreach($users as $user): ?>
          <tr>
            <td><?php echo $user->name; ?></td>
            <td><?php echo $user->username; ?></td>
            <td>
              <?php 
                $roles = $user->roles->find_all();
                echo $roles[1]->description;
              ?>
            </td>
            <td class="center">
              <span class="label label-success">Ativo</span>
            </td>
            <td class="actions">
              <!-- <a class="btn btn-success" href="#">
                <i class="icon-zoom-in icon-white"></i>  
              </a> -->
              <a class="btn" href="<?php echo URL::base(true) . 'manager/users/edit/' . $user->id; ?>">
                <i class="icon-edit icon-black"></i>  
              </a>
              <a class="btn btn-danger delete" href="<?php echo URL::base(true) . 'manager/users/delete/' . $user->id; ?>">
                <i class="icon-trash icon-white"></i> 
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>            
    </div>

  </div><!--/span-->

</div><!--/row-->
