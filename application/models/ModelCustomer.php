<?php

class ModelCustomer extends CI_Model
{


    public function __construct()
    {
        $this->load->database();
    }


    public function getAllDataPackage()
    {
        $query = $this->db->query("SELECT * FROM tbl_package
        ORDER BY id_package ASC");
        return $query->result_array();
    }

    public function getDataCustomer($idCustomer){
        $query = $this->db->query("SELECT a.*, b.description, b.name_package FROM tbl_customers a
        LEFT OUTER JOIN tbl_package b ON a.id_package = b.id_package 
        WHERE a.id_customers = $idCustomer");
        return $query->result_array();
    }



    public function getAllDataCustomer()
    {
        $query = $this->db->query("SELECT a.*, b.description, b.name_package FROM tbl_customers a
        LEFT OUTER JOIN tbl_package b ON a.id_package = b.id_package 
        ORDER BY a.id_customers DESC");
        return $query->result_array();
    }

    public function cekNumberCustomer($numberCustomer)
    {
        $query = $this->db->query("SELECT number_customer as totData FROM tbl_customers WHERE number_customer = $numberCustomer");
        return $query->result_array();
    }

    public function postInsertDataCustomer($numberCustomer, $nameCustomer, $dateInstallation, $noId, $addressCustomer, $nmPackage)
    {
        $data = array(
            'number_customer' => $numberCustomer,
            'name_customer' => $nameCustomer,
            'date_installation' => $dateInstallation,
            'address_customers' => $addressCustomer,
            'id_package' => $nmPackage,
            'no_id' => $noId
        );
        $this->db->insert('tbl_customers', $data);
    }

    public function postUpdateDataCustomer($idCustomer,$numberCustomer, $nameCustomer, $dateInstallation, $noId, $addressCustomer, $nmPackage){
        $data = array(
            'number_customer' => $numberCustomer,
            'name_customer' => $nameCustomer,
            'date_installation' => $dateInstallation,
            'address_customers' => $addressCustomer,
            'id_package' => $nmPackage,
            'no_id' => $noId
        );
        $this->db->where('id_customers', $idCustomer);
        $this->db->update('tbl_customers', $data);
    }
}
