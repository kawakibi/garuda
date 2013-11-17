				<?php echo validation_errors('<div class="alert alert-error" style="text-align:center"><a class="close" onclick="$(\'.alert-error\').hide(\'fast\');">×</a>', '</div>'); ?>
				<?php
					if(isset($alert_success))
					{
						echo '<div class="alert alert-success" style="text-align:center"><a class="close" onclick="$(\'.alert-success\').hide(\'fast\');">×</a>'.$alert_success.'</div>';
					}
				?>
				<h3 id="list"><a href="/admincp">Set Sign Code</a></h3>
				<form class="form-horizontal well" method="post" action="/admincp/set_signcode">
					<fieldset>
						<table class="table table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>Name</th>
									<th>Sign Code</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php 
							$c =1;
							foreach ($current as $key => $value) {
								echo "<tr>".
										"<td>".$c."</td>".
										"<td>".$value['name']."</td>".
										"<td>".$value['code']."</td>".
										"<td>".'<a class="btn btn-primary btn-small" href="/admincp/delete_signcode/'.$value['id'].'" onclick="return confirm(\'Are you sure want to delete this sign code? \nThis action cannot be undone\');">Delete</a>'."</td>".
										"</tr>";
								$c++;
							}
							?>
							</tbody>
						</table>
						<div class="control-group">
							<label class="control-label" for="input01">Set New Sign Code</label>
							<div class="controls">
								<input type="text" class="input-xlarge span2" id="input01" name="name" value="<?php echo set_value('name')?>" placeholder="Set Name here">
								<input type="text" class="input-xlarge span2" id="input01" name="code" value="<?php echo set_value('code')?>" placeholder="Set Code here">
							</div>
						</div>
						<div class="form-actions">
								<button type="submit" class="btn btn-primary">Submit</button>
								<button type="reset" class="btn">Reset</button>
						</div>

					</fieldset>
				</form>
			