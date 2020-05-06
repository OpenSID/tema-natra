<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<script>
	const COVID_API_URL = 'https://api.kawalcorona.com/';
	const KODE_PROVINSI = <?= config_item('covid_provinsi') ? : 'undefined' ?>;
	const KODE_NEGARA = <?= config_item('covid_negara') ? : 'undefined' ?>;
	const ENDPOINT_PROVINSI = 'indonesia/provinsi/'
	const regions = {
		indonesia: {
			id: 1,
			attributes: {
				wilayah: 'Country_Region',
				positif: 'Confirmed',
				meninggal: 'Deaths',
				sembuh: 'Recovered'
			}
		},
		provinsi: {
			id: 2,
			attributes: {
				wilayah: 'Provinsi',
				positif: 'Kasus_Posi',
				meninggal: 'Kasus_Meni',
				sembuh: 'Kasus_Semb'
			}
		}
	};

	function numberFormat(num) {
		return new Intl.NumberFormat('id-ID').format(num);
	}

	function parseToNum(data) {
		return parseFloat(data.toString().replace(/,/g, ''));
	}

	function showData(result, region) {
		const data = result[0];

		Object.keys(region.attributes).forEach(function (prop) {
			let tempData = data.attributes[region.attributes[prop]];
			let finalData = prop === 'wilayah' ? tempData : numberFormat(parseToNum(tempData));
			$(`.wilayah${region.id}`).parent().parent().find(`[data-status=${prop}]`).html(finalData);
		});

		if (region.id === regions.indonesia.id) {
			const lastUpdate = new Date(data.attributes.Last_Update).toLocaleString("id-ID", {timeZone: 'Asia/Jakarta', timeZoneName:'short'});
			$('.last_update').html(lastUpdate);
		}
	}

	function showError() {
		$('#covid .panel-body.text-center, .last_update').html('<small>Gagal mengambil data</small>');
	}

	$(document).ready(function () {
		if (KODE_NEGARA) {
			try {
				$.ajax({
					async: true,
					cache: true,
					url: COVID_API_URL,
					success: function (response) {
						const result = response.filter(data => data.attributes.OBJECTID == KODE_NEGARA);
						showData(result, regions.indonesia);
					},
					error: function (err) {
						showError();
					}
				});
			} catch (error) {
				showError()
			}
		}

		if (KODE_PROVINSI) {
			try {
				$.ajax({
					async: true,
					cache: true,
					url: COVID_API_URL + ENDPOINT_PROVINSI,
					success: function (response) {
						const result = response.filter(data => data.attributes.Kode_Provi == KODE_PROVINSI);
						showData(result, regions.provinsi);
					},
					error: function (err) {
						showError();
					}
				});
			} catch (error) {
				showError()
			}
		}
	})
</script>

<div class="archive_style_1" style="font-family: Oswald" id="covid">
	<h2> <span class="bold_line"><span></span></span> <span class="solid_line"></span> <span class="title_text">Statistik
			COVID-19</span></h2>
	<div class="row">
		<div style="margin-top:10px;">
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<div class="panel panel-danger">
					<div style="height: 40px;padding:1px" class="panel-heading text-center">
						<h4>Positif</h4>
					</div>
					<div style="height: 70px;padding:1px" class="panel-body text-center">
						<?php if (!empty(config_item('covid_negara'))): ?>
						<div style="height: 35px;padding:1px" class="panel-body text-center">
							<h4><small><span class="wilayah1" data-status="wilayah"><i class="fa fa-spinner fa-pulse"></i></span></small> <span data-status="positif"></span>
								<small>Jiwa</small></h4>
						</div>
						<?php endif; ?>
						<?php if (!empty(config_item('covid_provinsi'))): ?>
						<div style="height: 35px;padding:1px" class="panel-body text-center">
							<h4><small><span class="wilayah2" data-status="wilayah"><i class="fa fa-spinner fa-pulse"></i></span></small> <span data-status="positif"></span>
								<small>Jiwa</small></h4>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<div class="panel panel-info">
					<div style="height: 40px;padding:1px" class="panel-heading text-center">
						<h4>Sembuh</h4>
					</div>
					<div style="height: 70px;padding:1px" class="panel-body text-center">
						<?php if (!empty(config_item('covid_negara'))): ?>
						<div style="height: 35px;padding:1px" class="panel-body text-center">
							<h4><small><span class="wilayah1" data-status="wilayah"><i class="fa fa-spinner fa-pulse"></i></span></small> <span data-status="sembuh"></span>
								<small>Jiwa</small></h4>
						</div>
						<?php endif; ?>
						<?php if (!empty(config_item('covid_provinsi'))): ?>
						<div style="height: 35px;padding:1px" class="panel-body text-center">
							<h4><small><span class="wilayah2" data-status="wilayah"><i class="fa fa-spinner fa-pulse"></i></span></small> <span data-status="sembuh"></span>
								<small>Jiwa</small></h4>
						</div>
						<?php endif; ?>
					</div>

				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<div class="panel panel-success">
					<div style="height: 40px;padding:1px" class="panel-heading text-center">
						<h4>Meninggal</h4>
					</div>
					<div style="height: 70px;padding:1px" class="panel-body text-center">
						<?php if (!empty(config_item('covid_negara'))): ?>
						<div style="height: 35px;padding:1px" class="panel-body text-center">
							<h4><small><span class="wilayah1" data-status="wilayah"><i class="fa fa-spinner fa-pulse"></i></span></small> <span data-status="meninggal"></span>
								<small>Jiwa</small></h4>
						</div>
						<?php endif; ?>
						<?php if (!empty(config_item('covid_provinsi'))): ?>
						<div style="height: 35px;padding:1px" class="panel-body text-center">
							<h4><small><span class="wilayah2" data-status="wilayah"><i class="fa fa-spinner fa-pulse"></i></span></small> <span data-status="meninggal"></span>
								<small>Jiwa</small></h4>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<?php if(config_item('covid_negara')) : ?>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="progress-group">
					<span>Terakhir diperbarui :</span>
					<span class="last_update"><i class="fa fa-spinner fa-pulse"></i></span>
				</div>
			</div>
			<?php endif ?>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="progress-group">
					<a href="https://kawalcorona.com/" rel="noopener noreferrer" target="_blank">
						<button type="button" class="btn btn-success btn-block">Sumber kawalcorona.com</button>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>