	<div class="row">
		<div class="col-sm-12">
			<button class="btn btn-flat btn-success" data-toggle="modal" data-target="#tambahKandidat"><i class="fa fa-user-plus"></i> Add Candidate</button>
			<!-- Modal Add Candidate -->
			<div class="modal fade" id="tambahKandidat">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title"><i class="fa fa-user-plus"></i> Add Candidate</h4>
						</div>
						<div class="modal-body">
							<form method="POST" enctype="multipart/form-data" action="<?=base_url('admin/tambah_kandidat');?>">
								<div class="form-group">
									<label for="nama">Candidate Name :</label>
									<input type="text" name="nama" class="form-control" placeholder="Enter Candidate Name" required="required">
								</div>
								<div class="form-group">
									<label for="keterangan">Information :</label>
									<input type="text" name="ket" class="form-control" placeholder="(ex: Motto)" required="required">
								</div>
								<div class="form-group">
									<label for="foto">Candidate Photo :</label>
									<input type="file" name="foto" required="required">
								</div>
								<button class="btn btn-flat btn-success">Add</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-12">
			<div class="tengah">
				<div class="col-sm-12">
					<h3 class="text-center">Candidates List</h3>
				</div>
			<?php
			if (count($kandidat) > 0) {
				foreach($kandidat as $k):?>
				<div class="col-sm-4">
					<div class="box box-success">
						<div class="box-header">
							<?php if ($k->id_ikut_kandidat): ?>
							<a class="pull-right"><span class="label label-success"><i class="fa fa-check"></i></span></a>
							<?php else: ?>
							<button class="close hapus" data="<?=$k->id;?>"><i class="fa fa-trash"></i></button>
							<?php endif;?>
						</div>
						<div class="box-body box-profile">
							<img src="<?=base_url('./../assets/img/kandidat/'.$k->foto);?>" alt="" class="profile-user-img img-responsive img-kandidat img-circle">
							<h3 class="profile-username text-center"><?=$k->nama_kandidat;?></h3>
							<p class="text-muted text-center"><?=$k->keterangan;?></p>
							<button class="btn btn-flat btn-block btn-danger edit" data="<?=$k->id;?>">Edit</button>
						</div>
					</div>
				</div>
				<?php endforeach;
			}
			else{?>
				<div class="col-sm-12">
					<div class="box box-solid">
						<div class="box-body">
							<h2 class="text-center"><i class="fa fa-warning"></i></h2>
							<h3 class="text-center" style="color:red;">No Candidates Found!</h3>
						</div>
					</div>
				</div>
			<?php } ?>
			</div>
		</div>
	</div>

	<!-- Modal Edit -->
	<div class="modal fade" id="edit">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"><i class="fa fa-user"></i> Edit Candidate</h4>
				</div>
				<div class="modal-body">
					<form action="<?=base_url('admin/edit_kandidat')?>" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="id_kandidat">
						<div class="tengah" id="img-kandidat"></div>
						<div class="form-group">
							<label for="NamaKandidat">Candidate Name :</label>
							<input type="text" name="nama" class="form-control" placeholder="Enter Candidate Name">
						</div>
						<div class="form-group">
							<label for="Keterangan">Information :</label>
							<input type="text" name="ket" class="form-control" placeholder="(ex: Motto)">
						</div>
						<div class="form-group">
							<label for="Foto">Photo :</label>
							<input type="file" name="foto" id="">
						</div>
						<button class="btn btn-success btn-flat"><i class="fa fa-check"></i> Save</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<script>
		$(document).ready(function(){
			$('.hapus').on('click', function(){
				var id = $(this).attr('data');
				var h = confirm('Are you sure you want to delete the candidate?');
				if (h) {
					window.location.assign('<?=base_url("admin/hapus_kandidat/");?>'+id);
				}
				return false;
			});
			$('.edit').on('click', function(){
				var id = $(this).attr('data');
				$.ajax({
					type: 'GET',
					url: '<?=base_url("admin/get_kandidat/");?>'+id,
					dataType: 'json',
					success: function(data){
						$('#edit').modal('show');
						$('[name="id_kandidat"]').val(data.id_kandidat);
						$('[name="nama"]').val(data.nama_kandidat);
						$('[name="ket"]').val(data.keterangan);
						var foto = '<img class="img-circle img-responsive img-kandidat" src="'+base_url+'./../assets/img/kandidat/'+data.foto+'">';
						$('#img-kandidat').html(foto);
					}
				})
				return false;
			})
		})
	</script>

	<?=($this->session->flashdata('tambah')) ? '<script>Swal.fire("Success", "Candidate added successfully", "success")</script>' : ''?>
	<?=($this->session->flashdata('hapus')) ? '<script>Swal.fire("Success", "Candidate has been successfully removed", "success")</script>' : ''?>
	<?php if ($this->session->flashdata('error')) { ?>
		<script>
			Swal.fire('Gagal', '<?=$this->session->flashdata("error");?>', 'error');
		</script>
	<?php }	?>