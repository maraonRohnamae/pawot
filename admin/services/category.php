<br>
<h5 class="">Service Type List</h5>
<hr>
<div class="row">
	<div class="container-fluid">
		<div class="card card-outline card-primary">
			<div class="card-header">
				<h5 class="card-title">List of Service Types</h5>
				<div class="card-tools">
					<button class="btn btn-flat btn-primary btn-sm" type="button" id="new_data">
						<span class="fa fa-plus"></span> New Type
					</button>
				</div>
			</div>
			<div class="card-body">
				<div class="container-fluid">
					<table id="type_list_table" class="table table-striped table-bordered">
						<colgroup>
							<col width="5%">
							<col width="30%">
							<col width="45%">
							<col width="20%">
						</colgroup>
						<thead>
							<tr>
								<th>#</th>
								<th>Type Name</th>
								<th>Description</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	function load_data() {
		console.log("load_data function is called");	
		start_loader();
		// Clear and destroy existing DataTable instance if initialized
		if ($.fn.DataTable.isDataTable('#type_list_table')) {
			$('#type_list_table').DataTable().destroy();
			$('#type_list_table tbody').html('');
		}
		$.ajax({
			url: _base_url_ + "classes/Master.php?f=load_type_list",
			dataType: "json",
			error: (err) => {
				console.log(err);
				alert_toast("An error occurred while loading data.", "error");
				end_loader();
			},
			success: function (resp) {
				if (resp && resp.status) {
					if (resp.data.length > 0) {
						let data = resp.data;
						var i = 1;
						data.forEach((row) => {
							let tr = $("<tr></tr>");
							tr.append('<td class="text-center">' + i++ + '</td>');
							tr.append('<td><b>' + row.type_name + '</b></td>');
							tr.append('<td><span class="truncate">' + row.description + '</span></td>');
							tr.append(
								'<td class="text-center">' +
									'<div class="btn-group">' +
										'<button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">' +
											'Action <span class="sr-only">Toggle Dropdown</span>' +
										'</button>' +
										'<div class="dropdown-menu" role="menu">' +
											'<a class="dropdown-item text-primary edit_data" data-id="' + row.id + '" href="javascript:void(0)">' +
												'<span class="fa fa-edit"></span> Edit' +
											'</a>' +
											'<div class="dropdown-divider"></div>' +
											'<a class="dropdown-item text-danger delete_data" data-id="' + row.id + '" href="javascript:void(0)">' +
												'<span class="fa fa-trash text-danger"></span> Delete' +
											'</a>' +
										'</div>' +
									'</div>' +
								'</td>'
							);
							$('#type_list_table tbody').append(tr);
						});
					} else {
						$('#type_list_table tbody').html('<tr><td colspan="4" class="text-center">No data available</td></tr>');
					}
					end_loader();
				} else {
					alert_toast("An error occurred while processing data.", "error");
					end_loader();
				}
			},
			complete: function () {
				// Initialize DataTable
				$('#type_list_table').dataTable();
				// Add functionality to buttons after data load
				data_func();
			},
		});
	}

	function data_func() {
		// Edit button functionality
		$('.edit_data').click(function () {
			let id = $(this).attr('data-id');
			uni_modal('<span class="fa fa-edit text-primary"></span> Edit Service Type', _base_url_ + 'admin/services/manage_type.php?id=' + id);
		});
		// Delete button functionality
		$('.delete_data').click(function () {
			let id = $(this).attr('data-id');
			_conf('Are you sure you want to delete this type?', 'delete_data', [id]);
		});
	}

	function delete_data(id) {
		start_loader();
		$.ajax({
			url: _base_url_ + "classes/Master.php?f=delete_type",
			method: 'POST',
			data: { id: id },
			dataType: 'json',
			error: (err) => {
				console.log(err);
				alert_toast("An error occurred while deleting data.", "error");
				end_loader();
			},
			success: function (resp) {
				if (resp && resp.status === 'success') {
					alert_toast("Service type successfully deleted.", "success");
					load_data(); // Reload data after deletion
				}
			},
		});
	}

	$(document).ready(function () {
		load_data(); // Initialize table data on document ready
		$('#new_data').click(function () {
			uni_modal('<span class="fa fa-plus"></span> Create New Service Type', _base_url_ + 'admin/services/manage_type.php');
		});
	});
</script>
