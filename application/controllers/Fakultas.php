<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fakultas extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Fakultas_model');
        $this->load->library('form_validation');

        if ($this->session->userdata('is_login')==FALSE) redirect('user/index','refresh');

    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'fakultas/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'fakultas/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'fakultas/index.html';
            $config['first_url'] = base_url() . 'fakultas/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Fakultas_model->total_rows($q);
        $fakultas = $this->Fakultas_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data_user = $this->Fakultas_model->get_user_data();

        $data = array(
            'fakultas_data' => $fakultas,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('fakultas/fakultas_list', $data+$data_user);
    }

    public function read($id) 
    {
        $data_user = $this->Fakultas_model->get_user_data();

        $row = $this->Fakultas_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_fakultas' => $row->id_fakultas,
		'nama_fakultas' => $row->nama_fakultas,
	    );
            $this->load->view('fakultas/fakultas_read', $data+$data_user);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('fakultas'));
        }
    }

    public function create() 
    {
        $data_user = $this->Fakultas_model->get_user_data();

        $data = array(
            'button' => 'Add <span class="fa fa-plus-circle"></span>',
            'action' => site_url('fakultas/create_action'),
	    'id_fakultas' => set_value('id_fakultas'),
	    'nama_fakultas' => set_value('nama_fakultas'),
	);
        $this->load->view('fakultas/fakultas_form', $data+$data_user);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_fakultas' => $this->input->post('nama_fakultas',TRUE),
	    );

            $this->Fakultas_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('fakultas'));
        }
    }
    
    public function update($id) 
    {
        $data_user = $this->Fakultas_model->get_user_data();

        $row = $this->Fakultas_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('fakultas/update_action'),
		'id_fakultas' => set_value('id_fakultas', $row->id_fakultas),
		'nama_fakultas' => set_value('nama_fakultas', $row->nama_fakultas),
	    );
            $this->load->view('fakultas/fakultas_form', $data+$data_user);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('fakultas'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_fakultas', TRUE));
        } else {
            $data = array(
		'nama_fakultas' => $this->input->post('nama_fakultas',TRUE),
	    );

            $this->Fakultas_model->update($this->input->post('id_fakultas', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('fakultas'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Fakultas_model->get_by_id($id);

        if ($row) {
            $this->Fakultas_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('fakultas'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('fakultas'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_fakultas', 'nama fakultas', 'trim|required');

	$this->form_validation->set_rules('id_fakultas', 'id_fakultas', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "fakultas.xls";
        $judul = "fakultas";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Fakultas");

	foreach ($this->Fakultas_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_fakultas);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=fakultas.doc");

        $data = array(
            'fakultas_data' => $this->Fakultas_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('fakultas/fakultas_doc',$data);
    }

}

/* End of file Fakultas.php */
/* Location: ./application/controllers/Fakultas.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-05-27 07:59:01 */
/* http://harviacode.com */