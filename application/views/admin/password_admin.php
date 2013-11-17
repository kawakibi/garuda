				<?php echo validation_errors('<div class="alert alert-error" style="text-align:center"><a class="close" onclick="$(\'.alert-error\').hide(\'fast\');">×</a>', '</div>'); ?>
				<?php
					if(isset($error_pu))
					{
						echo '<div class="alert alert-error" style="text-align:center"><a class="close" onclick="$(\'.alert-error\').hide(\'fast\');">×</a>'.$error_pu.'</div>';
					}
					if(isset($alert_success))
					{
						echo '<div class="alert alert-success" style="text-align:center"><a class="close" onclick="$(\'.alert-success\').hide(\'fast\');">×</a>'.$alert_success.'</div>';
					}
				?>
				<h3 id="list"><a href="/admincp">Reset Password Admin</a></h3>
				<form class="form-horizontal well" method="post" action="/admincp/padmin">
					<fieldset>
						<div class="control-group">
							<label class="control-label" for="input01">Current Password</label>
							<div class="controls">
								<input type="password" class="input-xlarge span2" id="input01" name="currentpassword" value="<?php echo set_value('currentpassword')?>">
								<p class="help-block">Enter Current password for Admin Panel</p>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="input01">New Password</label>
							<div class="controls">
								<input type="password" class="input-xlarge span2" id="input01" name="newpassword" value="<?php echo set_value('newpassword')?>">
								<p class="help-block">New Password for Admin Accessing Panel</p>
							</div>
						</div>
						<div class="form-actions">
								<button type="submit" class="btn btn-primary">Submit</button>
								<button type="reset" class="btn">Reset</button>
						</div>
					</fieldset>
				</form>
			