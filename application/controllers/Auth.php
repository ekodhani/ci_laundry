<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_user');
    }

    public function index()
	{
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Laundry Wahid';
		    $this->load->view('login_page', $data);
        } else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$user = $this->M_user->get_where(['username' => $username], 'user')->row_array();

			if ($user != null) { // jika usernya ada
				// cek password
				if (md5($password) == $user['password']) {
					$data = [
						'id_user' => $user['id_user'],
						'username' => $user['username'],
						'nama_usr' => $user['nama_usr'],
						'level' => $user['level']
					];

					$this->session->set_userdata($data);
					// cek level user
					if ($user['level'] == 'admin') {
						redirect('admin');
					}
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Salah!</div>');
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">User Tidak Ditemukan!</div>');
				redirect('auth');
			}
		}
	}

    public function logout()
    {
        $this->session->unset_userdata('username');
		$this->session->unset_userdata('level');

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Terima Kasih Sudah Login!</div>');
		redirect('auth');
    }
}