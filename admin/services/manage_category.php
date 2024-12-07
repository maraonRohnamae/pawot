<?php 
include '../../config.php';
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM `type_list` WHERE id = '{$_GET['id']}'");
	foreach ($qry->fetch_array() as $key => $value) {
		if(!is_numeric($key))
			$$key = $value;
	}
}
?>
<div class="container-fluid">
	<form action="" id="manage-type">
		<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] :'' ?>">
		<div class="form-group">
			<label for="type_name" class="control-label">Type Name</label>
			<input type="text" class="form-control form-control-sm" name="type_name" id="type_name" value="<?php echo isset($type_name) ? $type_name : "" ?>" required>
		</div>
		<div class="form-group">
			<label for="description" class="control-label">Description</label>
			<textarea type="text" style="resize: none" class="form-control" rows="3" name="description" id="description" required><?php echo isset($description) ? $description : "" ?></textarea>
		</div>
	</form>
</div>
<script>
	$(document).ready(function(){
		$('#type_name').keypress(function(){
			$(this).removeClass('border-danger');
		})
		$('#manage-type').submit(function(e){
			e.preventDefault();
			if($('.err_msg').length > 0){
				$('.err_msg').remove()
			}
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_type",  // Ensure the backend function matches this
				method:"POST",
				data:$(this).serialize(),
				dataType:'json',
				error:err=>{
					console.log(err);
					alert_toast("An error occurred","error");
					end_loader();
				},
				success:function(resp){
					if(!!resp.status && resp.status =='success'){
						alert_toast("Data successfully saved.","success");
						$('.modal').modal('hide');
						end_loader()
						load_data();
					}else if(!!resp.status && resp.status =='duplicate'){
						$('#manage-type').prepend('<div class="form-group err_msg"><div class="callout callout-danger"><span class="fa fa-exclamation-triangle"><b>Type Name already exists.</b></div></div>');
						$('#type_name').addClass('border-danger');
						$('#type_name').focus();
						end_loader();
					}else{
						alert_toast("An error occurred","error");
						end_loader();
					}
				}
			})
		})
	})
</script>
