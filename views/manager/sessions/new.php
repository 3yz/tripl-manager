<div class="login-box">
  <div class="icons">
    <br/>
  </div>
  <h2>Login</h2>
  <?php echo Form::open('manager/login', array('class' => 'form-horizontal')) ?>
    <fieldset>
      <div class="offset1 span10">
        <?php echo View::factory('manager/templates/notices')->set('messages', Notices::get()) ?>    
      </div>
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
  <hr>
  <!-- <h3>Forgot Password?</h3>
  <p>
    No problem, <a href="#">click here</a> to get a new password.
  </p>   -->
</div><!--/span-->