<div class="login-box">
  <?php echo Form::open('manager/login', array('class' => 'form-horizontal')) ?>
    <fieldset>
      
      <?php echo View::factory('manager/templates/notices')->set('messages', Notices::get()) ?>    

      <div class="input-prepend" title="Username">
        <span class="add-on"><i class="icon-user"></i></span>
        <?php echo Form::input('username', null, array('id' => 'user_username', 'class' => 'input-large span10', 'placeholder' => 'E-mail ou Usuário')) ?>
      </div>
      <div class="clearfix"></div>

      <div class="input-prepend" title="Password">
        <span class="add-on"><i class="icon-lock"></i></span>        
        <?php echo Form::password('password', null, array('id' => 'user_password', 'class' => 'input-large span10', 'placeholder' => 'Senha')) ?>
      </div>
      <div class="clearfix"></div>
      
      <!-- <label class="remember" for="remember"><input type="checkbox" id="remember" />Remember me</label> -->

      <div class="button-login">  
        <button type="submit" class="btn btn-primary"><i class="icon-off icon-white"></i> Login</button>
      </div>
      <div class="clearfix"></div>
  <?php echo Form::close() ?>
</div><!--/span-->