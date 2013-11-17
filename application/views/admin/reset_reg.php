				<?php echo validation_errors('<div class="alert alert-error" style="text-align:center"><a class="close" onclick="$(\'.alert-error\').hide(\'fast\');">×</a>', '</div>'); ?>
				<?php
					if(isset($alert_success))
					{
						echo '<div class="alert alert-success" style="text-align:center"><a class="close" onclick="$(\'.alert-success\').hide(\'fast\');">×</a>'.$alert_success.'</div>';
					}
				?>
				<h3 id="list"><a href="/admincp">Reset Registration number</a></h3>
				<form class="form-horizontal well" method="post" action="/admincp/reset_reg">
					<fieldset>
						<div class="control-group">
							<label class="control-label" for="input01">Registration number</label>
							<div class="controls">
								<input type="text" class="input-xlarge span1" id="input01" name="regnum" value="<?php echo set_value('regnum',$current)?>">
								<p class="help-block">Default value is current number of approval</p>
							</div>
						</div>
						<div class="form-actions">
								<button type="submit" class="btn btn-primary">Submit</button>
								<button type="reset" class="btn">Reset</button>
						</div>
					</fieldset>
				</form>
			