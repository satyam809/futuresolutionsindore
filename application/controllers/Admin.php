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

    public function home(){
        $this->load->view('home.php');
    }

    public function check_login()
    {
        $data['username'] = htmlspecialchars($_POST['username']);
        $data['password'] = md5(htmlspecialchars($_POST['password']));
        $res = $this->data_model->islogin($data);
        //echo $res;
        if ($res == 1) {
            $this->session->set_userdata('username', $data['username']);
            echo base_url() . "admin/home";
        } else {
            echo 0;
        }
    }

    public function logout()
    {
        if (session_unset()) {
            echo json_encode(array('message' => '', 'status' => true));
        } 
    }
}
