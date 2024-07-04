	<div class="row">
		<div class="col-sm-12">
			<div class="box box-solid">
				<!-- <div class="box-header with-border">
					<button class="btn btn-success" data-toggle="modal" data-target="#tambah"><i class="fa fa-user-plus"></i> Add Voter</button>
				</div> -->
				<div class="box-body">
					<table class="table dt table-bordered table-hover table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th>Voter's Name</th>
								<th>Username</th>
								<th>Password</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody id="showData">
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-sm-12">
			<div class="box box-success box-solid">
				<div class="box-header">
					<h4 class="box-title">Add Voter</h4>
				</div>
				<div class="box-body">
					<form id="formtambah">
						<div class="form-group">
							<label for="nama">Name :</label>
							<input type="text" name="nama" class="form-control" placeholder="Enter Name">
						</div>
						<div class="form-group">
							<label for="username">Username :</label>
							<input type="text" name="username" class="form-control" placeholder="Enter Username">
						</div>

						<div class="form-group">
							<small style="color:#a50909; text-decoration:underline;">Note: Username and Password will be the same by Default!</small>
						</div>
						<button class="btn btn-flat btn-success">Submit Details</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal Edit -->
	<div class="modal fade" id="editModal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"><i class="fa fa-user"></i> Edit Voter</h4>
				</div>
				<div class="modal-body">
					<form id="editForm">
						<input type="hidden" name="id_pemilih">
						<div class="form-group">
							<label for="Nama">Nama :</label>
							<input type="text" name="nama" class="form-control" placeholder="Enter Name">
						</div>
						<div class="form-group">
							<label for="Username">Username :</label>
							<input type="text" name="username" class="form-control" placeholder="Enter Username">
						</div>
						<button class="btn btn-success btn-ubah btn-flat">Save</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<script>
		$(document).ajaxStart(function(){
			Pace.restart()
		})
		function dataPemilih(){
			$.ajax({
				type: 'ajax',
				url: '<?=base_url("admin/data_pemilih");?>',
				async: false,
				dataType: 'json',
				success: function(data){
					var html = '';
					var i;
					for(i=0; i<data.length; i++){
						html += '<tr>'+
								'<td>'+(i+1)+'.</td>'+
								'<td>'+data[i].nama+'</td>'+
								'<td>'+data[i].username+'</td>'+
								'<td><button class="btn reset-pass btn-xs btn-flat btn-warning" data="'+data[i].id_pemilih+'"><i class="fa fa-refresh"></i> Reset Password</button></td>'+
								'<td><button class="btn btn-xs btn-flat btn-success edit" data="'+data[i].id_pemilih+'"><i class="fa fa-edit"></i> Edit</button>&nbsp;&nbsp;<button class="btn btn-xs btn-flat btn-danger hapus" data="'+data[i].id_pemilih+'"><i class="fa fa-trash"></i> Delete</button></td>'+
								'</tr>';
					}
					$('#showData').html(html);
				}
			})
		}
		dataPemilih();
		$('#formtambah').on('submit', function(e){
			e.preventDefault();
			var form = $(this);
			var nama = $('[name="nama"]').val(), username = $('[name="nama"]').val();

			if (nama == '' || username == ''){
				return false;
			}
			else{
				$.ajax({
					type: 'POST',
					url: '<?=base_url("admin/tambah_pemilih");?>',
					data: form.serialize(),
					success: function(data){
						form.trigger('reset');
						Pace.restart();
						dataPemilih();
					}
				})
				return false;
			}
		})
		//Reset Password
		$('#showData').on('click', '.reset-pass', function(e){
			e.preventDefault();
			var id = $(this).attr('data');
			var k = confirm('Password will be reset ?');
			if (k) {
				$.ajax({
					url: '<?=base_url("admin/reset_pass_pemilih/");?>'+id,
					success: function(data){
						Swal.fire('Success', 'Password successfully reset', 'success');
					}
				})
				return false;
			}
		})
		//Edit Pemilih
		$('#showData').on('click', '.edit', function(){
			var id = $(this).attr('data');
			$.ajax({
				type: 'GET',
				url: '<?=base_url("admin/get_pemilih/");?>'+id,
				dataType: 'json',
				success: function(data){
					$('#editModal').modal('show');
					$('[name="id_pemilih"]').val(data.id_pemilih);
					$('[name="nama"]').val(data.nama);
					$('[name="username"]').val(data.username);
				}
			})
			return false;
		})
		//aksi edit
		$('#editForm').on('submit', function(){
			var id = $('[name="id_pemilih"]').val();
			$.ajax({
				type: 'POST',
				url: '<?=base_url("admin/edit_pemilih/");?>'+id,
				data: $('#editForm').serialize(),
				success: function(data){
					$('#editForm').trigger('reset');
					$('#editModal').modal('hide');
					dataPemilih();
				}
			})
			return false;
		})
		//Hapus Pemilih
		$('#showData').on('click', '.hapus', function(){
			var id = $(this).attr('data');
			var k = confirm('Are you sure you want to delete it ?');
			if (k) {
				$.ajax({
					url: '<?=base_url("admin/hapus_pemilih/");?>'+id,
					success: function(){
						Swal.fire('Success', 'Voters successfully removed', 'success');
						dataPemilih();
					}
				})
				return false;
			}
		})
	</script>