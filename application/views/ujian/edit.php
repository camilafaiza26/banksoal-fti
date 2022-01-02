<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"><?=$subjudul?></h3>
        <div class="box-tools pull-right">
            <a href="<?=base_url()?>ujian/master" class="btn btn-sm btn-flat btn-warning">
                <i class="fa fa-arrow-left"></i> Batal
            </a>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-4">
                <?=form_open('ujian/save', array('id'=>'formujian'), array('method'=>'edit', 'id_ujian'=>$ujian->id_ujian))?>
                <div class="form-group">
                    <label for="nama_ujian">Nama Ujian</label>
                    <input value="<?=$ujian->nama_ujian?>" autofocus="autofocus" onfocus="this.select()" placeholder="Nama Ujian" type="text" class="form-control" name="nama_ujian">
                    <small class="help-block"></small>
                </div>
                <div class="form-group">
                <label for="nama_ujian">Matakuliah</label>
                <select required="required" name="matkul_id" id="matkul_id" class="select2 form-group" style="width:100% !important">
                                    <option value="" disabled selected>Pilih Mata Kuliah</option>
                                    <?php
                                    $sdm = $ujian->matkul_id;
                                    foreach ($matkul as $d) :
                                        $dm = $d->id_matkul;?>
                                        <option <?=$sdm===$dm?"selected":"";?> value="<?=$dm?>"><?=$d->nama_matkul?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="help-block" style="color: #dc3545"><?=form_error('matkul_id')?></small>
                           
                           
                <div class="form-group">
                    <label for="jumlah_soal">Jumlah Soal</label>
                    <input value="<?=$ujian->jumlah_soal?>" placeholder="Jumlah Soal" type="number" class="form-control" name="jumlah_soal">
                    <small class="help-block"></small>
                </div>
                <div class="form-group">
                    <label for="tgl_mulai">Tanggal Mulai</label>
                    <input id="tgl_mulai" name="tgl_mulai" type="text" class="datetimepicker form-control" placeholder="Tanggal Mulai">
                    <small class="help-block"></small>
                </div>
                <div class="form-group">
                    <label for="tgl_selesai">Tanggal Selesai</label>
                    <input id="tgl_selesai" name="tgl_selesai" type="text" class="datetimepicker form-control" placeholder="Tanggal Selesai">
                    <small class="help-block"></small>
                </div>
                <div class="form-group">
                    <label for="waktu">Waktu</label>
                    <input value="<?=$ujian->waktu?>" placeholder="menit" type="number" class="form-control" name="waktu">
                    <small class="help-block"></small>
                </div>
                <div class="form-group">
                    <label for="jenis">Acak Soal</label>
                    <select name="jenis" class="form-control">
                        <option value="" disabled selected>--- Pilih ---</option>
                        <option <?=$ujian->jenis==="acak"?"selected":"";?> value="acak">Acak Soal</option>
                        <option <?=$ujian->jenis==="urut"?"selected":"";?> value="urut">Urut Soal</option>
                    </select>
                    <small class="help-block"></small>
                </div>
                <div class="form-group pull-right">
                    <button type="reset" class="btn btn-default btn-flat">
                        <i class="fa fa-rotate-left"></i> Reset
                    </button>
                    <button id="submit" type="submit" class="btn btn-flat bg-purple"><i class="fa fa-save"></i> Simpan</button>
                </div>
                <?=form_close()?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var tgl_mulai = '<?=$ujian->tgl_mulai?>';
    var terlambat = '<?=$ujian->terlambat?>';
</script>

<script src="<?=base_url()?>assets/dist/js/app/ujian/edit.js"></script>