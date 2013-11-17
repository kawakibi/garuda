<div class="container">
	<section id="forms">
	<div class="row" style="margin-top:10px;">
		<div class="span10 offset1">
			<div class="alert alert-success" style="text-align:center">
				<a class="close" onclick="$('.alert-success').hide('fast');">×</a>
				<h4 class="alert-heading">Success</h4>
				<p>You successfully submit the document.</p>
			</div>
			<form class="form-horizontal well">
				<fieldset>
				<legend>Generate Number</legend>
				<div class="control-group">
					<label class="control-label" for="select01">Sign Code</label>
					<div class="controls">
					<?php echo form_dropdown('signcode', $option,$this->input->post('signcode'),"disabled='disabled'");?>
					</div>
				</div>
		<?php
			if($typeform == "APPROVAL"):
			?>
				<div class="control-group">
					<label class="control-label" for="textarea">Type</label>
					<div class="controls">
						<?php echo form_dropdown('type', $tipe,$this->input->post('type'),"disabled='disabled'");?>
					</div>
				</div>
		<?php endif;?>
				<div class="control-group">
					<label class="control-label" for="textarea">Remarks</label>
					<div class="controls">
					<textarea class="input-xlarge span5" id="textarea" rows="7" name="remarks" disabled="disabled"><?php echo $remarks;?></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="textarea" ><span class="label label-success">Document Number</span></label>
					<div class="controls">
						<label class="checkbox help-inline"><strong><?php echo (isset($approval_docnum))?$approval_docnum:$telex_docnum?></strong></label>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="textarea" ><span class="label label-success">Approval Reference</span></label>
					<div class="controls">
						<label class="checkbox help-inline"><strong><?php echo REF_WORD.((isset($approval_docnum))?$approval_docnum:$telex_docnum).'/'.strtoupper(date('M')).'/'.date('y');?></strong></label>
					</div>
				</div>
				</fieldset>
			</form>
		</div>
