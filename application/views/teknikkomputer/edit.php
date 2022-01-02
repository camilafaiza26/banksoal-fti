<div class="row">
    <div class="col-sm-12">    
        <?=form_open_multipart('teknikkomputer/save', array('id'=>'formsoal'), array('method'=>'edit', 'id_soal'=>$soal->id_soal));?>
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
                    <div class="col-sm-8 col-sm-offset-2">
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="matkul_id" class="control-label">Mata Kuliah</label>
                              
                                <select required="required" name="matkul_id" id="matkul_id" class="select2 form-group" style="width:100% !important">
                                    <option value="" disabled selected>Pilih Matkul</option>
                                    <?php
                                    $sdm = $soal->matkul_id;
                                    foreach ($matkul as $d) :
                                        $dm = $d->id_matkul;?>
                                        <option <?=$sdm===$dm?"selected":"";?> value="<?=$d->id_matkul?>"><?=$d->nama_matkul?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="help-block" style="color: #dc3545"><?=form_error('matkul_id')?></small>
                            </div>
                            
                            <div class="col-sm-12">
                                <label for="soal" class="control-label text-center">Soal</label>
                                <div class="row">
                                    <div class="form-group col-sm-3">
                                        <input type="file" name="file_soal" class="form-control">
                                        <small class="help-block" style="color: #dc3545"><?=form_error('file_soal')?></small>
                                        <?php if (!empty($soal->file)) : ?>
                                            <?=tampil_media('uploads/bank_soal/'.$soal->file);?>
                                        <?php endif;?>
                                    </div>
                                    <div class="form-group col-sm-9">
                                        <textarea name="soal" id="soal" class="form-control summernote"><?=$soal->soal?></textarea>
                                        <small class="help-block" style="color: #dc3545"><?=form_error('soal')?></small>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- 
                                Membuat perulangan A-E 
                            -->
                            <?php
                            $abjad = ['a', 'b', 'c', 'd', 'e'];
                            foreach ($abjad as $abj) :
                                $ABJ = strtoupper($abj); // Abjad Kapital
                                $file = 'file_'.$abj;
                                $opsi = 'opsi_'.$abj;
                            ?>
                            
                            <div class="col-sm-12">
                                <label for="jawaban_<?= $abj; ?>" class="control-label text-center">Jawaban <?= $ABJ; ?></label>
                                <div class="row">
                                    <div class="form-group col-sm-3">
                                        <input type="file" name="<?= $file; ?>" class="form-control">
                                        <small class="help-block" style="color: #dc3545"><?=form_error($file)?></small>
                                        <?php if (!empty($soal->$file)) : ?>
                                            <?=tampil_media('uploads/bank_soal/'.$soal->$file);?>
                                        <?php endif;?>
                                    </div>
                                    <div class="form-group col-sm-9">
                                        <textarea name="jawaban_<?= $abj; ?>" id="jawaban_<?= $abj; ?>" class="form-control summernote"><?=$soal->$opsi?></textarea>
                                        <small class="help-block" style="color: #dc3545"><?=form_error('jawaban_'.$abj)?></small>
                                    </div>
                                </div>
                            </div>
                            
                            <?php endforeach; ?>
                            
                            <div class="form-group col-sm-12">
                                <label for="tahun" class="control-label">Tahun</label>
                                <input required="required" value="<?=$soal->tahun?>" type="number" name="tahun" placeholder="Tahun Soal" id="tahun" class="form-control">
                                <small class="help-block" style="color: #dc3545"><?=form_error('tahun')?></small>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group pull-right">
                                    <a href="<?=base_url('teknikkomputer')?>" class="btn btn-flat btn-default"><i class="fa fa-arrow-left"></i> Batal</a>
                                    <button type="submit" id="submit" class="btn btn-flat bg-purple"><i class="fa fa-save"></i> Simpan</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?=form_close();?>
    </div>
</div>