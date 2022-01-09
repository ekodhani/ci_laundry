  <!-- Main content -->
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
			<button type="button" class="btn btn-neutral">
				<span class="badge badge-primary"><i class="fas fa-home"></i></span>
				<span>Dashboard</span>
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
        <div class="col-xl-8">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Data Laundry</h3>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Nama Konsumen</th>
                    <th scope="col">Berat</th>
                    <th scope="col">Status</th>
                    <th scope="col">Bayar</th>
                  </tr>
                </thead>
                <tbody>
				<?php foreach ( $laundry as $l ){ ?>
                  <tr>
                    <th scope="row"><?= $l['nama_konsumen']; ?></th>
					<td><?= $l['berat']; ?> kg</td>
					<td><?= $l['status']; ?></td>
                    <td><?= $l['bayar']; ?></td>
                  </tr>
				  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-xl-4">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Data Paket</h3>
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
                  </tr>
                </thead>
                <tbody>
				<?php foreach($paket as $p) :?>
                  <tr>
                    <th scope="row"><?= $p['nama_paket']; ?></th>
                    <td><?= $p['harga']; ?></td>
                  </tr>
				<?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>