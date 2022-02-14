<?php defined('BASEPATH') || exit('No direct script access allowed'); ?>

<?php if ($single_artikel["id"]) : ?>
	<div class="single_page_area" id="<?= 'artikel-' . $single_artikel['judul'] ?>">
		<div style="margin-top:0px;">
			<?php if (!empty($teks_berjalan)) : ?>
				<marquee onmouseover="this.stop()" onmouseout="this.start()">
					<?php $this->load->view("$folder_themes/layouts/teks_berjalan"); ?>
				</marquee>
			<?php endif; ?>
		</div>
		<div class="single_category wow fadeInDown">
			<h2> <span class="bold_line"><span></span></span> <span class="solid_line"></span> <span class="title_text">Artikel</span> </h2>
		</div>
		<div id="printableArea">
			<h4 class="catg_titile" style="font-family: Oswald">
				<font color="#FFFFFF"><?= $single_artikel["judul"] ?></font>
			</h4>
			<div class="post_commentbox">
				<span class="meta_date"><?= tgl_indo2($single_artikel['tgl_upload']); ?>&nbsp;
					<i class="fa fa-user"></i><?= $single_artikel['owner'] ?>&nbsp;
					<i class="fa fa-eye"></i><?= hit($single_artikel['hit']) ?> Dibaca&nbsp;
					<?php if (trim($single_artikel['kategori']) != '') : ?>
						<a href="<?= site_url('first/kategori/' . $single_artikel['id_kategori']) ?>"><i class='fa fa-tag'></i><?= $single_artikel['kategori'] ?></a>
					<?php endif; ?>
				</span>
				<div class="fb-like" data-href="<?= site_url('artikel/' . buat_slug($single_artikel['id'])) ?>" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="true"></div>
			</div>
			<div class="single_page_content" style="margin-bottom:10px;">
				<?php if ($single_artikel['id_kategori'] == 1000) : ?>
					<div class="row">
						<div class="col-md-4 col-xs-12">
							<div class="info-box bg-info">
								<span class="info-box-icon"><i class="fa fa-calendar"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Tanggal & Jam</span>
									<span class="progress-description">
										<?= tgl_indo2($detail_agenda['tgl_agenda']) ?>
									</span>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-xs-12">
							<div class="info-box bg-success box-primary-shadow">
								<span class="info-box-icon"><i class="fa fa-map-marker"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Lokasi</span>
									<span class="progress-description">
										<?= $detail_agenda['lokasi_kegiatan'] ?>
									</span>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-xs-12">
							<div class="info-box bg-danger">
								<span class="info-box-icon"><i class="fa fa-bullhorn"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Koordinator</span>
									<span class="progress-description">
										<?= $detail_agenda['koordinator_kegiatan'] ?>
									</span>
								</div>
							</div>
						</div>
					</div>
				<?php endif; ?>
				<div class="sampul">
					<?php if ($single_artikel['gambar'] != '' and is_file(LOKASI_FOTO_ARTIKEL . "sedang_" . $single_artikel['gambar'])) : ?>
						<a data-fancybox="gallery" href="<?= AmbilFotoArtikel($single_artikel['gambar'], 'sedang') ?>">
							<img width="270px" style="float:left; margin:0 8px 4px 0;" class="img-fluid img-thumbnail" src="<?= AmbilFotoArtikel($single_artikel['gambar'], 'sedang') ?>" />
						</a>
					<?php endif; ?>
				</div>
				<div class="teks"><?= $single_artikel["isi"] ?></div>
				<?php if ($single_artikel['dokumen'] != '' and is_file(LOKASI_DOKUMEN . $single_artikel['dokumen'])) : ?>
					<p>Unduh Lampiran:<br><a href='<?= site_url("first/unduh_dokumen_artikel/{$single_artikel[id]}") ?>' title=""><?= $single_artikel['link_dokumen'] ?></a></p>
				<?php endif; ?>
				<?php if ($single_artikel['gambar1'] != '' and is_file(LOKASI_FOTO_ARTIKEL . "sedang_" . $single_artikel['gambar1'])) : ?>
					<div class="sampul">
						<a data-fancybox="gallery" href="<?= AmbilFotoArtikel($single_artikel['gambar1'], 'sedang') ?>">
							<img width="270px" style="float:left; margin:0 8px 4px 0;" class="img-fluid img-thumbnail" src="<?= AmbilFotoArtikel($single_artikel['gambar1'], 'sedang') ?>" />
						</a>
					</div>
				<?php endif; ?>
				<?php if ($single_artikel['gambar2'] != '' and is_file(LOKASI_FOTO_ARTIKEL . "sedang_" . $single_artikel['gambar2'])) : ?>
					<div class="sampul">
						<a data-fancybox="gallery" href="<?= AmbilFotoArtikel($single_artikel['gambar2'], 'sedang') ?>">
							<img width="270px" style="float:left; margin:0 8px 4px 0;" class="img-fluid img-thumbnail" src="<?= AmbilFotoArtikel($single_artikel['gambar2'], 'sedang') ?>" />
						</a>
					</div>
				<?php endif; ?>
				<?php if ($single_artikel['gambar3'] != '' and is_file(LOKASI_FOTO_ARTIKEL . "sedang_" . $single_artikel['gambar3'])) : ?>
					<div class="sampul">
						<a data-fancybox="gallery" href="<?= AmbilFotoArtikel($single_artikel['gambar3'], 'sedang') ?>">
							<img width="270px" style="float:left; margin:0 8px 4px 0;" class="img-fluid img-thumbnail" src="<?= AmbilFotoArtikel($single_artikel['gambar3'], 'sedang') ?>" />
						</a>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<?php

		$share = [
			'link' => site_url('artikel/' . buat_slug($single_artikel)),
			'judul' => htmlspecialchars($single_artikel["judul"]),
		];
		$this->load->view("$folder_themes/commons/share", $share);

		?>

	</div>
	<?php if ($single_artikel['boleh_komentar'] == 1) : ?>
		<div class="fb-comments" data-href="<?= site_url('artikel/' . buat_slug($single_artikel)) ?>" width="100%" data-numposts="5"></div>
	<?php endif; ?>
	<div class="contact_bottom">
		<?php if (!empty($komentar)) : ?>
			<div class="contact_bottom">
				<div class="box-body">
					<?php foreach ($komentar as $data) : ?>
						<table class="table table-bordered table-striped dataTable table-hover">
							<thead class="bg-gray disabled color-palette">
								<tr>
									<th><i class="fa fa-comment"></i> <?= $data['owner'] ?></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<font color='green'><small><?= tgl_indo2($data['tgl_upload']) ?></small></font><br /><?= $data['komentar'] ?>
									</td>
								</tr>
							</tbody>
						</table>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
	<div class="form-group group-komentar" id="kolom-komentar">
		<?php if ($single_artikel['boleh_komentar'] == 1) : ?>
			<div class="box box-default">
				<div class="box-header">
					<h2 class="box-title">Kirim Komentar</h2>
				</div>
				<hr />
				<?php
				$notif = $this->session->flashdata('notif');
				$label = ($notif['status'] == -1) ? 'label-danger' : 'label-info';
				?>
				<?php if ($notif) : ?>
					<div class="box-header <?= $label; ?>"><?= $notif['pesan']; ?></div>
				<?php endif; ?>
				<div class="contact_bottom">
					<form class="contact_form form-komentar" id="validasi" name="form" action="<?= site_url("add_comment/$single_artikel[id]"); ?>" method="POST" onSubmit="return validasi(this);">
						<table width="100%">
							<tr class="komentar nama">
								<td width="20%">Nama</td>
								<td>
									<input class="form-group required" type="text" name="owner" maxlength="100" placeholder="ketik di sini" value="<?= $notif['data']['owner']; ?>">
								</td>
							</tr>
							<tr class="komentar alamat">
								<td>No. Hp</td>
								<td>
									<input class="form-group number required" type="text" name="no_hp" maxlength="15" placeholder="ketik di sini" value="<?= $notif['data']['no_hp']; ?>">
								</td>
							</tr>
							<tr class="komentar alamat">
								<td>E-mail</td>
								<td>
									<input class="form-group email" type="text" name="email" maxlength="100" placeholder="email@gmail.com" value="<?= $notif['data']['email']; ?>">
								</td>
							</tr>
							<tr class="komentar pesan">
								<td valign="top">Isi Pesan</td>
								<td>
									<textarea class="required" name="komentar"><?= $notif['data']['komentar']; ?></textarea>
								</td>
							</tr>
							<tr class="captcha">
								<td>&nbsp;</td>
								<td>
									<img id="captcha" src="<?= base_url('securimage/securimage_show.php'); ?>" alt="CAPTCHA Image" />
									<a href="#" onclick="document.getElementById('captcha').src = '<?= base_url() . "securimage/securimage_show.php?" ?>' + Math.random(); return false" style="color: #000000;">[ Ganti gambar ]</a>
								</td>
							</tr>
							<tr class="captcha_code">
								<td>&nbsp;</td>
								<td>
									<input type="text" name="captcha_code" class="required" maxlength="6" value="<?= $notif['data']['captcha_code']; ?>" /> Isikan kode di gambar
								</td>
							</tr>
							<tr class="submit">
								<td>&nbsp;</td>
								<td><input type="submit" value="Kirim"></td>
							</tr>
							<tr class="submit">
								<td><br><br></td>
							</tr>
						</table>
					</form>
				</div>
			</div>
		<?php else : ?>
			<span class='info'></span>
		<?php endif; ?>
	</div>
<?php else : ?>
	<?php $this->load->view("$folder_themes/commons/not_found"); ?>
<?php endif; ?>