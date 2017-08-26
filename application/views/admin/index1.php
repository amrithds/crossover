<link href="/assets/table.css" rel='stylesheet' type='text/css'>
<link
	href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css"
	rel='stylesheet' type='text/css'>

<table class="table table-striped table-bordered table-list">
					<thead>
						<tr>
							<th>Actions</th>
							<th class="hidden-xs">ID</th>
							<th>Name</th>
							<th>Email</th>
							<th>Phone</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach($patients as $patient){?>
						<tr>
							<td align="center"><a class="btn btn-default"><em
									class="fa fa-pencil"></em></a> <a class="btn btn-danger"><em
									class="fa fa-trash"></em></a></td>
							<td class="hidden-xs"><?php echo $patient['id'] ?></td>
							<td><?php echo $patient['first_name'].' '.$patient['last_name'] ?></td>
							<td><?php echo $patient['email'] ?></td>
							<td><?php echo $patient['phone'] ?></td>
						</tr>
					<?php }?>
						
					</tbody>
				</table>

			</div>
			<div class="panel-footer">
				<div class="row">
					<div class="col col-xs-4">Page 1 of 5</div>
					<div class="col col-xs-8">
						<ul class="pagination hidden-xs pull-right">
							<li><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li><a href="#">5</a></li>
						</ul>
						<ul class="pagination visible-xs pull-right">
							<li><a href="#">«</a></li>
							<li><a href="#">»</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>