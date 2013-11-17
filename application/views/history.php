<script>
function showtype(obj)
{
	if(obj.value == "approval")
	{
		$("#type").show();
		return;
	}
	$("#type").hide();
	return;
}
</script>
<div class="container">
	<section id="forms">
	<div class="row" style="margin-top:10px;">
		<div class="span10 offset1">
		<form class="form-horizontal well" method="post" action="/history">
			<fieldset>
			<legend>View History</legend>

				<div class="control-group">
					<label class="control-label" for="select01">Approval type</label>
						<div class="controls">
							<?php echo form_dropdown('approvaltype', $atype,$type_choosen,'id="approvaltype" onchange="showtype(this)"');?>
					</div>
				</div>

				<?php
				if($type_choosen == "approval" || !isset($type_choosen)):
				?>
					<div class="control-group" id="type">
						<label class="control-label" for="textarea">Type</label>
						<div class="controls">
							<?php echo form_dropdown('type', $type);?>
						</div>
					</div>
				<?php endif;?>

				<div class="control-group">
					<label class="control-label" for="select01">Date</label>
					<div class="controls">
					<div class="input-append date" id="dp3" data-date="<?php echo set_value('tanggal')?>" data-date-format="dd-mm-yyyy">
  <input class="span2" size="16" type="text" value="<?php echo set_value('tanggal')?>" name="tanggal">
  <span class="add-on"><i class="icon-th"></i></span>
</div>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="select01">Sign Code</label>
						<div class="controls">
							<?php echo form_dropdown('signcode', $option);?>
					</div>
				</div>
				
			<div class="control-group">
				<label class="control-label" for="input01">Document number</label>
				<div class="controls">
					<input type="text" class="input-xlarge span1" id="input01" name="docnum" value="<?php echo set_value('docnum')?>">
				</div>
			</div>

			<div class="form-actions">
				<button type="submit" class="btn btn-primary">Submit</button>
				<button type="reset" class="btn">Reset</button>
			</div>
			<?php
			if(count($docs) > 0 )
			{
			?>
			<div class="control-group">
				<button onclick="window.print()" class="btn btn-primary">Print</button>
				<input type="submit" name="download" class="btn btn-primary" value="Download">
			</div>
			<div class="control-group-inline">
					<table class="table table-striped">
					<thead>
						<tr>
						<th>#</th>
						<th>Date</th>
						<th>Sign Code</th>
						<th>Document number</th>
						<th>Register number</th>
						<th>Remarks</th>
						<?php
						if( $type_choosen == "approval" )
						{
						?>
							<th>Type</th>
						<?php
						}
						?>
						</tr>
					</thead>
					<tbody>
			<?php
				$c = 1;
				foreach ($docs as $key => $value) {
				
			?>
				
					
						<tr>
							<td><?php echo $c;?></td>
							<td><?php echo date('d-m-Y',$value['tanggal'])?></td>
							<td><?php echo $value['signcode']?></td>
							<td><?php echo $value[$this->input->post('approvaltype').'_docnum']?></td>
							<td><?php echo $value['register_num']?></td>
							<td><?php echo $value['remarks']?></td>
						<?php
						if( $type_choosen == "approval" )
						{
						?>
							<td><?php echo $value['type']?></td>
						<?php
						}
						?>
						</tr>
			<?php
				$c++;
				}
			?>

					</tbody>
					</table>
				</div>
			<?php
			}
			?>
			</fieldset>
		</form>
		</div>
