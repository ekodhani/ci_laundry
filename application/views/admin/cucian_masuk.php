  <!-- Main content -->
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <button type="button" class="btn btn-neutral">
                <span class="badge badge-primary"><i class="ni ni-curved-next text-primary"></i></span>
                <span class="text-primary"><?= $title;?></span>
              </button>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <a href="<?= base_url('admin/tambahCucianMasuk'); ?>" class="btn btn-sm btn-neutral">Tambah</a>
              <a href="<?= base_url('admin/masukExcel'); ?>" class="btn btn-sm btn-neutral">Download Excel</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card bg-default shadow">
            <div class="card-header bg-transparent border-0">
                <h3 class="mb-0 text-white">Data Laundry yang belum di ambil</h3>
                <?= $this->session->userdata('message'); ?>
            </div>
            <div class="table-responsive">
            <table class="table align-items-center table-dark table-flush">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Konsumen</th>
                    <th scope="col">Berat</th>
                    <th scope="col">Tanggal Masuk</th>
                    <th scope="col">Bayar</th>
                    <th scope="col">Paket</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody class="list">
                    <?php 
                    $no=1;
                    function rupiah($angka)
                    {
                        $hasil = "Rp. ". number_format($angka,2,',','.');
                        return $hasil;
                    }
                    foreach($laundry as $l) :?>
                  <tr>
                    <th scope="row"><?= $no++; ?></th>
                    <th scope="row"><?= $l->nama_konsumen;?></th>
                    <td><?= $l->berat; ?></td>
                    <td><?= $l->tgl_masuk; ?></td>
                    <td><?= rupiah($l->bayar); ?></td>
                    <td><?= $l->nama_paket; ?></td>
                    <td>
                        <a href="<?= base_url('admin/ambilCucian/') .$l->id_laundry;?>" class="btn btn-primary btn-sm"><i class="ni ni-basket"></i> Ambil</a>
                        <a href="<?= base_url('admin/editCucianMasuk/') .$l->id_laundry;?>" class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Edit</a>
                        <a href="<?= base_url('admin/hapusCucianMasuk/') . $l->id_laundry; ?>" onclick="return confirm('Yakin ingin menghapus ?')" class="btn btn-secondary btn-sm"><i class="fas fa-trash"></i> Hapus</a>
                    </td>
                  </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>