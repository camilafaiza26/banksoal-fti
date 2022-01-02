<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"><?=$subjudul?></h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
		<div class="row">
		<?php if ( $this->ion_auth->is_admin() ) : ?>
        	<div class="col-sm-4">
				<button type="button" onclick="bulk_delete()" class="btn btn-flat btn-sm bg-red"><i class="fa fa-trash"></i> Bulk Delete</button>
			</div>
			<div class="form-group col-sm-4 text-center">
					<select id="matkul_filter" class="form-control select2" style="width:100% !important">
						<option value="all">Semua Matkul</option>
						<?php foreach ($matkul as $m) :?>
							<option value="<?=$m->id_matkul?>"><?=$m->nama_matkul?></option>
						<?php endforeach; ?>
					</select>
			
			</div>
			<div class="col-sm-4">
				<div class="pull-right">
					<a href="<?=base_url('sisteminformasi/add')?>" class="btn bg-purple btn-flat btn-sm"><i class="fa fa-plus"></i> Tambah Bank Soal</a>
				
				</div>
				
			</div>
		</div>
		<button type="button" onclick="reload_ajax()" class="btn btn-flat btn-sm bg-maroon"><i class="fa fa-refresh"></i> Reload</button>
    </div>
	<?=form_open('sisteminformasi/delete', array('id'=>'bulk'))?>
    <div class="table-responsive px-4 pb-3" style="border: 0">
        <table id="sisteminformasi" class="w-100 table table-striped table-bordered table-hover">
        <thead>
            <tr>
				<th class="text-center">
					<input type="checkbox" class="select_all">
				</th>
                <th width="25">No.</th>
				<!-- <th>Dosen</th> -->
                <th>Mata Kuliah</th>
				<th>Soal</th>
			
				<th>Tahun</th>
				<th>Tanggal Dibuat </th>
				<th class="text-center">Aksi</th>
            </tr>        
        </thead>
        <tfoot>
            <tr>
				<th class="text-center">
					<input type="checkbox" class="select_all">
				</th>
                <th width="25">No.</th>
				<!-- <th>Dosen</th> -->
                <th>Mata Kuliah</th>
				
				<th>Soal</th>
				<th>Tahun</th>
				<th>Tanggal Dibuat </th>
				<th class="text-center">Aksi</th>
            </tr>
        </tfoot>
        </table>
    </div>
	<?=form_close();?>
</div>
<?php endif; ?>

<?php if ( $this->ion_auth->in_group('mahasiswa') ) : ?>
	<div class="row">
	<div class="col-sm-12">
	<div class="form-group col-sm-4 text-center">
					<select id="matkul_filter" class="form-control select2" style="width:100% !important">
						<option value="all">Semua Matkul</option>
						<?php foreach ($matkul as $m) :?>
							<option value="<?=$m->id_matkul?>"><?=$m->nama_matkul?></option>
						<?php endforeach; ?>
					</select>
			
	</div>
	</div>
	</div>
	<div class="table-responsive px-4 pb-3" style="border: 0">
        <table id="sisteminformasiM" class="w-100 table table-striped table-bordered table-hover">
        <thead>
		<tr>
				<th class="text-center">
					<input type="checkbox" class="select_all">
				</th>
                <th width="25">No.</th>
				<!-- <th>Dosen</th> -->
                <th>Mata Kuliah</th>
				<th>Soal</th>
			
				<th>Tahun</th>
				
				<th class="text-center">Aksi</th>
            </tr>        
        </thead>
        <tfoot>
            <tr>
				<th class="text-center">
					<input type="checkbox" class="select_all">
				</th>
                <th width="25">No.</th>
				<!-- <th>Dosen</th> -->
                <th>Mata Kuliah</th>
				
				<th>Soal</th>
				<th>Tahun</th>
			
				<th class="text-center">Aksi</th>
            </tr>
        </tfoot>
        </table>
    </div>


<?php endif; ?>

<?php if ( $this->ion_auth->is_admin() ) : ?>
<script src="<?=base_url()?>assets/dist/js/app/sisteminformasi/data.js"></script>

<?php endif; ?>
<?php if ( $this->ion_auth->in_group('mahasiswa') ) : ?>
<script src="<?=base_url()?>assets/dist/js/app/sisteminformasi/dataM.js"></script>
<?php endif; ?>

<script type="text/javascript">
$(document).ready(function(){
	$('#matkul_filter').on('change', function(){
		let id_matkul = $(this).val();
		let src = '<?=base_url()?>sisteminformasi/data';
		let url;

		if(id_matkul !== 'all'){
			let src2 = src + '/' + id_matkul;
			url = $(this).prop('checked') === true ? src : src2;
		}else{
			url = src;
		}
		table.ajax.url(url).load();
	});
});
</script>