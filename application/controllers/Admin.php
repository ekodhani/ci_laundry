<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_user');
        $this->load->model('M_laundry');
    }

    public function index()
    {
        $data['title'] = 'Selamat Datang '. $this->session->userdata('nama_usr');
        $data['user'] = $this->M_user->get_where(['username' => $this->session->userdata('username')], 'user')->row_array();
        $data['paket'] = $this->db->get('paket')->result_array();
        $data['laundry'] = $this->db->get('laundry')->result_array();
        $this->load->view('tamplate/sidebar', $data);
        $this->load->view('tamplate/navbar', $data);
        $this->load->view('admin/menu_utama', $data);
        $this->load->view('tamplate/footer');
    }

    public function paket()
    {
        $this->form_validation->set_rules('nama_paket', 'Nama Paket', 'trim|required',[
            'required' => 'Form nama harus di isi'
        ]);
		$this->form_validation->set_rules('harga_paket', 'Harga Paket', 'trim|required|numeric',[
            'required' => 'Form harga harus di isi',
            'numeric' => 'Masukkan harus berupa angka'
        ]);
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Paket Laundry';
            $data['user'] = $this->M_user->get_where(['username' => $this->session->userdata('username')], 'user')->row_array();
            $data['paket'] = $this->db->get('paket')->result_array();
            $this->load->view('tamplate/sidebar', $data);
            $this->load->view('tamplate/navbar', $data);
            $this->load->view('admin/paket', $data);
            $this->load->view('tamplate/footer');
        } else {
            #code

            $nama = $this->input->post('nama_paket');
            $harga = $this->input->post('harga_paket');

            $data = [
                'nama_paket' => $nama,
                'harga' => $harga
            ];

            $this->db->insert('paket', $data);
            redirect('admin/paket');
        }
    }

    public function edit_paket($id)
    {
        $this->form_validation->set_rules('nama_paket', 'Nama Paket', 'required|trim',[
            'required' => 'Form harus di isi'
        ]);
        $this->form_validation->set_rules('harga_paket', 'Harga Paket', 'required|trim|numeric',[
            'required' => 'Form harus di isi',
            'numeric' => 'Masukkan harus berupa angka'
        ]);
        
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Edit Paket';
            $data['user'] = $this->M_user->get_where(['username' => $this->session->userdata('username')], 'user')->row_array();
            $data['detail'] = $this->db->get_where('paket', ['id_paket' => $id])->row_array();
            $data['paket'] = $this->db->get('paket')->result_array();
            $this->load->view('tamplate/sidebar', $data);
            $this->load->view('tamplate/navbar', $data);
            $this->load->view('admin/edit_paket', $data);
            $this->load->view('tamplate/footer');
        } else {
            $id_paket = $id;
            $nama_paket = $this->input->post('nama_paket');
            $harga = $this->input->post('harga_paket');

            
            $this->db->set('harga', $harga);
            $this->db->set('nama_paket', $nama_paket);
            $this->db->where('id_paket', $id_paket);
            $this->db->update('paket');

            $this->session->set_flashdata('message', '<div class="alert alert-success">Data paket berhasil di edit!</div>');
            redirect('admin/paket');
        }
    }

    public function hapus_paket($id)
    {
        $where = ['id_paket' => $id];
        $this->db->where($where);
        $this->db->delete('paket');
        $this->session->set_flashdata('message', '<div class="alert alert-success mt-3" role="alert">Paket berhasil terhapus</div>');
        redirect('admin/paket');
    }

    public function cucian_masuk()
    {
        $data['title'] = 'Cucian Masuk';
        $data['user'] = $this->M_user->get_where(['username' => $this->session->userdata('username')], 'user')->row_array();        
        $data['laundry'] = $this->M_laundry->getCucianMasuk()->result();
        $this->load->view('tamplate/sidebar', $data);
        $this->load->view('tamplate/navbar', $data);
        $this->load->view('admin/cucian_masuk', $data);
        $this->load->view('tamplate/footer');
    }

    public function tambahCucianMasuk()
    {
        $this->form_validation->set_rules('nama_konsumen', 'Nama Konsumen', 'required|trim',[
            'required' => 'Form harus di isi'
        ]);
        $this->form_validation->set_rules('berat', 'Berat Kiloan', 'required|trim|numeric',[
            'required' => 'Form harus di isi',
            'numeric' => 'Masukkan harus berupa angka'
        ]);
        
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Tambah Cucian Masuk';
            $data['user'] = $this->M_user->get_where(['username' => $this->session->userdata('username')], 'user')->row_array();
            $data['paket'] = $this->db->get('paket')->result_array();
            $this->load->view('tamplate/sidebar', $data);
            $this->load->view('tamplate/navbar', $data);
            $this->load->view('admin/tambah_cucian_masuk', $data);
            $this->load->view('tamplate/footer');
        } else {
            $nama = $this->input->post('nama_konsumen');
            $berat = $this->input->post('berat');
            $paket = $this->input->post('paket');
            $hargaSatuan = $this->db->get_where('paket',['id_paket' => $paket])->row_array();
            $bayar = $hargaSatuan['harga'] * $berat;
            
            $data = [
                'nama_konsumen' => $nama,
                'berat' => $berat,
                'status' => 'masuk',
                'bayar' => $bayar,
                'tgl_masuk' => date('Y-m-d'),
                'paket_id_paket' => $paket
            ];

            $this->M_laundry->insert($data, 'laundry');
            $this->session->set_flashdata('message', '<div class="alert alert-success mt-3">Data cucian masuk berhasil di tambah!</div>');
            redirect('admin/cucian_masuk');
        }
    }

    public function editCucianMasuk($id)
    {
        $this->form_validation->set_rules('nama_konsumen', 'Nama Konsumen', 'required|trim',[
            'required' => 'Form harus di isi'
        ]);
        $this->form_validation->set_rules('berat', 'Berat Kiloan', 'required|trim|numeric',[
            'required' => 'Form harus di isi',
            'numeric' => 'Masukkan harus berupa angka'
        ]);
        
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Edit Cucian Masuk';
            $data['user'] = $this->M_user->get_where(['username' => $this->session->userdata('username')], 'user')->row_array();
            $data['laundry'] = $this->M_laundry->getWhere(['id_laundry' => $id], 'laundry')->row_array();
            $data['paket'] = $this->db->get('paket')->result_array();
            $this->load->view('tamplate/sidebar', $data);
            $this->load->view('tamplate/navbar', $data);
            $this->load->view('admin/edit_cucian_masuk', $data);
            $this->load->view('tamplate/footer');
        } else {
            $nama = $this->input->post('nama_konsumen');
            $berat = $this->input->post('berat');
            $paket = $this->input->post('paket');
            $hargaSatuan = $this->db->get_where('paket',['id_paket' => $paket])->row_array();
            $bayar = $hargaSatuan['harga'] * $berat;

            $this->db->set('nama_konsumen', $nama);
            $this->db->set('berat', $berat);
            $this->db->set('bayar', $bayar);
            $this->db->set('paket_id_paket', $paket);
            $this->db->where('id_laundry', $id);
            $this->db->update('laundry');
            $this->session->set_flashdata('message', '<div class="alert alert-success mt-3">Data cucian masuk berhasil di edit!</div>');
            redirect('admin/cucian_masuk');
        }
    }

    public function hapusCucianMasuk($id)
    {
        $where = ['id_laundry' => $id];
        $this->M_laundry->delete($where, 'laundry');
        $this->session->set_flashdata('message', '<div class="alert alert-success mt-3" role="alert"><i class="ni ni-check-bold"></i> Data Cucian masuk berhasil terhapus</div>');
        redirect('admin/cucian_masuk');
    }

    public function ambilCucian($id)
    {
        $data['ambil'] = $this->M_laundry->getWhere(['id_laundry' => $id], 'laundry')->row_array();
        $tgl_keluar = date('Y-m-d');

        $this->db->set('tgl_keluar', $tgl_keluar);
        $this->db->set('status', "keluar");
        $this->db->where('id_laundry', $id);
        $this->db->update('laundry');
        $this->session->set_flashdata('message', '<div class="alert alert-success mt-3" role="alert"><i class="ni ni-check-bold"></i> Cucian sukses di ambil <a href="'. base_url('admin/cucian_keluar').'">Lihat Disini</a></div>');
        redirect('admin/cucian_masuk');
    }

    public function cucian_keluar()
    {
        $data['title'] = 'Cucian Keluar';
        $data['user'] = $this->M_user->get_where(['username' => $this->session->userdata('username')], 'user')->row_array();        
        $data['laundry'] = $this->M_laundry->getCucianKeluar()->result();
        $this->load->view('tamplate/sidebar', $data);
        $this->load->view('tamplate/navbar', $data);
        $this->load->view('admin/cucian_keluar', $data);
        $this->load->view('tamplate/footer');
    }

    public function editCucianKeluar($id)
    {
        $this->form_validation->set_rules('nama_konsumen', 'Nama Konsumen', 'required|trim',[
            'required' => 'Form harus di isi'
        ]);
        $this->form_validation->set_rules('berat', 'Berat Kiloan', 'required|trim|numeric',[
            'required' => 'Form harus di isi',
            'numeric' => 'Masukkan harus berupa angka'
        ]);
        
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Edit Cucian Masuk';
            $data['user'] = $this->M_user->get_where(['username' => $this->session->userdata('username')], 'user')->row_array();
            $data['laundry'] = $this->M_laundry->getWhere(['id_laundry' => $id], 'laundry')->row_array();
            $data['paket'] = $this->db->get('paket')->result_array();
            $this->load->view('tamplate/sidebar', $data);
            $this->load->view('tamplate/navbar', $data);
            $this->load->view('admin/edit_cucian_keluar', $data);
            $this->load->view('tamplate/footer');
        } else {
            $nama = $this->input->post('nama_konsumen');
            $berat = $this->input->post('berat');
            $paket = $this->input->post('paket');
            $hargaSatuan = $this->db->get_where('paket',['id_paket' => $paket])->row_array();
            $bayar = $hargaSatuan['harga'] * $berat;
            $tgl_masuk = $this->input->post('tgl_masuk');
            $tgl_keluar = $this->input->post('tgl_keluar');
            
            $this->db->set('nama_konsumen', $nama);
            $this->db->set('berat', $berat);
            $this->db->set('bayar', $bayar);
            $this->db->set('tgl_masuk', $tgl_masuk);
            $this->db->set('tgl_keluar', $tgl_keluar);
            $this->db->set('paket_id_paket', $paket);
            $this->db->where('id_laundry', $id);
            $this->db->update('laundry');
            $this->session->set_flashdata('message', '<div class="alert alert-success mt-3">Data cucian keluar berhasil di edit!</div>');
            redirect('admin/cucian_keluar');
        }
    }

    public function hapusCucianKeluar($id)
    {
        $where = ['id_laundry' => $id];
        $this->M_laundry->delete($where, 'laundry');
        $this->session->set_flashdata('message', '<div class="alert alert-success mt-3" role="alert"><i class="ni ni-check-bold"></i> Data Cucian keluar berhasil terhapus</div>');
        redirect('admin/cucian_keluar');
    }

    public function edit_profile()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim',[
            'required' => 'Form harus di isi',
        ]);
        $this->form_validation->set_rules('universitas', 'University of', 'required|trim',[
            'required' => 'Form harus di isi',
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim',[
            'required' => 'Form harus di isi',
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[5]',[
            'required' => 'Form harus di isi',
            'min_length' => 'Minimal 5 karakter'
        ]);
        $this->form_validation->set_rules('password_confirm', 'Password Confirm', 'required|trim|min_length[5]|matches[password]',[
            'required' => 'Form harus di isi',
            'min_length' => 'Minimal 5 karakter',
            'matches' => 'Password Confirm tidak cocok'
        ]);
        
        
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Edit Profile';
            $data['user'] = $this->M_user->get_where(['username' => $this->session->userdata('username')], 'user')->row_array();
            $this->load->view('tamplate/sidebar', $data);
            $this->load->view('tamplate/navbar_profile', $data);
            $this->load->view('admin/edit_profile', $data);
            $this->load->view('tamplate/footer');
        } else {
            $nama = $this->input->post('nama');
            $password = $this->input->post('password');
            $universitas = $this->input->post('universitas');
            $alamat = $this->input->post('alamat');

            // Apakah ada gambar ?
            $upload_image = $_FILES['foto']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size']      = '2048';
                $config['upload_path']   = './assets/img/brand/';

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('foto')) {
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('foto', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('nama_usr', $nama);
            $this->db->set('universitas', $universitas);
            $this->db->set('alamat', $alamat);
            $this->db->set('password', md5($password));
            $this->db->where('username', $this->session->userdata('username'));
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success">Profil berhasil di update!</div>');
            redirect('admin/edit_profile');
        }
    }

    public function masukExcel()
    {
        //code use third party phpexcel-1.8 blom di border style
        require(APPPATH. 'third_party/PHPExcel-1.8/Classes/PHPExcel.php');
        require(APPPATH. 'third_party/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

        $spreadsheet = new PHPExcel();

        $spreadsheet->getProperties()->setCreator("Wahidin Laundry");
        $spreadsheet->getProperties()->setLastModifiedBy("Wahidin Laundry");
        $spreadsheet->getProperties()->setTitle("Data Cucian Masuk");

        $spreadsheet->setActiveSheetIndex(0);

        $sheet = $spreadsheet->getActiveSheet();

         // set width
        $sheet->getColumnDimension('A')->setWidth(10);
        $sheet->getColumnDimension('B')->setWidth(30);
        $sheet->getColumnDimension('C')->setWidth(30);
        $sheet->getColumnDimension('D')->setWidth(30);
        $sheet->getColumnDimension('E')->setWidth(30);
        $sheet->getColumnDimension('F')->setWidth(30);

        // set cell value
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama Konsumen');
        $sheet->setCellValue('C1', 'Berat');
        $sheet->setCellValue('D1', 'Tanggal Masuk');
        $sheet->setCellValue('E1', 'Bayar');
        $sheet->setCellValue('F1', 'Paket');

        // give border header data
        $styleArray = [
            'font' => [
                'bold' => true,
            ],
            'borders' => [
                'allborders' => [
                    'style' => PHPExcel_Style_Border::BORDER_THICK
                ]
            ],
            'alignment' => [
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
            ]
        ];
        $sheet->getStyle('A1:F1')->applyFromArray($styleArray);

        $cucianMasuk = $this->M_laundry->getCucianMasuk()->result();
        $no = 1;
        $baris = 2;
        foreach($cucianMasuk as $row){
            $sheet->setCellValue('A'.$baris, $no++);
            $sheet->setCellValue('B'.$baris, $row->nama_konsumen);
            $sheet->setCellValue('C'.$baris, $row->berat);
            $sheet->setCellValue('D'.$baris, $row->tgl_masuk);
            $sheet->setCellValue('E'.$baris, $row->bayar);
            $sheet->setCellValue('F'.$baris, $row->nama_paket);

            $baris++;
        }

        // give border data
        $styleArrayData = [
            'borders' => [
                'allborders' => [
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                ]
            ],
            'alignment' => [
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
            ]
        ];
        $sheet->getStyle('A2:F'.($baris-1))->applyFromArray($styleArrayData);

        $filename = "Data Cucian Masuk".'.xlsx';
        $sheet->setTitle("Data Cucian Masuk");

        header('Content-Type: Application/vnd.opensmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename. '"');
        header('Cache-Control: max-age=0');

        $writer = PHPExcel_IOFactory::createwriter($spreadsheet, 'Excel2007');
        $writer->save('php://output');

        exit;
        //End code use third party phpexcel-1.8
    }

    public function keluarExcel()
    {
        //code use third party phpexcel-1.8 blom di border style
        require(APPPATH. 'third_party/PHPExcel-1.8/Classes/PHPExcel.php');
        require(APPPATH. 'third_party/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

        $spreadsheet = new PHPExcel();

        $spreadsheet->getProperties()->setCreator("Wahidin Laundry");
        $spreadsheet->getProperties()->setLastModifiedBy("Wahidin Laundry");
        $spreadsheet->getProperties()->setTitle("Data Cucian Keluar");

        $spreadsheet->setActiveSheetIndex(0);

        $sheet = $spreadsheet->getActiveSheet();

         // set width
        $sheet->getColumnDimension('A')->setWidth(10);
        $sheet->getColumnDimension('B')->setWidth(30);
        $sheet->getColumnDimension('C')->setWidth(30);
        $sheet->getColumnDimension('D')->setWidth(30);
        $sheet->getColumnDimension('E')->setWidth(30);
        $sheet->getColumnDimension('F')->setWidth(30);
        $sheet->getColumnDimension('G')->setWidth(30);

        // set cell value
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama Konsumen');
        $sheet->setCellValue('C1', 'Berat');
        $sheet->setCellValue('D1', 'Tanggal Masuk');
        $sheet->setCellValue('E1', 'Tanggal Keluar');
        $sheet->setCellValue('F1', 'Bayar');
        $sheet->setCellValue('G1', 'Paket');

        // give border header data
        $styleArray = [
            'font' => [
                'bold' => true,
            ],
            'borders' => [
                'allborders' => [
                    'style' => PHPExcel_Style_Border::BORDER_THICK
                ]
            ],
            'alignment' => [
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
            ]
        ];
        $sheet->getStyle('A1:G1')->applyFromArray($styleArray);

        $cucianKeluar = $this->M_laundry->getCucianKeluar()->result();
        $no = 1;
        $baris = 2;
        foreach($cucianKeluar as $row){
            $sheet->setCellValue('A'.$baris, $no++);
            $sheet->setCellValue('B'.$baris, $row->nama_konsumen);
            $sheet->setCellValue('C'.$baris, $row->berat);
            $sheet->setCellValue('D'.$baris, $row->tgl_masuk);
            $sheet->setCellValue('E'.$baris, $row->tgl_keluar);
            $sheet->setCellValue('F'.$baris, $row->bayar);
            $sheet->setCellValue('G'.$baris, $row->nama_paket);

            $baris++;
        }

        // give border data
        $styleArrayData = [
            'borders' => [
                'allborders' => [
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                ]
            ],
            'alignment' => [
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
            ]
        ];
        $sheet->getStyle('A2:G'.($baris-1))->applyFromArray($styleArrayData);

        $filename = "Data Cucian Keluar".'.xlsx';
        $sheet->setTitle("Data Cucian Keluar");

        header('Content-Type: Application/vnd.opensmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename. '"');
        header('Cache-Control: max-age=0');

        $writer = PHPExcel_IOFactory::createwriter($spreadsheet, 'Excel2007');
        $writer->save('php://output');

        exit;
        //End code use third party phpexcel-1.8
    }
}