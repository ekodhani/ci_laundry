<!-- Header -->
<div class="header pb-6 d-flex align-items-center" style="min-height: 500px; background-image: url(../assets/img/theme/profile-cover.jpg); background-size: cover; background-position: center top;">
      <!-- Mask -->
      <span class="mask bg-gradient-default opacity-8"></span>
      <!-- Header container -->
      <div class="container-fluid d-flex align-items-center">
        <div class="row">
          <div class="col-lg-7 col-md-10">
            <h1 class="display-2 text-white">Hello <?= $user['nama_usr']; ?></h1>
            <p class="text-white mt-0 mb-5">This is your profile page. You can see the progress you've made with your work and manage your projects or assigned tasks</p>
            <?= $this->session->userdata('message')?>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col-xl-4 order-xl-2">
          <div class="card card-profile">
            <img src="../assets/img/theme/img-1-1000x600.jpg" alt="Image placeholder" class="card-img-top">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a href="#">
                    <img src="<?= base_url('assets/img/brand/') . $user['foto']; ?>" class="rounded-circle" width="150">
                  </a>
                </div>
              </div>
            </div>
            <!-- <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
              <div class="d-flex justify-content-between">
                <a href="#" class="btn btn-sm btn-info  mr-4 ">Connect</a>
                <a href="#" class="btn btn-sm btn-default float-right">Message</a>
              </div>
            </div> -->
            <div class="card-body pt-5">
              <!-- <div class="row">
                <div class="col">
                  <div class="card-profile-stats d-flex justify-content-center">
                    <div>
                      <span class="heading">22</span>
                      <span class="description">Friends</span>
                    </div>
                    <div>
                      <span class="heading">10</span>
                      <span class="description">Photos</span>
                    </div>
                    <div>
                      <span class="heading">89</span>
                      <span class="description">Comments</span>
                    </div>
                  </div>
                </div>
              </div> -->
              <div class="text-center pt-8 pt-md-4 pb-0 pb-md-4">
                <h5 class="h3">
                  <?= $user['nama_usr']; ?>
                </h5>
                <div class="h5 font-weight-300">
                  <i class="ni location_pin mr-2"></i><?= $user['alamat']; ?>
                </div>
                <div class="h5 mt-3">
                  <i class="ni business_briefcase-24 mr-2"></i><?= $user['level']; ?>
                </div>
                <div>
                  <i class="ni education_hat mr-2"></i>University of <?= $user['universitas']; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Edit profile </h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form action="" method="post" enctype="multipart/form-data">
                <h6 class="heading-small text-muted mb-4">User information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-name">Name</label>
                        <input type="text" id="input-name" class="form-control form-control-alternative" placeholder="Name" value="<?= $user['nama_usr']?>" name="nama">
                        <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="universitas">University of</label>
                        <input type="text" id="universitas" class="form-control form-control-alternative" placeholder="University of" value="<?= $user['universitas']; ?>" name="universitas">
                        <?= form_error('univeritas', '<small class="text-danger pl-3">', '</small>'); ?>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="password">Password</label>
                        <input type="password" id="password" class="form-control form-control-alternative" placeholder="Password" name="password">
                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="password-confirm">Password Confirm</label>
                        <input type="password" id="password-confirm" class="form-control form-control-alternative" placeholder="Password Confirm" name="password_confirm">
                        <?= form_error('password_confirm', '<small class="text-danger pl-3">', '</small>'); ?>
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Contact information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-address">Address</label>
                        <input type="text" id="input-address" class="form-control form-control-alternative" placeholder="Home Address" value="<?= $user['alamat']; ?>" name="alamat">
                        <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
                <!-- file upload -->
                <h6 class="heading-small text-muted mb-4">Upload Picture Profile</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFileLang" lang="en" name="foto">
                        <label class="custom-file-label" for="customFileLang">Select file</label>
                        <?= form_error('foto', '<small class="text-danger pl-3">', '</small>'); ?>
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
                <button type="submit" class="btn btn-primary">Save</button>
              </form>
            </div>
          </div>
        </div>
      </div>
