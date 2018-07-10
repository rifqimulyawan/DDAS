<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gambar extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Gambar_model');
        $this->load->library('form_validation');

        if ($this->session->userdata('is_login')==FALSE) redirect('','refresh');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'gambar/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'gambar/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'gambar/index.html';
            $config['first_url'] = base_url() . 'gambar/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Gambar_model->total_rows($q);
        $gambar = $this->Gambar_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data_user = $this->Gambar_model->get_user_data();

        $data = array(
            'gambar_data' => $gambar,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start
        );
        $this->load->view('gambar/u_gambar_list', $data_user+$data);
    }

    public function read($id) 
    {
        $data_user = $this->Gambar_model->get_user_data();

        $row = $this->Gambar_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_gambar' => $row->id_gambar,
		'nama_gambar' => $row->nama_gambar,
		'gambar' => $row->gambar,
		'added' => $row->added,
		'updated' => $row->updated,
        'id_user' => $row->id_user
	    );
            $this->load->view('gambar/u_gambar_read', $data_user+$data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('gambar'));
        }
    }

    public function create() 
    {
        $data_user = $this->Gambar_model->get_user_data();

        $data = array(
            'button' => 'Add <span class="fa fa-plus-circle"></span>',
            'action' => site_url('gambar/create_action'),
        'id_gambar' => set_value('id_gambar'),
        'nama_gambar' => set_value('nama_gambar'),
        'gambar' => set_value('gambar'),
        'id_user' => $this->session->userdata('is_id')
    );
        $this->load->view('gambar/u_gambar_form', $data+$data_user);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {

            $config['upload_path'] = 'uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size']  = '0';
            $config['remove_space'] = TRUE;
            $this->upload->initialize($config);
          
            $this->load->library('upload', $config); // Load konfigurasi uploadnya
            if($this->upload->do_upload('gambar')) {

                $this->session->set_flashdata('message', 
                    '<div class="alert alert-success alert-dismissible" role="success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>Berhasil Disimpan
                  </div>');

                $gambar = $this->upload->data('file_name');
                $data = array(
                'nama_gambar' => $this->input->post('nama_gambar',TRUE),
                'gambar' => $gambar,
                'id_user' => $this->input->post('id_user',TRUE)
                );

                $this->Gambar_model->insert($data);
                redirect(site_url('gambar'));

            } else {

                $this->session->set_flashdata('message', 
                    '<div class="alert alert-danger alert-dismissible" role="danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button> Gagal Disimpan, Mohon Periksa Kembali Ekstensi File !
                  </div>');
                redirect(site_url('gambar/create'));
            }
        }
    }
    
    public function update($id) 
    {
        $data_user = $this->Gambar_model->get_user_data();

        $row = $this->Gambar_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('gambar/update_action'),
		'id_gambar' => set_value('id_gambar', $row->id_gambar),
		'nama_gambar' => set_value('nama_gambar', $row->nama_gambar),
		'gambar' => set_value('gambar', $row->gambar),
        'id_user' => $this->session->userdata('is_id')
	    );
            $this->load->view('gambar/u_gambar_form', $data+$data_user);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('gambar'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {

            $config['upload_path'] = 'uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size']  = '0';
            $config['remove_space'] = TRUE;
            $this->upload->initialize($config);
            $this->load->library('upload', $config); // Load konfigurasi uploadnya
            $upload = $this->upload->do_upload('gambar');

            if (empty($upload)) {

                $data = array(
                'nama_gambar' => $this->input->post('nama_gambar',TRUE),
                'id_user' => $this->input->post('id_user',TRUE)
                );

                $this->session->set_flashdata('message', 
                    '<div class="alert alert-success alert-dismissible" role="success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>Berhasil Diupdate
                  </div>');

                $this->Gambar_model->update($this->input->post('id_gambar', TRUE), $data);
                redirect(site_url('gambar'));

            } else if (!empty($upload)) {

                $gambar = $this->upload->data('file_name');
                $data = array(
                'nama_gambar' => $this->input->post('nama_gambar',TRUE),
                'gambar' => $gambar,
                'id_user' => $this->input->post('id_user',TRUE)
                );

                $this->session->set_flashdata('message', 
                    '<div class="alert alert-success alert-dismissible" role="success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>Berhasil Disimpan
                  </div>');

                $this->Gambar_model->update($this->input->post('id_gambar', TRUE), $data);
                redirect(site_url('gambar'));

            } else {

                $this->session->set_flashdata('message', 
                    '<div class="alert alert-danger alert-dismissible" role="danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button> Gagal Disimpan, Mohon Periksa Kembali Ekstensi File !
                  </div>');
                redirect(site_url('gambar'));

            }
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Gambar_model->get_by_id($id);

        if ($row) {
            $this->Gambar_model->delete($id);
            $this->session->set_flashdata('message', 
                    '<div class="alert alert-success alert-dismissible" role="success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>Berhasil Dihapus
                  </div>');
            redirect(site_url('gambar'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('gambar'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_gambar', 'nama gambar', 'required');

	$this->form_validation->set_rules('id_gambar', 'id_gambar', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "u_gambar.xls";
        $judul = "u_gambar";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Gambar");
	xlsWriteLabel($tablehead, $kolomhead++, "Gambar");
	xlsWriteLabel($tablehead, $kolomhead++, "Added");
	xlsWriteLabel($tablehead, $kolomhead++, "Updated");

	foreach ($this->Gambar_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_gambar);
	    xlsWriteLabel($tablebody, $kolombody++, $data->gambar);
	    xlsWriteLabel($tablebody, $kolombody++, $data->added);
	    xlsWriteLabel($tablebody, $kolombody++, $data->updated);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Gambar.php */
/* Location: ./application/controllers/Gambar.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-05-29 13:57:02 */
/* http://harviacode.com */