<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<?php echo validation_errors(); ?>
		<?php echo form_open_multipart('users/edit_profile'); ?>
		<h3 class="text-center"><?= $title ?></h3>
		<div class="form-group">
			<label for="name">Name</label>
			<input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?= $name ?>">
		</div>
		<div class="form-group">
			<label for="username">Username</label>
			<input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?= $username ?>">
		</div>
		<div class="form-group">
			<label for="email">Email</label>
			<input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?= $email ?>">
		</div>
		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" class="form-control" id="password" name="password" placeholder="Password">
		</div>
		<div class="form-group">
			<label for="password2">Confirm Password</label>
			<input type="password" class="form-control" id="password2" name="password2" placeholder="Confirm Password">
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
		<?php echo form_close() ?>
	</div>
</div>
