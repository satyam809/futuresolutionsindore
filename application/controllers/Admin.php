<?php
class Admin extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        // if (strlen($_SESSION['username']) == 0) {
        //     $this->load->view('login.php');
        // }
        $this->load->model('data_model');
    }

    public function index()
    {
        $this->load->view('login.php');
        //$this->load->view('index.php');
    }


    public function home()
    {

        $this->load->view('home.php');
    }

    public function check_login()
    {
        $data['username'] = htmlspecialchars($_POST['username']);
        $data['password'] = md5(htmlspecialchars($_POST['password']));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run()) {
            $res = $this->data_model->islogin($data);
            //echo "<pre>", print_r($res), "</pre>";
            if ($res == 1) {
                $this->session->set_userdata('username', $data['username']);
                $array= array(
                    'success' => 'admin/home'
                );
                echo json_encode($array);
            }
            else{
                $array=array(
                    'message' => 'Username or Password is incorrectl'
                );
                 echo json_encode($array);
            }
            
        } 
        else {
            $array = array(
                'error'   => true,
                'username_error' => form_error('username'),
                'password_error' => form_error('password')
            );
            echo json_encode($array);
        } 

    }

    public function logout()
    {
        if (session_unset()) {
            echo json_encode(array('message' => '', 'status' => true));
        }
    }
}
