<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Package extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
        $models = array(
            'ModelPackage' => 'ModelPackage'
        );
        $this->load->model($models);
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('array');
        $this->load->library('form_validation');
    }

    public function index()
    {

        $data['user'] = $this->db->get_where('tbl_users', ['email' =>
        $this->session->userdata('email')])->row_array();
        if ($data['user'] != null) {
            $data['package'] = $this->ModelPackage->getAllDataPackage();
            $data['title'] = 'Data Paket';
            $this->load->view('templates/header', $data);
            $this->load->view('package/index', $data);
            $this->load->view('templates/footer');
        }
    }

    public function insertPackage()
    {
        $data['user'] = $this->db->get_where('tbl_users', ['email' =>
        $this->session->userdata('email')])->row_array();
        if ($data['user'] != null) {
            $namePackage = $this->input->post('namePackage');
            $descriptionPackage = $this->input->post('descriptionPackage');
            $abonemenPackage = $this->input->post('abonemen');
            $this->ModelPackage->postInsertDataPackage($namePackage, $descriptionPackage, $abonemenPackage);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                Success menambahkan data.
                </div>');
            redirect('Package');
        }
    }

    public function updatePackage($idPackage){
        $data['user'] = $this->db->get_where('tbl_users', ['email' =>
        $this->session->userdata('email')])->row_array();
        if ($data['user'] != null) {
            $data['package'] = $this->ModelPackage->getDataPackage($idPackage);
            $data['title'] = 'Data Paket';
            $this->load->view('templates/header', $data);
            $this->load->view('package/form_edit', $data);
            $this->load->view('templates/footer');
        }
    }

    public function saveUpdateDataPackage(){
        $data['user'] = $this->db->get_where('tbl_users', ['email' =>
        $this->session->userdata('email')])->row_array();
        if ($data['user'] != null) {
            $idPackage = $this->input->post('idPackage');
            $namePackage = $this->input->post('namePackage');
            $descriptionPackage = $this->input->post('descriptionPackage');
            $abonemenPackage = $this->input->post('abonemen');
            $this->ModelPackage->postUpdateDataPackage($idPackage,$namePackage, $descriptionPackage, $abonemenPackage);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                Success menambahkan data.
                </div>');
            redirect('Package');
        }
    }

    public function deletePackage($idPackage)
    {

        $data['user'] = $this->db->get_where('tbl_users', ['email' =>
        $this->session->userdata('email')])->row_array();
        if ($data['user'] != null) {


            if ($idPackage != '') {
                $this->db->where_in('id_package', $idPackage);
                $this->db->delete('tbl_package');
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                Success delete data.
                </div>');
            } else {

                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                Maaf data tidak ada
                </div>');
            }
            redirect('Package');
        }
    }
}
