<div>
  <hr>
  <ul class="breadcrumb">
    <li>
      <a href="<?php echo URL::base(true) . 'manager/'; ?>">Home</a> <span class="divider">/</span>
    </li>
    <li>
      <a href="<?php echo URL::base(true) . 'manager/{model_plural}'; ?>">{plural}</a>
    </li>
  </ul>
  <hr>
</div> 
<?php echo View::factory('manager/templates/notices')->set('messages', Notices::get()) ?>
<div class="row-fluid">
  <div class="box span12">
    <div class="box-header" data-original-title>
      <h2><i class="icon-edit"></i><span class="break"></span>Alterar</h2>
    </div>
    <div class="box-content">
    <?php echo Form::open('manager/{model_plural}/update/'.$obj->id, array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data')) ?>
    <?php 
      echo View::factory('manager/{model_plural}/_form')
        ->set('obj', $obj) 
        ->set('errors', $errors) 
    ?>
    <?php echo Form::close() ?>

    </div>
  </div><!--/span-->

</div><!--/row-->
