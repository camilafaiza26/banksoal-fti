<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">

		<!-- Sidebar user panel (optional) -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="<?=base_url()?>assets/dist/img/user1.png" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p><?=$user->username?></p>
				<small><?=$user->email?></small>
			</div>
		</div>
		
		<ul class="sidebar-menu" data-widget="tree">
			<li class="header">MAIN MENU</li>
			<!-- Optionally, you can add icons to the links -->
			<?php 
			$page = $this->uri->segment(1);
			$banksoald = ["sisteminformasi", "teknikkomputer"];
			$master = ["jurusan","kelas", "matkul", "mahasiswa"];
			$relasi = ["jurusanmatkul"];
			$users = ["users"];
			?>
			<li class="<?= $page === 'dashboard' ? "active" : "" ?>"><a href="<?=base_url('dashboard')?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
		

			<?php if($this->ion_auth->is_admin()) : ?>
		
			<li class="treeview <?= in_array($page, $banksoald)  ? "active menu-open" : ""  ?>">
				<a href="#"><i class="fa fa-window-restore"></i> <span>Bank Soal</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="<?=$page==='sisteminformasi'?"active":""?>">
						<a href="<?=base_url('sisteminformasi')?>">
							<i class="fa fa-circle-o"></i>
							Sistem Informasi
						</a>
					</li>
					<li class="<?=$page==='teknikkomputer'?"active":""?>">
						<a href="<?=base_url('teknikkomputer')?>">
							<i class="fa fa-circle-o"></i>
							Teknik Komputer
						</a>
					</li>
				</ul>
			</li>

			<li class="treeview <?= in_array($page, $master)  ? "active menu-open" : ""  ?>">
				<a href="#"><i class="fa fa-folder"></i> <span>Data Master</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="<?=$page==='jurusan'?"active":""?>">
						<a href="<?=base_url('jurusan')?>">
							<i class="fa fa-circle-o"></i> 
							Master Jurusan
						</a>
					</li>
					<li class="<?=$page==='matkul'?"active":""?>">
						<a href="<?=base_url('matkul')?>">
							<i class="fa fa-circle-o"></i>
							Master Mata Kuliah
						</a>
					</li>
				
					<li class="<?=$page==='mahasiswa'?"active":""?>">
						<a href="<?=base_url('mahasiswa')?>">
							<i class="fa fa-circle-o"></i>
							Master Mahasiswa
						</a>
					</li>
				</ul>
			</li>



			<li class="treeview <?= in_array($page, $relasi)  ? "active menu-open" : ""  ?>">
				<a href="#"><i class="fa fa-link"></i> <span>Relasi</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
				
					<li class="<?=$page==='jurusanmatkul'?"active":""?>">
						<a href="<?=base_url('jurusanmatkul')?>">
							<i class="fa fa-circle-o"></i>
							Jurusan - Mata Kuliah
						</a>
					</li>
				</ul>
			</li>
	
			<?php endif; ?>
			<li class="header">Latihan Soal</li>
			<?php if( $this->ion_auth->is_admin()) : ?>
			<li class="<?=$page==='soal'?"active":""?>">
				<a href="<?=base_url('soal')?>" rel="noopener noreferrer">
					<i class="fa fa-file-text-o"></i> <span>Latihan Soal</span>
				</a>
			</li>
		
			<li class="<?=$page==='ujian'?"active":""?>">
				<a href="<?=base_url('ujian/master')?>" rel="noopener noreferrer">
					<i class="fa fa-chrome"></i> <span>Jadwal Latihan Soal</span>
				</a>
			</li>
			<?php endif; ?>
	
			<!-- BANK SOAL MAHASISWA -->
			<?php if( $this->ion_auth->in_group('mahasiswa') ) : ?>
			<li class="<?=$page==='sisteminformasi'?"active":""?>">
				<a href="<?=base_url('sisteminformasi')?>" rel="noopener noreferrer">
					<i class="fa fa-tasks"></i> <span>Bank Soal</span>
				</a>
			</li>
			<?php endif; ?>
			<?php if( $this->ion_auth->in_group('mahasiswa') ) : ?>
			<li class="<?=$page==='ujian'?"active":""?>">
				<a href="<?=base_url('ujian/list')?>" rel="noopener noreferrer">
					<i class="fa fa-edit"></i> <span>Latihan Soal</span>
				</a>
			</li>
			<?php endif; ?>
			<?php if( !$this->ion_auth->in_group('mahasiswa') ) : ?>
			<li class="header">REPORTS</li>
			<li class="<?=$page==='hasilujian'?"active":""?>">
				<a href="<?=base_url('hasilujian')?>" rel="noopener noreferrer">
					<i class="fa fa-file"></i> <span>Hasil Latihan Soal</span>
				</a>
			</li>
			<?php endif; ?>
		

			<?php if($this->ion_auth->is_admin()) : ?>
			<li class="header">ADMINISTRATOR</li>
			<li class="<?=$page==='users'?"active":""?>">
				<a href="<?=base_url('users')?>" rel="noopener noreferrer">
					<i class="fa fa-users"></i> <span>User Management</span>
				</a>
			</li>
			<li class="<?=$page==='settings'?"active":""?>">
				<a href="<?=base_url('settings')?>" rel="noopener noreferrer">
					<i class="fa fa-cog"></i> <span>Settings</span>
				</a>
			</li>
			<?php endif; ?>
		</ul>

	</section>
	<!-- /.sidebar -->
</aside>