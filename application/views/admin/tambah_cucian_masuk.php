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
          </div>
        </div>
      </div>
    </div>
		<!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header border-0">
                <h3 class="mb-0">Form Tambah Cucian Masuk</h3>
            </div>
							<!-- form -->
							<div class="card-body">
								<form action="" method="post">
									<div class="form-group">
                    <label class="form-control-label" for="nama-konsumen">Nama Lengkap</label>
                    <input type="text" id="nama-konsumen" class="form-control form-control-alternative" placeholder="Masukkan Nama Lengkap" name="nama_konsumen">
                    <?= form_error('nama_konsumen', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
									<div class="form-group">
                    <label class="form-control-label" for="berat">Berat Kiloan</label>
                    <input type="numeric" id="berat" class="form-control form-control-alternative" placeholder="Masukkan Berat Kiloan" name="berat">
                    <?= form_error('berat', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
									<div class="form-group">
										<label for="listPaket">Pilih Paket</label>
										<select class="form-control" id="listPaket" name="paket">
											<?php foreach($paket as $p) : ?>
												<option value="<?= $p['id_paket']; ?>"><?= $p['nama_paket']; ?> - <?= $p['harga']; ?></option>
											<?php endforeach ?>
										</select>
									</div>

									<div class="form-group">
										<button type="submit" class="btn btn-primary">Submit</button>
										<a href="<?= base_url('admin/cucian_masuk'); ?>" onclick="return confirm('Apakah anda yakin untuk membatalkan tambah cucian masuk ?')" class="btn btn-secondary">Back</a>
									</div>
								</form>
							</div>
						</div>
        </div>
      </div>