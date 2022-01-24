<?php

class ModelPackage extends CI_Model
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

    public function postInsertDataPackage($namePackage, $descriptionPackage, $abonemenPackage)
    {
        $data = array(
            'name_package' => $namePackage,
            'description' => $descriptionPackage,
            'abonemen' => $abonemenPackage
        );
        $this->db->insert('tbl_package', $data);
    }

    public function getDataPackage($idPackage)
    {

        $query = $this->db->query("SELECT * FROM tbl_package
        WHERE id_package =$idPackage");
        return $query->result_array();
    }

    public function postUpdateDataPackage($idPackage,$namePackage, $descriptionPackage, $abonemenPackage){
        $data = array(
            'name_package' => $namePackage,
            'description' => $descriptionPackage,
            'abonemen' => $abonemenPackage
        );
        $this->db->where('id_package', $idPackage);
        $this->db->update('tbl_package', $data);
    }
}
