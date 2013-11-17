				<?php echo validation_errors('<div class="alert alert-error" style="text-align:center"><a class="close" onclick="$(\'.alert-error\').hide(\'fast\');">×</a>', '</div>'); ?>
				<?php
					if(isset($alert_success))
					{
						echo '<div class="alert alert-success" style="text-align:center"><a class="close" onclick="$(\'.alert-success\').hide(\'fast\');">×</a>'.$alert_success.'</div>';
					}
				?>
				<h3 id="list"><a href="/admincp">Reset Approval number</a></h3>
				<form class="form-horizontal well" method="post" action="/admincp/reset_approval">
					<fieldset>
						<div class="control-group">
							<label class="control-label" for="input01">Approval number</label>
							<div class="controls">
								<input type="text" class="input-xlarge span1" id="input01" name="approvalnum" value="<?php echo set_value('approvalnum',$current)?>">
								<p class="help-block">Default value is current number of approval</p>
							</div>
						</div>
						<div class="form-actions">
								<button type="submit" class="btn btn-primary">Submit</button>
								<button type="reset" class="btn">Reset</button>
						</div>
					</fieldset>
				</form>
			