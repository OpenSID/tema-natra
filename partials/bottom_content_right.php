<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="content_bottom_right">
<div id="jam" style="margin-bottom:10px; background:#e64946;border:3px double #ffffff;padding:3px;width:auto;" align="center;"></div>

<!-- Tampilkan Widget -->
<?php

if($w_cos):
	foreach($w_cos as $data):
		$widget = trim($data['isi']);
		if($data["jenis_widget"] == 1):
			include("donjo-app/views/widgets/".$widget);
		elseif($data["jenis_widget"] == 2):
			include($data['isi']);
		else: ?>
			<div class="box box-primary box-solid">
				<div class="box-header">
					<h3 class="box-title"><?=$data["judul"]?></h3>
				</div>
				<div class="box-body">
					<?=html_entity_decode($data['isi'])?>
				</div>
			</div>
		<?php endif;
	endforeach;
endif;
?>
</div>
