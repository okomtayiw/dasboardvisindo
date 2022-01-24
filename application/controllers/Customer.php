<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
        $models = array(
            'ModelCustomer' => 'ModelCustomer'
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
            $data['package'] = $this->ModelCustomer->getAllDataPackage();
            $data['customers'] = $this->ModelCustomer->getAllDataCustomer();
            $data['title'] = 'Data Pelangan';
            $this->load->view('templates/header', $data);
            $this->load->view('customer/index', $data);
            $this->load->view('templates/footer');
        }
    }


    public function updateCustomer($idCustomer)
    {
        $data['user'] = $this->db->get_where('tbl_users', ['email' =>
        $this->session->userdata('email')])->row_array();
        if ($data['user'] != null) {
            $data['package'] = $this->ModelCustomer->getAllDataPackage();
            $data['customers'] = $this->ModelCustomer->getDataCustomer($idCustomer);
            $data['title'] = 'Data Pelangan';
            $this->load->view('templates/header', $data);
            $this->load->view('customer/form_edit', $data);
            $this->load->view('templates/footer');
        }
    }

    public function saveUpdateDataCustomer()
    {

        $data['user'] = $this->db->get_where('tbl_users', ['email' =>
        $this->session->userdata('email')])->row_array();
        if ($data['user'] != null) {
            $idCustomer = $this->input->post('idCustomer');
            $numberCustomer = $this->input->post('numberCustomer');
            $nameCustomer = $this->input->post('nameCustomer');
            $dateInstallation = $this->input->post('dateInstallation');
            $noId = $this->input->post('noId');
            $addressCustomer = $this->input->post('addressCustomer');
            $nmPackage = $this->input->post('nmPackage');

            $this->ModelCustomer->postUpdateDataCustomer($idCustomer, $numberCustomer, $nameCustomer, $dateInstallation, $noId, $addressCustomer, $nmPackage);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                Success update data.
                </div>');

            redirect('customer');
        }
    }

    public function insertCustomer()
    {
        $data['user'] = $this->db->get_where('tbl_users', ['email' =>
        $this->session->userdata('email')])->row_array();
        if ($data['user'] != null) {

            $numberCustomer = $this->input->post('numberCustomer');
            $nameCustomer = $this->input->post('nameCustomer');
            $dateInstallation = $this->input->post('dateInstallation');
            $noId = $this->input->post('noId');
            $addressCustomer = $this->input->post('addressCustomer');
            $nmPackage = $this->input->post('nmPackage');
            $totData = $this->ModelCustomer->cekNumberCustomer($numberCustomer);
            if ($totData == null) {

                $this->ModelCustomer->postInsertDataCustomer($numberCustomer, $nameCustomer, $dateInstallation, $noId, $addressCustomer, $nmPackage);
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                Success menambahkan data.
                </div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                No. Pelanggan sudah dipakai 
                </div>');
            }

            redirect('customer');
        }
    }


    public function deleteCustomer($idCustomer)
    {

        $data['user'] = $this->db->get_where('tbl_users', ['email' =>
        $this->session->userdata('email')])->row_array();
        if ($data['user'] != null) {


            if ($idCustomer != '') {
                $this->db->where_in('id_customers', $idCustomer);
                $this->db->delete('tbl_customers');
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
            redirect('Customer');
        }
    }
}
