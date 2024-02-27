<?php defined('BASEPATH') || exit('No direct script access allowed'); ?>

<style type="text/css">
	.highcharts-xaxis-labels tspan {font-size: 8px;}
</style>
<div class="single_bottom_rightbar">
	<h2><a href="<?= site_url("data-statistik/jenis-kelamin") ?>"><i class="fa fa-bar-chart"></i>&ensp;<?= $judul_widget ?></a></h2>
	<script type="text/javascript">
		$(function () {
			var chart_widget;
			$(document).ready(function () {
					// Build the chart
					chart_widget = new Highcharts.Chart({
						chart: {
							renderTo: 'container_widget',
							plotBackgroundColor: null,
							plotBorderWidth: null,
							plotShadow: false
						},
						title: {
							text: 'Jumlah Penduduk'
						},
						yAxis: {
							title: {
								text: 'Jumlah'
							}
						},
						xAxis: {
							categories:
							[
								<?php foreach($stat_widget as $data): ?>
									<?php if ($data['jumlah'] != "-" && $data['nama']!= "JUMLAH" && $data['nama'] != "BELUM MENGISI"): ?>
										['<?= $data['jumlah']?>,<?= $data['nama']?>'],
									<?php endif; ?>
								<?php endforeach; ?>
							]
						},
						legend: {
							enabled:false
						},
						plotOptions: {
							series: {
								colorByPoint: true
							},
							column: {
								pointPadding: 0,
								borderWidth: 0
							}
						},
						series: [{
							type: 'column',
							name: 'Populasi',
							data: 
							[
								<?php foreach($stat_widget as $data): ?>
									<?php if ($data['jumlah'] != "-" && $data['nama']!= "JUMLAH" && $data['nama'] != "BELUM MENGISI"): ?>
										['<?= $data['jumlah']?>,<?= $data['nama']?>'],
									<?php endif; ?>
								<?php endforeach; ?>
							]
						}]
					});
				});

		});
	</script>
	<div id="container_widget" style="width: 100%; height: 300px; margin: 0 auto"></div>
</div>
