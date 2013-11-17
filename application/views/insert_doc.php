<div class="container">
	<section id="forms">
	<div class="row" style="margin-top:10px;">
		<div class="span10 offset1">
			<?php echo validation_errors('<div class="alert alert-error" style="text-align:center"><a class="close" onclick="$(\'.alert-error\').hide(\'fast\');">×</a>', '</div>'); ?>
			<?php echo ($error_pass == "")?"":'<div class="alert alert-error" style="text-align:center"><a class="close" onclick="$(\'.alert-error\').hide(\'fast\');">×</a>'.$error_pass.'</div>'?>
		<form class="form-horizontal well" method="post" action="/<?php echo strtolower($typeform);?>">
			<h4><?php echo $typeform;?> Document</h4>
			<fieldset>
			<div class="control-group">
				<label class="control-label" for="select01">Sign Code</label>
				<div class="controls">
				<?php echo form_dropdown('signcode', $option);?>
				</div>
			</div>
		
		<?php
		if($typeform == "APPROVAL"):
		?>
			<div class="control-group">
				<label class="control-label" for="textarea">Type</label>
				<div class="controls">
					<?php echo form_dropdown('type', $tipe);?>
				</div>
			</div>
		<?php endif;?>

			<div class="control-group">
				<label class="control-label" for="textarea">Remarks</label>
				<div class="controls">
				<textarea class="input-xlarge span5" id="textarea" rows="7" name="remarks"><?php echo set_value('remarks',$remarks)?></textarea>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="input01">Password</label>
				<div class="controls">
					<input type="password" class="input-xlarge" id="input01" name="password">
					<!--p class="help-block">In addition to freeform text, any HTML5 text-based input appears like so.</p-->
				</div>
			</div>
			<div class="form-actions">
				<button type="submit" class="btn btn-primary">Submit</button>
				<button type="reset" class="btn">Reset</button>
			</div>
			</fieldset>
		</form>
		</div>
