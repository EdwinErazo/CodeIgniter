<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Login extends CI_Controller {

    public function __construct(){

        parent::__construct();
       $this->load->library('form_validation');
      $this->load->library('encrypt');
        $this->load->model('login_model');
      

      
    }
    function index()
    {
        $this->load->view('login');

    }
    function validation(){

        $this->form_validation->set_rules('user_email', 'email', 'required|valid_email',
        array('required' => 'You must provide a %s.','valid_email' => 'You must provide a %s.') );

        $this->form_validation->set_rules('user_password','Password', 'required',
        array('required' => 'You must provide a %s.'));
  
        if($this->form_validation->run()){

            $result = $this->login_model->can_login($this->input->post('user_email'), $this->input->post('user_password'));
             if($result == ''){
                 redirect('private_area');
             }
             else{
                 $this->session->set_flashdata('message',$result);
                 redirect('login');
             }
        }
        else{
            $this->index();
        }
    }
}

?>