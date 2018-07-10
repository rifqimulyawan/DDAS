<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function reg() {

		$data = array('nim' => $this->input->post('nim'),
		              'nama'=> $this->input->post('nama'),
		              'email'=> $this->input->post('email'),
		              'password'=>get_hash($this->input->post('password')),
		              'id_prodi'=> $this->input->post('id_prodi')
		             );

	    return $this->db->insert('user',$data);
	}

	public function check_db() {

		return $this->db->get_where('user',array('email' => $this->input->post('email')));
	}

    public function check_pass() {

        $id = $this->session->userdata('is_id');
        return $this->db->get_where('user', array('id_user' => $id));
    }

	public function edt() {

		return $this->db->update('user',$data);
	}

	function get_user_data() {
		
        $id = $this->session->userdata('is_id');
        $this->db->join('prodi','prodi.id_prodi=user.id_prodi');

        $returnresults = $this->db->get_where('user', array('id_user' => $id));
        if ($returnresults->num_rows() > 0)
        $row = $returnresults->row();

        $data = array (
                'id_user' => $row->id_user,
                'nim' => $row->nim,
                'nama'=> $row->nama,
                'email'=> $row->email,
                'password'=> $row->password,
                'foto_profil'=> $row->foto_profil,
                'id_prodi'=> $row->id_prodi,
                'nama_prodi'=> $row->nama_prodi,
                'level'=> $row->level
                );

        return $data;
    }

}

/* End of file M_user.php */
/* Location: ./application/models/M_user.php */
