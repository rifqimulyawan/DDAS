<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Video extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Video_model');
        $this->load->library('form_validation');

        if ($this->session->userdata('is_login')==FALSE) redirect('','refresh');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'video/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'video/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'video/index.html';
            $config['first_url'] = base_url() . 'video/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Video_model->total_rows($q);
        $video = $this->Video_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data_user = $this->Video_model->get_user_data();

        $data = array(
            'video_data' => $video,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('video/u_video_list', $data+$data_user);
    }

    public function read($id) 
    {
        $data_user = $this->Video_model->get_user_data();

        $row = $this->Video_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_video' => $row->id_video,
		'nama_video' => $row->nama_video,
		'video' => $row->video,
		'added' => $row->added,
		'updated' => $row->updated,
		'id_user' => $row->id_user,
	    );
            $this->load->view('video/u_video_read', $data+$data_user);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('video'));
        }
    }

    public function create() 
    {
        $data_user = $this->Video_model->get_user_data();

        $data = array(
            'button' => 'Add <span class="fa fa-plus-circle"></span>',
            'action' => site_url('video/create_action'),
	    'id_video' => set_value('id_video'),
	    'nama_video' => set_value('nama_video'),
	    'video' => set_value('video'),
	    'id_user' => $this->session->userdata('is_id')
	);
        $this->load->view('video/u_video_form', $data+$data_user);
    }
    
    public function create_action() 
    {
        $this->_rules();

        $data_user = $this->Video_model->get_user_data();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {

            $config['upload_path'] = 'uploads/';
            $config['allowed_types'] = 'mp4|3gp';
            $config['max_size']  = '0';
            $config['remove_space'] = TRUE;
            $this->upload->initialize($config);
          
            $this->load->library('upload', $config); // Load konfigurasi uploadnya
            if($this->upload->do_upload('video')) {

                $this->session->set_flashdata('message', 
                    '<div class="alert alert-success alert-dismissible" role="success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>Berhasil Disimpan
                  </div>');

                $video = $this->upload->data('file_name');
                $data = array(
                'nama_video' => $this->input->post('nama_video',TRUE),
                'video' => $video,
                'id_user' => $this->input->post('id_user',TRUE)
                );

                $this->Video_model->insert($data);
                redirect(site_url('video'));

            } else {

                $this->session->set_flashdata('message', 
                    '<div class="alert alert-danger alert-dismissible" role="danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button> Gagal Disimpan, Mohon Periksa Kembali Ekstensi File !
                  </div>');
                redirect(site_url('video/create'));
            }
        }
    }
    
    public function update($id) 
    {
        $data_user = $this->Video_model->get_user_data();

        $row = $this->Video_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('video/update_action'),
		'id_video' => set_value('id_video', $row->id_video),
		'nama_video' => set_value('nama_video', $row->nama_video),
		'video' => set_value('video', $row->video),
		'id_user' => set_value('id_user', $row->id_user),
	    );
            $this->load->view('video/u_video_form', $data+$data_user);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('video'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {

            $config['upload_path'] = 'uploads/';
            $config['allowed_types'] = 'mp4|3gp';
            $config['max_size']  = '0';
            $config['remove_space'] = TRUE;
            $this->upload->initialize($config);
            $this->load->library('upload', $config); // Load konfigurasi uploadnya
            $upload = $this->upload->do_upload('video');

            if (empty($upload)) {

                $data = array(
                'nama_video' => $this->input->post('nama_video',TRUE),
                'id_user' => $this->input->post('id_user',TRUE)
                );

                $this->session->set_flashdata('message', 
                    '<div class="alert alert-success alert-dismissible" role="success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>Berhasil Diupdate
                  </div>');

                $this->Video_model->update($this->input->post('id_video', TRUE), $data);
                redirect(site_url('video'));

            } else if (!empty($upload)) {

                $video = $this->upload->data('file_name');
                $data = array(
                'nama_video' => $this->input->post('nama_video',TRUE),
                'video' => $video,
                'id_user' => $this->input->post('id_user',TRUE)
                );

                $this->session->set_flashdata('message', 
                    '<div class="alert alert-success alert-dismissible" role="success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>Berhasil Disimpan
                  </div>');

                $this->Video_model->update($this->input->post('id_video', TRUE), $data);
                redirect(site_url('video'));

            } else {

                $this->session->set_flashdata('message', 
                    '<div class="alert alert-danger alert-dismissible" role="danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button> Gagal Disimpan, Mohon Periksa Kembali Ekstensi File !
                  </div>');
                redirect(site_url('video'));

            }
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Video_model->get_by_id($id);

        if ($row) {
            $this->Video_model->delete($id);
            $this->session->set_flashdata('message', 
                    '<div class="alert alert-success alert-dismissible" role="success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>Berhasil Dihapus
                  </div>');
            redirect(site_url('video'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('video'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_video', 'nama video', 'trim|required');
	$this->form_validation->set_rules('id_user', 'id user', 'trim|required');

	$this->form_validation->set_rules('id_video', 'id_video', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "u_video.xls";
        $judul = "u_video";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Video");
	xlsWriteLabel($tablehead, $kolomhead++, "Video");
	xlsWriteLabel($tablehead, $kolomhead++, "Added");
	xlsWriteLabel($tablehead, $kolomhead++, "Updated");
	xlsWriteLabel($tablehead, $kolomhead++, "Id User");

	foreach ($this->Video_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_video);
	    xlsWriteLabel($tablebody, $kolombody++, $data->video);
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

/* End of file Video.php */
/* Location: ./application/controllers/Video.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-05-30 09:09:56 */
/* http://harviacode.com */