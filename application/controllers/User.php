<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
    
        parent::__construct();
	    $this->load->model('User_model');

    } 

    public function index() {

        if ($this->session->userdata('is_login')==TRUE) {
        redirect('user/dashboard/','refresh');
        } else {
        $this->load->view('landing'); 
        }
    }

    public function login() {
        $this->load->view('landing');
    }

    public function blank() {

        $data = $this->User_model->get_user_data();
        $this->load->view('user/blank', $data);
    }

    public function register() {
        $this->load->view('register');
    }

    public function help() {
        $data = $this->User_model->get_user_data();
        $this->load->view('user/help', $data);
    }

    public function proses_daftar() {
        $this->form_validation->set_rules('nama', 'nama', 'trim|required|min_length[3]|max_length[35]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|max_length[35]|is_unique[user.email]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[30]');
       
                    if ($this->form_validation->run() == FALSE):
                        $this->load->view('register');
                      
                        else:

                        if ($this->User_model->reg()) {
                            $this->session->set_flashdata('sukses','Pendaftaran berhasil, silahkan login.');
                            redirect('user/index','refresh');
                        }

                        endif;
    }

    public function proses_login() {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|max_length[35]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[30]');
       
                    if ($this->form_validation->run() == FALSE):
                        $this->load->view('login');
                        
                        else:
                        
                        if ($this->User_model->check_db()->num_rows()==1) {// check email.....
                            $db=$this->User_model->check_db()->row();// verifikasi pass + hash......
                            
                            if (hash_verified($this->input->post('password'),$db->password)) {
                                // login berhasil buat session
                                $session = array ('is_login' => TRUE,
                                                  'is_id'=>$db->id_user,
                                                  'is_nim'=>$db->nim,
                                                  'is_nama'=>$db->nama,
                                                  'is_foto'=>$db->foto_profil,
                                                  'is_email'=>$db->email,
                                                  'is_level'=>$db->level
                                                 );

                                $this->session->set_userdata($session);
                                $this->session->set_flashdata('sukses_login','Hi, Selamat datang (*_*)');
                                    redirect('user/dashboard/','refresh');
                            } else {

                                $this->session->set_flashdata('pesan','Maaf Password Salah.');
                                redirect('user/login','refresh');
                              }

                        } else {
                                  
                              $this->session->set_flashdata('pesan',"Maaf E-mail tidak terdaftar.");
                              redirect('user/login','refresh');
                          }

                    endif;
    }

    public function dashboard() {
        
        $data = $this->User_model->get_user_data();
        $this->load->view('user/dashboard_user', $data); 

    }

    public function profile() {

        if ($this->session->userdata('is_login')!==TRUE) redirect('user/index/','refresh');

        $data = $this->User_model->get_user_data();

        $this->load->view('user/profile_user', $data);
    }

    public function edit_profile() {

        if ($this->session->userdata('is_login')==FALSE) {
          redirect('user/index/','refresh');
          } else {
              
              $data = $this->User_model->get_user_data();

                if ($this->form_validation->run() == FALSE)
                {
                    $this->load->view('user/profile_edit_user', $data);
                }
          }        
    }

    public function edit_password() {

        if ($this->session->userdata('is_login')==FALSE) {
          redirect('user/index/','refresh');
          } else {

              $data = $this->User_model->get_user_data();

              if ($this->form_validation->run() == FALSE)
                {
                    $this->load->view('user/password_edit_user', $data);
                }
          }        
    }

    public function edit_proses() {

        if ($this->session->userdata('is_login')!==TRUE) redirect('user/index/','refresh');

        $this->form_validation->set_rules('nim', 'Nim', 'trim|required|min_length[3]|max_length[35]');
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required|min_length[5]|max_length[30]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|max_length[35]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[30]');

        $config['upload_path'] = 'uploads/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size']  = '2048';
        $config['remove_space'] = TRUE;
        $this->upload->initialize($config);
      
        $this->load->library('upload', $config); // Load konfigurasi uploadnya
        $this->upload->do_upload('input_gambar');
        $file = $this->upload->data();
        $gambar = $file['file_name'];

        if (empty($gambar)) {
            $data = array(
                  'nim' => $this->input->post('nim'),
                  'nama'=> $this->input->post('nama'),
                  'email'=> $this->input->post('email'),
                  'id_prodi'=> $this->input->post('id_prodi')
                );
        } else {
            $data = array(
                  'nim' => $this->input->post('nim'),
                  'nama'=> $this->input->post('nama'),
                  'email'=> $this->input->post('email'),
                  'foto_profil'=> $gambar,
                  'id_prodi'=> $this->input->post('id_prodi')
                );
        }

        $id = $this->session->userdata('is_id');
        $this->db->where( 'id_user', $id);
        $this->db->update('user', $data);

        $this->session->set_flashdata('pesan','Data berhasil diperbarui');
        redirect('user/profile');

        // $this->session->set_flashdata('pesan','Data berhasil diperbarui');
        // redirect('page/perbarui','refresh');

    }

    public function edit_password_proses() {

        $db = $this->User_model->check_pass()->row();

        if (hash_verified($this->input->post('password'),$db->password)) {

            $data = array(
                  'password'=>get_hash($this->input->post('password_baru')),
                );

            $id = $this->session->userdata('is_id');
            $this->db->where( 'id_user', $id);
            $this->db->update('user', $data);

            $this->session->set_flashdata('pesan','Data berhasil diperbarui');
            redirect('user/profile');

        } else {

            $this->session->set_flashdata('pesan','Password Lama Salah');
            redirect('user/edit_password');
        }

        // $this->session->set_flashdata('pesan','Data berhasil diperbarui');
        // redirect('page/perbarui','refresh');

    }

    public function status() {

        if ($this->session->userdata('is_login')!==TRUE) redirect('user/index/','refresh');

        $data = $this->User_model->get_user_data();

        if($this->session->userdata('is_level')== 'user') {
           $this->load->view('user/status_user', $data); 

        } else if ($this->session->userdata('is_level')== 'Super_User' | 'Admin') {
              
              redirect('user','refresh', $data);

        } else {

              redirect('logout','refresh');
        }


    }

    public function bukti() {

        if ($this->session->userdata('is_login')!==TRUE) redirect('user/index/','refresh');

        $id = $this->session->userdata('is_id');
        $returnresults = $this->db->get_where('user', array('id_user' => $id));
        if ($returnresults->num_rows() > 0)
        $row = $returnresults->row();

        $data = array (
                'id_user' => $row->id_user,
                'nim' => $row->nim,
                'nama'=> $row->nama,
                'email'=> $row->email,
                'foto_profil'=>$row->foto_profil,
                'status'=> $row->status
                );

        if($this->session->userdata('is_level')== 'user') {
           $this->load->view('user/img_user', $data); 

        } else if ($this->session->userdata('is_level')== 'Super_User' | 'Admin') {
              
              redirect('user','refresh', $data);

        } else {

              redirect('logout','refresh');
        }


    }

}

/* End of file User.php */
/* Location: ./application/controllers/User.php */