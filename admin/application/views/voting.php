	<div class="row">
	<?php if ($cekvoting < 1): ?>
		<div class="col-sm-12">
			<div class="box box-solid">
				<div class="box-body">
					<h3 class="text-center"><i class="fa fa-warning" style="color:red;"></i> No Votes Found !</h3>
				</div>
			</div>
		</div>
		<div class="col-sm-12">
			<div class="box box-success box-solid">
				<div class="box-header with-border">
					<h3 class="box-title"><i class="fa fa-th"></i> Add New Voting</h3>
				</div>
				<form action="<?=base_url('admin/tambah_voting');?>" method="POST" class="form-horizontal">
					<div class="box-body">
						<div class="form-group">
							<label for="NamaVoting" class="col-sm-2 control-label">Name Voting :</label>
							<div class="col-sm-10">
								<input type="text" name="voting" class="form-control" placeholder="Enter Voting Name" required="required">
							</div>
						</div>
						<div class="form-group">
							<label for="Kandidat" class="col-sm-2 control-label">Candidate :</label>
							<div class="col-sm-10">
								<select name="kandidat[]" class="form-control select2" data-placeholder="Select Candidates (Multiple)" multiple="multiple" style="width: 100%;" required="required">
									<?php foreach ($listkandidat as $lk): ?>
									<option value="<?=$lk->id_kandidat;?>"><?=$lk->nama_kandidat;?></option>
									<?php endforeach;?>
								</select>
								<?=(count($listkandidat) < 2) ? '<h5 class="text-red">There must be more than one candidate!</5>' : ''?>
							</div>
						</div>
					</div>
					<div class="box-footer">
						<button type="reset" class="btn btn-flat btn-danger"><i class="fa fa-refresh"></i> Reset</button>
						<button class="btn btn-flat btn-success" <?=(count($listkandidat) < 2) ? 'disabled' : ''?>><i class="fa fa-check"></i> Add Voting</button>
					</div>
				</form>
			</div>
		</div>
	<?php else: ?>
		<div class="col-sm-12">
			<div class="box box-success">
				<div class="box-body">
					<h2 class="text-center"><?=$voting->nama_voting;?></h2>
					<hr>
					<h3 class="text-center">Candidates</h3>
					<div class="tengah">
						<?php foreach ($kandidat as $k):?>
						<div class="col-sm-4">
							<div class="box box-success">
								<div class="box-body box-profile">
									<img src="<?=base_url('./../assets/img/kandidat/'.$k->foto);?>" alt="" class="profile-user-img img-kandidat img-responsive img-circle">
									<h3 class="profile-username text-center"><?=$k->nama_kandidat;?></h3>
									<p class="text-muted text-center"><?=$k->keterangan;?></p>
									<h3 class="text-center"><span class="label label-danger">Points : <?=$k->poin?></span></h3>
								</div>
							</div>
						</div>
					<?php endforeach;?>
					</div>
					<hr>
					<h3 class="text-center">Number of Voters <span class="label label-success"><?=$jmlpemilih;?></span></h3>
					<hr>
					<div class="col-sm-7">
						<div class="box box-primary box-solid">
							<div class="box-header">
								<h4 class="box-title">Voted</h4>
							</div>
							<div class="box-body">
								<table class="table table-pemilih table-hover table-bordered table-striped">
									<thead>
										<tr>
											<th>#</th>
											<th>Name</th>
											<th>Time</th>
										</tr>
									</thead>
									<tbody>
										<?php $no = 1; foreach ($sudah_memilih as $sm): ?>
										<tr>
											<td><?=$no++?>.</td>
											<td><?=$sm->nama?></td>
											<td><?=$sm->waktu?></td>
										</tr>
										<?php endforeach ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="col-sm-5">
						<div class="box box-primary box-solid">
							<div class="box-header">
								<h4 class="box-title">Not Voted</h4>
							</div>
							<div class="box-body">
								<table class="table table-pemilih table-hover table-bordered table-striped">
									<thead>
										<tr>
											<th>#</th>
											<th>Name</th>
										</tr>
									</thead>
									<tbody>
										<?php $no = 1; foreach ($belum_memilih as $bm): ?>
										<tr>
											<td><?=$no++?>.</td>
											<td><?=$bm->nama?></td>
										</tr>
										<?php endforeach ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="box-footer">
					<button class="btn btn-warning btn-edit btn-flat" data-toggle="modal" data-target="#editVoting<?=$voting->id_voting;?>"><i class="fa fa-edit"></i> Edit</button>
					<button class="btn btn-danger btn-edit btn-flat pull-right hapus-voting" data='<?=$voting->id_voting?>'><i class="fa fa-trash"></i> Delete Votings</button>
				</div>
			</div>
		</div>
		<!-- Modal edit voting -->
		<div class="modal fade" id="editVoting<?=$voting->id_voting;?>">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title"><i class="fa fa-th"></i> Edit Voting</h4>
					</div>
					<div class="modal-body">
						<form action="<?=base_url('admin/edit_voting/'.$voting->id_voting);?>" method="POST">
							<div class="form-group">
								<label for="NamaVoting">Name Voting :</label>
									<input type="text" name="voting" class="form-control" value="<?=$voting->nama_voting;?>" placeholder="Enter Voting Name" required="required">
							</div>
							<!-- <div class="form-group">
								<label for="Kandidat">Kandidat :</label>
									<select name="kandidat[]" class="form-control select2" data-placeholder="" multiple="multiple" style="width: 100%;" required="required">
										<?php foreach ($listkandidat as $lk): ?>
										<option value="<?=$lk->id_kandidat;?>"><?=$lk->nama_kandidat;?></option>
										<?php endforeach;?>
									</select>
							</div> -->
							<button type="reset" class="btn btn-flat btn-danger"><i class="fa fa-refresh"></i> Reset</button>
							<button class="btn btn-flat btn-success" <?=(count($listkandidat) < 2) ? 'disabled' : ''?>><i class="fa fa-check"></i> Save</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	<?php endif;?>
	</div>

	<script>
		$(function(){
			$('.select2').select2();
			$('.select22').select2();
			$('.table-pemilih').DataTable({
				'bFilter': false
			});
			$('.hapus-voting').on('click', function(e){
				e.preventDefault();
				var id = $(this).attr('data');
				Swal.fire({
					type: 'question',
					title: 'Delete this voting ?',
					text: 'Are you sure you want to delete the vote? All the related data will be deleted',
					showCancelButton: true,
					confirmButtonText: 'Delete'
				}).then((result) => {
					if (result.value) {
						window.location.assign('<?=base_url("admin/hapus_voting/")?>'+id);
					}
				});
				return false;
			})
		})
	</script>
	<?=($this->session->flashdata('ubah')) ? '<script>Swal.fire("Success", "Changes saved successfully!", "success")</script>' : '';?>