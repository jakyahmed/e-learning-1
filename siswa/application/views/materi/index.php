<section class="materi-siswa">
    <div class="container">
        <div class="row">
            <?php
                if(is_array($konten)){
                    foreach($konten as $konten){
                    ?>
            <div id="printpdf">
                <?php foreach($materi as $materi){ ?>
                <h2 class="text-center"><?php echo $materi['nama_materi']; ?></h3>
                <h3 class="text-center" id="submateri"><?php echo $materi['nama_submateri']; ?></h4>
                <?php } ?>
                <div class="form-reg">
                    <span class="label <?php echo ($konten['tipe'] == 'class') ? 'label-warning' : 'label-danger' ?>"><?php echo ucfirst($konten['tipe'])?> Activity</span>
                    <span class="label label-default">Mata Kuliah : <?php echo $materi['nama_mapel']; ?></span>
                </div>
                <div class="form-reg">
                    <!-- konten -->
                    <?php

                        $tipekonten = substr($konten['isi'],0,3);
                        $filename = "http://localhost/e-learning/upload/materi/".$konten['isi'];
                        if($tipekonten == "pdf"){       
                            ?>
                            <iframe src="http://localhost/e-learning/public/js/pdfjs/web/viewer.html?file=<?php echo $filename?>#zoom=page-auto"></iframe>
                            <?php
                        }
                        else if($tipekonten == "vid"){
                            //$filename =  realpath(dirname(__DIR__)."/../../materi".$data['konten']);
                            ?>
                            <div class="video-konten embed-responsive embed-responsive-16by9">
                                <video controls src="<?php echo $filename?>" class="embed-responsive-item">
                                    Browser Anda tidak mendukung Video Player HTML5.
                                </video> 
                            </div>
                            <?php
                        }
                        else {
                            echo $konten['isi'];
                        }?>
                </div>
            </div>
            <div class="class">
                <label class="clues">Upload file tugas dalam bentuk <strong>.zip</strong> dengan nama file nama_jenismateri_submateri (contoh: ibnu_class_carakerjaaplikasiwebberbasisserver.zip)</label>
                <label class="clues">Klik tombol <strong>Upload File Jawaban Latihan</strong>, lalu Klik OK</label>
                <form name="formup" id="formup" method="post" action="index.php?p=fupmateri" enctype="multipart/form-data">
                    <input type="hidden" name="submateri" value="<?php echo $konten['submateri_id']; ?>">
                    <input type="file" name="uptugas" id="uptugas" class="custom-file-input" value="">
                    <div class="form-reg finish">
                        <input type="submit" name="finish_reg" value="OK" class="btn btn-default act">
                    </div>
                    <hr>
                </form>
            </div>
            <?php
                            }
            ?>
            
            <div class="form-reg modul-siswa">
                <!-- NEW LINK -->
                
                    <a href="index.php?p=me&sm=" class="btn btn-default">Materi Sebelumnya</a>
                    <a href="index.php?p=me&sm=" class="btn btn-default">Materi Berikutnya</a>
                <?php if($tipekonten == "/pdf" || $konten == "/vid" ) {
                            echo'<a href="'.$filename.'" class="btn btn-default">Download Materi</a>';
                        }
                        else{
                            echo '<button id="print" class="btn btn-default">Download Materi</button>';
                        }
                ?>
                <a href="#" type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-default">Komentar</a>
            </div>
            
            <!-- Modal Dialog -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                            </button>
                            <h4 class="modal-title" id="exampleModalLabel">Komentar</h4>
                        </div>
                        <!-- ISI KOMENTAR -->
                        <form name="formkomentar" id="formkomentar" method="post" action="<?php echo base_url('materi/komentar')?>" role="form" class="form-group form-comment">
                            <p class="judul-materi">Kesulitan? Saran? Ajukan melalui form komentar!</p>
                            <!-- <input type="hidden" name="kategori" id="kategori" value="cm">
                            <input type="hidden" name="user" id="user" value="<php echo $_SESSION['user']; ?>">
                            -->
                            <label for="subyek" class="control-label">Subjek</label>
                                <input type="text" name="subyek" id="subyek" value="" class="form-control">
                            <label for="komentar" class="control-label">Komentar</label>
                                <textarea id="komentar" name="komentar" class="form-control"></textarea>
                            <label class="control-label" id="captchaOperation"></label>
                                <input type="text" class="form-control" name="captcha"/>
                            <input type="hidden" name="kontenmateri" id="kontenmateri" value="<?php echo $konten['id']?>"> 
                            <input type="submit" name="kirim" value="Kirim" class="btn btn-default action send">
                        </form>

                        <!-- DAFTAR KOMENTAR -->
                        <?php
                            $komentar = getKomentar($konten['id']);

                            if(is_array($komentar)){
                                foreach ($komentar as $komentar) {
                        ?>
                        <div class="comment-list">
                            <p><b><?php echo date("d F Y H:i", strtotime($komentar['tanggal'])); ?></b>, <b><?php echo getNama($komentar['user_id'], $komentar['level']) ?></b> mengatakan :</p>
                            <p><?php echo $komentar['deskripsi']?></p>
                        </div>
                        <?php 
                                }
                            }
                            else{
                                ?>
                                <label class="label label-danger">Data tidak ditemukan</label>
                                <?php
                            }
                        ?>
                        
                        <!-- JIKA TIDAK ADA -->
                        <!--  -->
                    </div>
                </div>
            </div>
            <?php
                } // end if konten exist
            ?>
            </div>
        </div>
    </div>
</section>