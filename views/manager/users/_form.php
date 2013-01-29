<fieldset>
  <div class="control-group <?php echo Arr::get($errors, 'name') ? 'error' : '' ?>">
    <label class="control-label" for="user_name">Nome</label>
    <div class="controls">
      <?php echo Form::input('name', $user->name, array('id' => 'user_name', 'class' => 'input-xxlarge')) ?>
      <small class="help-block">Campo obrigatório. Máximo 255 caracteres</small> 
    </div>
  </div>
  
  <div class="control-group <?php echo Arr::get($errors, 'email') ? 'error' : '' ?>">
    <label class="control-label" for="user_email">Email</label>
    <div class="controls">
      <?php echo Form::input('email', $user->email, array('id' => 'user_email', 'type' => 'email', 'class' => 'input-xlarge')) ?>
      <small class="help-block">Campo obrigatório. Máximo 255 caracteres</small> 
    </div>
  </div>

  <div class="control-group <?php echo Arr::get($errors, 'username')? 'error' : '' ?>">
    <label class="control-label" for="user_username">Usuário</label>
    <div class="controls">
      <?php echo Form::input('username', $user->username, array('id' => 'user_username', 'class' => 'input-xlarge')) ?>
      <small class="help-block">Campo obrigatório. Minimo 8 caracteres</small> 
    </div>
  </div>

  <div class="control-group <?php echo Arr::path($errors, '_external.password') ? 'error' : '' ?>">
    <label class="control-label" for="user_password">Senha</label>
    <div class="controls">
      <?php echo Form::password('password', null, array('id' => 'user_password', 'class' => 'input-medium')) ?>
      <small class="help-block">Campo obrigatório. Mínimo 8 caracteres</small>  
    </div>
  </div>

  <div class="control-group <?php echo Arr::path($errors, '_external.password_confirm') ? 'error' : '' ?>">
    <label class="control-label" for="user_password_confirm">Confirmação da senha</label>
    <div class="controls">
      <?php echo Form::password('password_confirm', null, array('id' => 'user_password_confirm', 'class' => 'input-medium')) ?>
      <small class="help-block">Campo obrigatório.</small>
    </div>
  </div>

  <?php 
    $role = null;
    if($user->loaded()){
      $_roles = $user->roles->find_all();
      $role = $_roles[1]->name;
    }
  ?>

  <?php if(Auth::instance()->logged_in('admin')) : ?>
  <div class="control-group">
    <label class="control-label" for="user_role">Permissão</label>
    <div class="controls">
      <?php         
        echo Form::select('role', $roles, $role, array('id' => 'user_role')) 
      ?>
      <small class="help-block">Campo obrigatório.</small>
    </div>
    
  </div>
  <?php else : ?>
    <?php echo Form::hidden('role', $role); ?>
  <?php endif; ?>

  <div class="form-actions">
    <?php echo Form::button('save', 'Salvar', array('type' => 'submit', 'class' => 'btn btn-info')) ?>
    ou <?php echo Html::anchor('manager/users', 'cancelar') ?> 
  </div>
</fieldset>
