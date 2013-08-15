<fieldset>

  {fields}

  <div class="form-actions">
    <?php echo Form::button('save', 'Salvar', array('type' => 'submit', 'class' => 'btn btn-info')) ?>
    ou <?php echo Html::anchor('manager/{model_plural}', 'cancelar') ?> 
  </div>
</fieldset>
