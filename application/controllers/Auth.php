<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
  Ten, kau kapan gendutnya
  buruan gendut, ntar bulan puasa malah makin kurus
*/

class Auth extends CI_Controller
{

  public function index()
  {
    $this->form_validation->set_rules('nim', 'NIM', 'required|trim|max_length[10]|numeric', [
      'required' => 'NIM harus diisi',
      'max_length' => 'NIM maksimal hanya 10 digit',
      'numeric' => 'NIM harus diisi angka'
    ]);

    $this->form_validation->set_rules('sandi', 'Password', 'required|trim|min_length[5]|max_length[12]', [
      'required' => 'Kata sandi harus diisi',
      'min_length' => 'Kata sandi minimal harus diisi 5 karakter',
      'max_length' => 'Kata sandi hanya boleh maksimal 12 digit'
    ]);

    if ($this->form_validation->run() == false) {
      $data['judul'] = "Postes Feny - Login";
      $this->load->view('templates/header_auth', $data);
      $this->load->view('auth/login');
      $this->load->view('templates/footer_auth');
    } else {
      $this->_login();
    }
  }

  private function _login()
  {
    $nim = $this->input->post('nim');
    $password = $this->input->post('sandi');

    $user = $this->db->get_where('user', ['nim' => $nim])->row_array();

    if ($user) {
      if (password_verify($password, $user['sandi'])) {
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Berhasil login!</div>');
      } else {
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Kata sandi anda salah, silahkan periksa kembali!</div>');
      }
    }


    redirect('auth');
  }

  public function registration()
  {
    $this->form_validation->set_rules('nim', 'NIM', 'required|trim|max_length[10]|numeric', [
      'required' => 'NIM harus diisi',
      'max_length' => 'NIM maksimal hanya 10 digit',
      'numeric' => 'NIM harus diisi angka'
    ]);

    $this->form_validation->set_rules('sandi1', 'Password', 'required|trim|min_length[5]|max_length[12]|matches[sandi2]', [
      'required' => 'Kata sandi harus diisi',
      'min_length' => 'Kata sandi minimal harus diisi 5 karakter',
      'max_length' => 'Kata sandi hanya boleh maksimal 12 digit',
      'matches' => 'Kata sandi tidak cocok'
    ]);

    $this->form_validation->set_rules('sandi2', 'Password', 'required|trim|min_length[5]|max_length[12]|matches[sandi1]');

    if ($this->form_validation->run() == false) {
      $data['judul'] = "Postes Feny - Register";
      $this->load->view('templates/header_auth', $data);
      $this->load->view('auth/register');
      $this->load->view('templates/footer_auth');
    } else {
      // logika registrasi
      $value = [
        "nim" => htmlspecialchars($this->input->post('nim'), true),
        "sandi" => password_hash($this->input->post('sandi1'), PASSWORD_DEFAULT),
        "date_created" => time()
      ];

      $this->db->insert('user', $value);
      $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Selamat akun anda telah dibuat, silahkan masuk! </div>');
      redirect('auth');
    }
  }
}
