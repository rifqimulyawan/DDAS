<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Note extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Note_model');
        $this->load->library('form_validation');

        if ($this->session->userdata('is_login')==FALSE) redirect('','refresh');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'note/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'note/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'note/index.html';
            $config['first_url'] = base_url() . 'note/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Note_model->total_rows($q);
        $note = $this->Note_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data_user = $this->Note_model->get_user_data();

        $data = array(
            'note_data' => $note,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('note/note_list', $data+$data_user);
    }

    public function read($id) 
    {
        $data_user = $this->Note_model->get_user_data();

        $row = $this->Note_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_note' => $row->id_note,
		'note' => $row->note,
		'date' => $row->date,
		'added' => $row->added,
		'updated' => $row->updated,
		'id_user' => $row->id_user,
	    );
            $this->load->view('note/note_read', $data+$data_user);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('note'));
        }
    }

    public function create() 
    {
        $data_user = $this->Note_model->get_user_data();

        $data = array(
            'button' => 'Add <span class="fa fa-plus-circle"></span>',
            'action' => site_url('note/create_action'),
	    'id_note' => set_value('id_note'),
	    'note' => set_value('note'),
	    'date' => set_value('date'),
	    'id_user' => $this->session->userdata('is_id')
	);
        $this->load->view('note/note_form', $data+$data_user);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'note' => $this->input->post('note',TRUE),
		'date' => $this->input->post('date',TRUE),
		'id_user' => $this->input->post('id_user',TRUE),
	    );

            $this->Note_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('note'));
        }
    }
    
    public function update($id) 
    {
        $data_user = $this->Note_model->get_user_data();

        $row = $this->Note_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('note/update_action'),
		'id_note' => set_value('id_note', $row->id_note),
		'note' => set_value('note', $row->note),
		'date' => set_value('date', $row->date),
		'added' => set_value('added', $row->added),
		'updated' => set_value('updated', $row->updated),
		'id_user' => set_value('id_user', $row->id_user),
	    );
            $this->load->view('note/note_form', $data+$data_user);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('note'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_note', TRUE));
        } else {
            $data = array(
		'note' => $this->input->post('note',TRUE),
		'date' => $this->input->post('date',TRUE),
		'added' => $this->input->post('added',TRUE),
		'updated' => $this->input->post('updated',TRUE),
		'id_user' => $this->input->post('id_user',TRUE),
	    );

            $this->Note_model->update($this->input->post('id_note', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('note'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Note_model->get_by_id($id);

        if ($row) {
            $this->Note_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('note'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('note'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('note', 'note', 'trim|required');
	$this->form_validation->set_rules('date', 'date', 'trim|required');
	$this->form_validation->set_rules('id_user', 'id user', 'trim|required');

	$this->form_validation->set_rules('id_note', 'id_note', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=note.doc");

        $data = array(
            'note_data' => $this->Note_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('note/note_doc',$data);
    }

}

/* End of file Note.php */
/* Location: ./application/controllers/Note.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-05-31 05:17:43 */
/* http://harviacode.com */