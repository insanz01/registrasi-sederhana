<div class="container">

  <div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
      <!-- Nested Row within Card Body -->
      <div class="row">
        <div class="col-lg-7 mx-auto">
          <div class="p-5">
            <div class="text-center">
              <h1 class="h4 text-gray-900 mb-4">Buat akun baru!</h1>
            </div>
            <form class="user" action="<?= base_url('auth/registration'); ?>" method="post">
              <div class="form-group">
                <input type="text" class="form-control form-control-user" id="nim" name="nim" value="<?= set_value('nim'); ?>" placeholder="Masukan NIM">
                <?= form_error('nim', '<small class="text-danger pl-2">', '</small>'); ?>
              </div>
              <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <input type="password" class="form-control form-control-user" id="sandi1" name="sandi1" placeholder="Masukan Kata sandi">
                  <?= form_error('sandi1', '<small class="text-danger pl-2">', '</small>'); ?>
                </div>
                <div class="col-sm-6">
                  <input type="password" class="form-control form-control-user" id="sandi2" name="sandi2" placeholder="Ketik ulang Kata sandi">
                  <?= form_error('sandi2', '<small class="text-danger pl-2">', '</small>'); ?>
                </div>
              </div>
              <button type="submit" class="btn btn-primary btn-user btn-block">
                Buat akun
              </button>
            </form>
            <hr>
            <div class="text-center">
              <a class="small" href="#">Lupa Kata sandi?</a>
            </div>
            <div class="text-center">
              <a class="small" href="<?= base_url('auth'); ?>">Sudah punya akun? Login!</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>