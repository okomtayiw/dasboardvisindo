<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaction extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
        $models = array(
            'ModelTransaction' => 'ModelTransaction'
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


            $data['transaction'] = $this->ModelTransaction->getAllDataTransaction();
            $data['customers'] = $this->ModelTransaction->getAllDataCustomer();
            $data['title'] = 'Transaksi';
            $this->load->view('templates/header', $data);
            $this->load->view('transaction/index', $data);
            $this->load->view('templates/footer');
        }
    }


    public function insertTransaction()
    {
        $numberCustomers = $this->input->post('numberCustomers');
        $data['user'] = $this->db->get_where('tbl_users', ['email' =>
        $this->session->userdata('email')])->row_array();
        if ($data['user'] != null) {


            $data['transaction'] = $this->ModelTransaction->getAllDataTransaction();
            $data['customers'] = $this->ModelTransaction->getAllDataCustomerNumber($numberCustomers);
            $data['title'] = 'Transaksi';
            $this->load->view('templates/header', $data);
            $this->load->view('transaction/form_insert', $data);
            $this->load->view('templates/footer');
        }
    }

    public function saveDataTransaction()
    {
        $numberCustomer = $this->input->post('numberCustomer');
        $dateInvoice = $this->input->post('dateInvoice');
        $dueDate = $this->input->post('dueDate');
        $status = $this->input->post('nmStatus');
        $data['user'] = $this->db->get_where('tbl_users', ['email' =>
        $this->session->userdata('email')])->row_array();
        if ($data['user'] != null) {

            $dInvoice = str_replace('/', '-', $dateInvoice);
            $dDate = str_replace('/', '-', $dueDate);
            $month = date('m', strtotime($dateInvoice));
            $totData = $this->ModelTransaction->cekTransactionMonth($numberCustomer, $month);
            if ($totData == null) {
            $this->ModelTransaction->postInsertDataTransaction($numberCustomer, $dInvoice, $dDate, $status);
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                Tagihan sudah dibuat 
                </div>');
            }
        }

        redirect('Transaction');
    }

    public function editTransaction($idTransaction){

        $data['user'] = $this->db->get_where('tbl_users', ['email' =>
        $this->session->userdata('email')])->row_array();
        if ($data['user'] != null) {

            $data['transaction'] = $this->ModelTransaction->getDataTransaction($idTransaction);
            $data['title'] = 'Edit Transaksi';
            $this->load->view('templates/header', $data);
            $this->load->view('transaction/form_edit', $data);
            $this->load->view('templates/footer');
        }

    }

    public function saveUpdateDataTransaction(){

        $idTransaction = $this->input->post('idTransaction');
        $dateInvoice = $this->input->post('dateInvoice');
        $dueDate = $this->input->post('dueDate');
        $status = $this->input->post('nmStatus');
        $data['user'] = $this->db->get_where('tbl_users', ['email' =>
        $this->session->userdata('email')])->row_array();
        if ($data['user'] != null) {

            $dInvoice = str_replace('/', '-', $dateInvoice);
            $dDate = str_replace('/', '-', $dueDate);
            $this->ModelTransaction->updateDataTransaction($idTransaction, $dInvoice, $dDate, $status);
        }

        redirect('Transaction');

    }

    public function deleteTransaction($idTransaction)
    {  
        $data['user'] = $this->db->get_where('tbl_users', ['email' =>
        $this->session->userdata('email')])->row_array();
        if ($data['user'] != null) {


            if ($idTransaction != '') {
                $this->db->where_in('id_transaction', $idTransaction);
                $this->db->delete('tbl_transaction');
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
            redirect('transaction');
        }
       
    }
}
