<?php echo validation_errors(); ?>
<?php echo form_open('users/login'); ?>
<div class="row">
  <div class="col-md-4 col-md-offset-4">
    <div id="loginModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Login</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
            </div>
            <div class="form-group">
              <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Login</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <hr>
    <p class="text-center">Don't have an account? <a href="#">Sign up</a></p>
  </div>
</div>
<?php echo form_close() ?>

<script>
var $j = jQuery.noConflict();

$j(document).ready(function() {
    $j('#loginModal').modal('show');
  });
</script>
