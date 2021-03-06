<link
	href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css"></link>
<link
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"></link>

<div class="row">

	<p></p>
	<h1>Patient List</h1>
	<div class="col-md-10 col-md-offset-1">

		<div class="panel panel-default panel-table">
			<div class="panel-heading">
				<div class="row">
					<div class="col col-xs-6">
						<h3 class="panel-title">Patients</h3>
					</div>
					<div class="col col-xs-6 text-right">
						<button type="button" class="btn btn-sm btn-primary btn-create">Create
							New</button>
					</div>
				</div>
			</div>
			<div class="panel-body">

				<table id="example" class="table table-striped table-bordered"
					cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Id</th>
							<th>Name</th>
							<th>Email</th>
							<th>Mobile</th>
							<th>Created At</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>Id</th>
							<th>Name</th>
							<th>Email</th>
							<th>Mobile</th>
							<th>Created At</th>
						</tr>
					</tfoot>
					<tbody>
					<?php foreach($patients as $patient){?>
						<tr>
							<td class="hidden-xs"><?php echo formatPatientNumber($patient['id']) ?></td>
							<td><?php echo $patient['first_name'].' '.$patient['last_name'] ?></td>
							<td><?php echo $patient['email'] ?></td>
							<td><?php echo $patient['phone'] ?></td>
							<td><?php echo $patient['created_at'] ?></td>
						</tr>
					<?php }?>

					</tbody>
				</table>

				<script
					src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"
					type="text/javascript"></script>
				<script
					src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"
					type="text/javascript"></script>
				<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
    </script>


			</div>
		</div>
	</div>
</div>