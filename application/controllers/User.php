<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

    class User extends CI_Controller {
        
        public function __construct() {
            parent::__construct();
            $this->load->model('User_model'); 
            $this->load->helper('url');
            $this->load->library('session');
        }    
        public function index() {
            $this->load->view("Auth/register.php");
        }

        public function register_user() {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('user_name', 'Name', 'required');
            $this->form_validation->set_rules('user_email', 'E-mail', 'required|valid_email');
            $this->form_validation->set_rules('user_password', 'Password', 'required|min_length[8]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/]');
            $this->form_validation->set_rules('user_age', 'Age', 'required|integer');
            $this->form_validation->set_rules('user_mobile', 'Mobile', 'required|numeric');

            if ($this->form_validation->run() == false) {
                $response = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
                echo json_encode($response);
                return;
            }

            $user_name = $this->input->post('user_name');
            $user_email = $this->input->post('user_email');
            $user_password = md5($this->input->post('user_password'));
            $user_age = $this->input->post('user_age');
            $user_mobile = $this->input->post('user_mobile');

            $user = array(
                'user_name' => $user_name,
                'user_email' => $user_email,
                'user_password' => $user_password,
                'user_age' => $user_age,
                'user_mobile' => $user_mobile
            );

            $email_check = $this->User_model->email_check($user_email);
            if ($email_check) {
                $user_login = $this->User_model->register_user($user);
                $response = array(
                    'status' => 'success',
                    'message' => 'Registered successfully. Now login to your account.'
                );
                echo json_encode($response);
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Email Id is already registered. Please login.'
                );
                echo json_encode($response);
            }
        }


        public function login_view(){

        $this->load->view("Auth/login.php");

        }

        public function login_user() {
            $user_login = array(
                'user_email' => $this->input->post('user_email'),
                'user_password' => md5($this->input->post('user_password'))
            );  
            
            $this->load->model('User_model');
            $user_data = $this->User_model->login_user($user_login);
            if ($user_data) {
                $this->session->set_userdata('user_id', $user_data['user_id']);
                $this->session->set_userdata('user_email', $user_data['user_email']);
                $this->session->set_flashdata('success_msg', 'Login successful!'); 
                $this->load->view('Auth/user_profile', array('user_data' => $user_data));
            } else {
                $this->session->set_flashdata('error_msg', 'Invalid username/email or password');
                redirect('user/login_view');
            }
        }

        function user_profile(){
            $this->load->view('Auth/user_profile.php');
        }
        public function user_logout() {
            $this->session->sess_destroy(); 
            redirect('user/login_view');
        }
    }
