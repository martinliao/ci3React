<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('smarty_acl');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->logged_in();
        $this->smarty_acl->authorized();

        $this->load->model('admin_model', 'model');
    }

    protected function logged_in()
    {
        if (!$this->smarty_acl->logged_in()) {
            return redirect('admin/login');
        }
    }

    public function index()
    {
        $data = [
            'title' => "Admin",
            //'ss_settings' => $this->db->get_where('system_settings', ['id' => 1])->row(),
        ];
        $data['ss_settings'] = '';
        // $this->load->view('_layout/admin/head', $data);
        //admin('index', $data);
        react_admin('index', $data);
    }

    public function dashboard()
    {
        debugBreak();
        $data = [
            'title' => "Admin",
            'ss_settings' => $this->db->get_where('system_settings', ['id' => 1])->row(),
        ];

        $this->load->view('_layout/admin/head', $data);
        $this->load->view('index', $data);
    }
    public function menu()
    {
        $data = $this->model->menu();
        echo json_encode($data);
    }
    public function logout()
    {
        $this->session->unset_userdata('user');
        $this->session->unset_userdata('role');
        $this->session->unset_userdata('id');
        $this->session->sess_destroy();
        redirect('auth');
    }
}
