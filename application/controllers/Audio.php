<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Audio extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Audio_model');
        $this->load->library('form_validation');

        if ($this->session->userdata('is_login')==FALSE) redirect('','refresh');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'audio/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'audio/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'audio/index.html';
            $config['first_url'] = base_url() . 'audio/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Audio_model->total_rows($q);
        $audio = $this->Audio_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data_user = $this->Audio_model->get_user_data();

        $data = array(
            'audio_data' => $audio,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('audio/u_audio_list', $data+$data_user);
    }

    public function read($id) 
    {
        $data_user = $this->Audio_model->get_user_data();

        $row = $this->Audio_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_audio' => $row->id_audio,
		'nama_audio' => $row->nama_audio,
		'audio' => $row->audio,
		'added' => $row->added,
		'updated' => $row->updated,
		'id_user' => $row->id_user,
	    );
            $this->load->view('audio/u_audio_read', $data+$data_user);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('audio'));
        }
    }

    public function create() 
    {
        $data_user = $this->Audio_model->get_user_data();

        $data = array(
            'button' => 'Add <span class="fa fa-plus-circle"></span>',
            'action' => site_url('audio/create_action'),
	    'id_audio' => set_value('id_audio'),
	    'nama_audio' => set_value('nama_audio'),
	    'audio' => set_value('audio'),
	    'id_user' => $this->session->userdata('is_id')
	);
        $this->load->view('audio/u_audio_form', $data+$data_user);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {

            $config['upload_path'] = 'uploads/';
            $config['allowed_types'] = 'mp3|wav';
            $config['max_size']  = '0';
            $config['remove_space'] = TRUE;
            $this->upload->initialize($config);
          
            $this->load->library('upload', $config); // Load konfigurasi uploadnya
            if($this->upload->do_upload('audio')) {

                $this->session->set_flashdata('message', 
                    '<div class="alert alert-success alert-dismissible" role="success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>Berhasil Disimpan
                  </div>');

                $audio = $this->upload->data('file_name');
                $data = array(
                'nama_audio' => $this->input->post('nama_audio',TRUE),
                'audio' => $audio,
                'id_user' => $this->input->post('id_user',TRUE)
                );

                $this->Audio_model->insert($data);
                redirect(site_url('audio'));

            } else {

                $this->session->set_flashdata('message', 
                    '<div class="alert alert-danger alert-dismissible" role="danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button> Gagal Disimpan, Mohon Periksa Kembali Ekstensi File !
                  </div>');
                redirect(site_url('audio/create'));
            }
        }
    }
    
    public function update($id) 
    {
        $data_user = $this->Audio_model->get_user_data();

        $row = $this->Audio_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('audio/update_action'),
		'id_audio' => set_value('id_audio', $row->id_audio),
		'nama_audio' => set_value('nama_audio', $row->nama_audio),
		'audio' => set_value('audio', $row->audio),
		'id_user' => set_value('id_user', $row->id_user),
	    );
            $this->load->view('audio/u_audio_form', $data+$data_user);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('audio'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {

            $config['upload_path'] = 'uploads/';
            $config['allowed_types'] = 'mp3|wav';
            $config['max_size']  = '0';
            $config['remove_space'] = TRUE;
            $this->upload->initialize($config);
            $this->load->library('upload', $config); // Load konfigurasi uploadnya
            $upload = $this->upload->do_upload('audio');

            if (empty($upload)) {

                $data = array(
                'nama_audio' => $this->input->post('nama_audio',TRUE),
                'id_user' => $this->input->post('id_user',TRUE)
                );

                $this->session->set_flashdata('message', 
                    '<div class="alert alert-success alert-dismissible" role="success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>Berhasil Diupdate
                  </div>');

                $this->Audio_model->update($this->input->post('id_audio', TRUE), $data);
                redirect(site_url('audio'));

            } else if (!empty($upload)) {

                $audio = $this->upload->data('file_name');
                $data = array(
                'nama_audio' => $this->input->post('nama_audio',TRUE),
                'audio' => $audio,
                'id_user' => $this->input->post('id_user',TRUE)
                );

                $this->session->set_flashdata('message', 
                    '<div class="alert alert-success alert-dismissible" role="success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>Berhasil Disimpan
                  </div>');

                $this->Audio_model->update($this->input->post('id_audio', TRUE), $data);
                redirect(site_url('audio'));

            } else {

                $this->session->set_flashdata('message', 
                    '<div class="alert alert-danger alert-dismissible" role="danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button> Gagal Disimpan, Mohon Periksa Kembali Ekstensi File !
                  </div>');
                redirect(site_url('audio'));

            }
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Audio_model->get_by_id($id);

        if ($row) {
            $this->Audio_model->delete($id);
            $this->session->set_flashdata('message', 
                    '<div class="alert alert-success alert-dismissible" role="success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>Berhasil Dihapus
                  </div>');
            redirect(site_url('audio'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('audio'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_audio', 'nama audio', 'trim|required');
	$this->form_validation->set_rules('id_user', 'id user', 'trim|required');

	$this->form_validation->set_rules('id_audio', 'id_audio', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "u_audio.xls";
        $judul = "u_audio";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Audio");
	xlsWriteLabel($tablehead, $kolomhead++, "Audio");
	xlsWriteLabel($tablehead, $kolomhead++, "Added");
	xlsWriteLabel($tablehead, $kolomhead++, "Updated");
	xlsWriteLabel($tablehead, $kolomhead++, "Id User");

	foreach ($this->Audio_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_audio);
	    xlsWriteLabel($tablebody, $kolombody++, $data->audio);
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

/* End of file Audio.php */
/* Location: ./application/controllers/Audio.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-05-30 10:04:09 */
/* http://harviacode.com */