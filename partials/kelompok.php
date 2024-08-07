<?php defined('BASEPATH') || exit('No direct script access allowed'); ?>

<php $tipe=ucwords($detail['tipe']); ?>

    <div class="single_page_area">
        <h2 class="post_titile"><?= $title ?></h2>
        <h3 class="post_titile">Rinci Data <?= $tipe ?></h3>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <tbody>
                    <tr>
                        <td width="20%">Nama <?= $tipe ?></td>
                        <td width="1%">:</td>
                        <td><?= $detail['nama'] ?></td>
                        <td width="20%" rowspan="5" style="text-align: center; vertical-align: middle;">
                            <img src="<?= gambar_desa($detail['logo']) ?>" alt="Logo <?= ucwords($detail['tipe']) ?>" height="120px;">
                        </td>
                    </tr>
                    <tr>
                        <td>Kode <?= $tipe ?></td>
                        <td>:</td>
                        <td><?= $detail['kode'] ?></td>
                    </tr>
                    <tr>
                        <td>Kategori <?= $tipe ?></td>
                        <td>:</td>
                        <td><?= $detail['kategori'] ?></td>
                    </tr>
                    <tr>
                        <td>No. SK Pendirian</td>
                        <td>:</td>
                        <td><?= $detail['no_sk_pendirian'] ?></td>
                    </tr>
                    <tr>
                        <td>Keterangan</td>
                        <td>:</td>
                        <td><?= $detail['keterangan'] ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <h3 class="post_titile">Daftar Pengurus</h3>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jabatan</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pengurus as $key => $data) : ?>
                            <tr>
                                <td><?= ($key + 1) ?></td>
                                <td><?= $data['jabatan'] ?></td>
                                <td nowrap><?= $data['nama'] ?></td>
                                <td><?= $data['alamat'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <h3 class="post_titile">Daftar Anggota</h3>
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="tabel-data">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No. Anggota</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Jenis Kelamin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($anggota as $key => $data) : ?>
                            <tr>
                                <td class="text-center"></td>
                                <td><?= $data['no_anggota'] ?: '-'; ?></td>
                                <td nowrap><?= $data['nama']; ?></td>
                                <td><?= $data['alamat']; ?></td>
                                <td class="text-center"><?= $data['sex']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var tabelData = $('#tabel-data').DataTable({
                'processing': false,
                'order': [
                    [1, 'desc']
                ],
                'pageLength': 10,
                'lengthMenu': [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "Semua"]
                ],
                'columnDefs': [{
                        'searchable': false,
                        'targets': [0]
                    },
                    {
                        'orderable': false,
                        'targets': [0]
                    }
                ],
                'language': {
                    'url': BASE_URL + '/assets/bootstrap/js/dataTables.indonesian.lang'
                },
            });

            tabelData.on('order.dt search.dt', function() {
                tabelData.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
        });
    </script>