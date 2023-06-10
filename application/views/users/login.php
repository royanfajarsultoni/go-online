<?php echo validation_errors(); ?>
<div class="row">
  <div class="col-md-4 col-md-offset-4">
    <div id="loginModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content black-form animated bounceInDown">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Login</h4>
          </div>
          <div class="modal-body">
            <?php echo form_open(base_url('users/login'), ['id' => 'loginForm']); ?>
              <div class="form-group">
                <input type="text" name="username" id="username" class="form-control" placeholder="Username" required autofocus>
              </div>
              <div class="form-group">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <input type="password" class="form-control" name="confirm_password" id="confpassword" placeholder="Confirm Password" required>
                  <span class="input-group-addon toggle-password"><i class="fa fa-eye-slash"></i></span>
                </div>
              </div>
              <div class="form-group">
                <label for="remember">
                  <input type="checkbox" name="remember" id="remember"> Remember me
                </label>
              </div>
            <?php echo form_close(); ?>
          </div>
          <p class="text-center"><a href="#" id="loginLink">Login</a></p>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" id="loginButton">Login</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <hr>
  </div>
</div>
