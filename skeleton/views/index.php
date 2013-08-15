<div>
  <hr>
  <ul class="breadcrumb">
    <li>
      <a href="<?php echo URL::base(true) . 'manager'; ?>">Home</a> <span class="divider">/</span>
    </li>
    <li>
      <a href="<?php echo URL::base(true) . 'manager/{model_plural}'; ?>">{plural}</a>
    </li>
  </ul>
  <hr>
</div>

<?php echo View::factory('manager/templates/notices')->set('messages', Notices::get()) ?>

<a href="<?php echo URL::base(true) . 'manager/{model_plural}/new' ?>" class="btn btn-info">Adicionar</a>

<div class="row-fluid">    
  <div class="box span12">
    <div class="box-header" data-original-title>
      <h2><i class="icon-list"></i><span class="break"></span>Listagem</h2>
    </div>
    <div class="box-content">
      <table class="table table-striped table-bordered bootstrap-datatable datatable">
        <thead>
          <tr>
            <th>ID</th>            
            <th class="actions">Ações</th>
          </tr>
        </thead>   
        <tbody>
        <?php foreach($collection as $obj): ?>
          <tr>
            <td><?php echo $obj->id; ?></td>
            <td class="actions">
              <a class="btn" href="<?php echo URL::base(true) . 'manager/{model_plural}/edit/' . $obj->id; ?>">
                <i class="icon-edit icon-black"></i>  
              </a>
              <a class="btn btn-danger delete" href="<?php echo URL::base(true) . 'manager/{model_plural}/delete/' . $obj->id; ?>">
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
