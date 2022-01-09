  <!-- Main content -->
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
			<button type="button" class="btn btn-neutral">
				<span class="badge badge-primary"><i class="ni ni-bag-17 text-orange"></i></span>
				<span class="text-orange"><?= $title;?></span>
			</button>
            </div>
            <!-- <div class="col-lg-6 col-5 text-right">
              <a href="#" class="btn btn-sm btn-neutral">New</a>
              <a href="#" class="btn btn-sm btn-neutral">Filters</a>
            </div> -->
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col-xl-7">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Tambah Paket</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label class="form-control-label" for="nama-paket">Nama Paket</label>
                        <input type="text" id="nama-paket" class="form-control form-control-sm" placeholder="Masukkan Nama Paket" name="nama_paket">
                        <?= form_error('nama_paket', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="harga">Harga</label>
                        <input type="text" id="harga" class="form-control form-control-sm" placeholder="Masukkan Harga Paket" name="harga_paket">
                        <?= form_error('harga_paket', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="ni ni-fat-add"></i> Submit</button>
                        <button type="reset" class="btn btn-outline-secondary btn-sm"><i class="ni ni-fat-remove"></i> Cancel</button>
                    </div>
                </form>
            </div>
          </div>
        </div>
        <div class="col-xl-5">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">List Paket</h3>
                  <?= $this->session->userdata('message'); ?>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Nama Paket</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
				<?php foreach($paket as $p) :?>
                  <tr>
                    <th scope="row"><?= $p['nama_paket']; ?></th>
                    <td><?= $p['harga']; ?></td>
                    <td>
                        <a href="<?= base_url('admin/edit_paket/'). $p['id_paket']; ?>" class="badge badge-pill badge-primary"><i class="fas fa-edit"></i> Edit</a>
                        <a href="<?= base_url('admin/hapus_paket/'). $p['id_paket']; ?>" onclick="return confirm('Yakin ingin menghapus?')" class="badge badge-pill badge-secondary"><i class="fas fa-trash"></i> Hapus</a>
                    </td>
                  </tr>
				<?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>