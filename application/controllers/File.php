<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class File extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('File_model');
        $this->load->library('form_validation');

        if ($this->session->userdata('is_login')==FALSE) redirect('','refresh');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'file/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'file/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'file/index.html';
            $config['first_url'] = base_url() . 'file/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->File_model->total_rows($q);
        $file = $this->File_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data_user = $this->File_model->get_user_data();

        $data = array(
            'file_data' => $file,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('file/u_file_list', $data+$data_user);
    }

    public function read($id) 
    {
        $data_user = $this->File_model->get_user_data();

        $row = $this->File_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_file' => $row->id_file,
		'nama_file' => $row->nama_file,
		'file' => $row->file,
		'added' => $row->added,
		'updated' => $row->updated,
		'id_user' => $row->id_user,
	    );
            $this->load->view('file/u_file_read', $data+$data_user);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('file'));
        }
    }

    public function create() 
    {
        $data_user = $this->File_model->get_user_data();

        $config['upload_path'] = 'uploads/';
        $config['allowed_types'] = 'pdf|docx|xlsx';
        $config['max_size']  = '2048';
        $config['remove_space'] = TRUE;
        $this->upload->initialize($config);
      
        $this->load->library('upload', $config); // Load konfigurasi uploadnya
        $this->upload->do_upload('file');
        $file = $this->upload->data();
        $file_upload = $file['file_name'];

        $data = array(
            'button' => 'Add <span class="fa fa-plus-circle"></span>',
            'action' => site_url('file/create_action'),
	    'id_file' => set_value('id_file'),
	    'nama_file' => set_value('nama_file'),
	    'file' => set_value($file_upload),
	    'id_user' => $this->session->userdata('is_id')
	);
        $this->load->view('file/u_file_form', $data+$data_user);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {

            $config['upload_path'] = 'uploads/';
            $config['allowed_types'] = 'pdf|docx|xlsx';
            $config['max_size']  = '0';
            $config['remove_space'] = TRUE;
            $this->upload->initialize($config);
          
            $this->load->library('upload', $config); // Load konfigurasi uploadnya
            if($this->upload->do_upload('file')) {

                $this->session->set_flashdata('message', 
                    '<div class="alert alert-success alert-dismissible" role="success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>Berhasil Disimpan
                  </div>');

                $file = $this->upload->data('file_name');
                $data = array(
                'nama_file' => $this->input->post('nama_file',TRUE),
                'file' => $file,
                'id_user' => $this->input->post('id_user',TRUE)
                );

                $this->File_model->insert($data);
                redirect(site_url('file'));

            } else {

                $this->session->set_flashdata('message', 
                    '<div class="alert alert-danger alert-dismissible" role="danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button> Gagal Disimpan, Mohon Periksa Kembali Ekstensi File !
                  </div>');
                redirect(site_url('file/create'));
            }
        }
    }
    
    public function update($id) 
    {
        $data_user = $this->File_model->get_user_data();

        $row = $this->File_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('file/update_action'),
		'id_file' => set_value('id_file', $row->id_file),
		'nama_file' => set_value('nama_file', $row->nama_file),
		'file' => set_value('file', $row->file),
		'id_user' => set_value('id_user', $row->id_user)
	    );
            $this->load->view('file/u_file_form', $data+$data_user);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('file'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {

            $config['upload_path'] = 'uploads/';
            $config['allowed_types'] = 'pdf';
            $config['max_size']  = '0';
            $config['remove_space'] = TRUE;
            $this->upload->initialize($config);
            $this->load->library('upload', $config); // Load konfigurasi uploadnya
            $upload = $this->upload->do_upload('file');

            if (empty($upload)) {

                $data = array(
                'nama_file' => $this->input->post('nama_file',TRUE),
                'id_user' => $this->input->post('id_user',TRUE)
                );

                $this->session->set_flashdata('message', 
                    '<div class="alert alert-success alert-dismissible" role="success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>Berhasil Diupdate
                  </div>');

                $this->File_model->update($this->input->post('id_file', TRUE), $data);
                redirect(site_url('file'));

            } else if (!empty($upload)) {

                $file = $this->upload->data('file_name');
                $data = array(
                'nama_file' => $this->input->post('nama_file',TRUE),
                'file' => $file,
                'id_user' => $this->input->post('id_user',TRUE)
                );

                $this->session->set_flashdata('message', 
                    '<div class="alert alert-success alert-dismissible" role="success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>Berhasil Disimpan
                  </div>');

                $this->File_model->update($this->input->post('id_file', TRUE), $data);
                redirect(site_url('file'));

            } else {

                $this->session->set_flashdata('message', 
                    '<div class="alert alert-danger alert-dismissible" role="danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button> Gagal Disimpan, Mohon Periksa Kembali Ekstensi File !
                  </div>');
                redirect(site_url('file'));

            }
        }
    }
    
    public function delete($id) 
    {
        $row = $this->File_model->get_by_id($id);

        if ($row) {
            $this->File_model->delete($id);
            $this->session->set_flashdata('message', 
                    '<div class="alert alert-success alert-dismissible" role="success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>Berhasil Dihapus
                  </div>');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('file'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_file', 'nama file', 'trim|required');
	$this->form_validation->set_rules('id_user', 'id user', 'trim|required');

	$this->form_validation->set_rules('id_file', 'id_file', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "u_file.xls";
        $judul = "u_file";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama File");
	xlsWriteLabel($tablehead, $kolomhead++, "File");
	xlsWriteLabel($tablehead, $kolomhead++, "Added");
	xlsWriteLabel($tablehead, $kolomhead++, "Updated");
	xlsWriteLabel($tablehead, $kolomhead++, "Id User");

	foreach ($this->File_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_file);
	    xlsWriteLabel($tablebody, $kolombody++, $data->file);
	    xlsWriteLabel($tablebody, $kolombody++, $data->added);
	    xlsWriteLabel($tablebody, $kolombody++, $data->updated);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_user);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file File.php */
/* Location: ./application/controllers/File.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-05-30 10:20:55 */
/* http://harviacode.com */