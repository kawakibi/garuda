<div class="container">
	<section id="forms">
	<div class="row" style="margin-top:10px;">
		<div class="span10 offset1">
			<?php echo validation_errors('<div class="alert alert-error" style="text-align:center"><a class="close" onclick="$(\'.alert-success\').hide(\'fast\');">×</a>', '</div>'); ?>
			<?php echo ($error == "")?"":'<div class="alert alert-error" style="text-align:center"><a class="close" onclick="$(\'.alert-success\').hide(\'fast\');">×</a>'.$error.'</div>'?>
		<form class="form-horizontal well" method="post" action="/admincp/login" style="text-align:center">
			<fieldset>
				<legend>Admin Login</legend>
				<input type="text" class="input-small" placeholder="Username" name="username">
				<input type="password" class="input-small" placeholder="Password" name="password">
				<button type="submit" class="btn">Login</button>
			</fieldset>
		</form>
		</div>
