<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Register extends CI_Controller {

    public function __construct(){

        parent::__construct();
       $this->load->library('form_validation');
      $this->load->library('encrypt');
      $this->load->model('Register_model', 'test');
      

      
    }

    function index()
    {
        $this->load->view('register');
    }

    function validation(){
        // $this->form_validation->set_rules('user_name', 'Name', 'require|trim');
         $this->form_validation->set_rules('user_name', 'name', 'required',
         array('required' => 'You must provide a %s.')
 );
        // $this->form_validation->set_rules('user_email', 'Email Address', 'require|trim|valid_email|is_unique[codeigniter_register.email]');
        $this->form_validation->set_rules('user_email', 'email', 'required|valid_email',
        array('required' => 'You must provide a %s.','valid_email' => 'You must provide a %s.')
);
        $this->form_validation->set_rules('user_password','Password', 'required');
        if($this->form_validation->run()){

            $verification_key = md5(rand());
            $encrypted_password = $this->encrypt->encode($this->input->post('user_password'));
            $data =array(
                'name' => $this->input->post('user_name'),
                'email' => $this->input->post('user_email'),
                'password' => $encrypted_password,
                'verification_key' => $verification_key
            );
            $id = $this->test->insert($data);
            if($id > 0)
            {
                $subject ="Please verify email for login";
                $message ="
                <p> HI ".$this->input->post('user_name')." </p>
                <p> This is  email verification mail from Codeigniter Login Register system. For complete registration process and login into system. First you want to verify you email by click this <a href='".base_url()."register/verify_email/".$verification_key."'>link</a>.</p>
                <p>One you click this link your email will be verified and you can login into system.</p>
                <p>Thanks,</p>
                ";
                $config = array(
                    'protocol'  => 'smtp',
                    'smtp_host' => 'smtpout.secureserver.net',
                    'smtp_port' => 80,
                    'smtp_user' =>'xxxxxx',
                    'smtp_pass' => 'xxxxxx',
                    'mailtype'  => 'html',
                    'charset'    =>'iso-8859-1',
                    'wordwarp' => TRUE
                );
                $this->load->library('email', $config);
                $this->email->set_newline("\r\n");
                $this->emall->from('eduardo.ed37@gmail.com');
                $this->email->to($this->input->post('user_email'));
                $this->email->subject($subject);
                $this->email->message($message);
                if($this->email->send()){
                    $this->session->set_flashdata(
                        'message', 'check in your email for email
                        verification mail
                        ');
                        redirect('register');
                  
                }
            }
        }
        else{
            $this->index();
        }
        }
}

?>