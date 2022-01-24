<?php

class ModelTransaction extends CI_Model
{


  public function __construct()
  {
    $this->load->database();
  }

  public function getAllDataPaket()
  {

    $query = $this->db->query("SELECT * FROM tbl_package ORDER BY id_package DESC");
    return $query->result_array();
  }

  public function getAllDataCustomer()
  {
    $query = $this->db->query("SELECT * FROM tbl_customers ORDER BY id_customers DESC");
    return $query->result_array();
  }

  public function getAllDataTransaction()
  {
    $query = $this->db->query("SELECT a.*,b.name_customer, d.name_package, b.address_customers,  d.abonemen  FROM tbl_transaction as a  
    LEFT OUTER JOIN tbl_customers b ON a.number_customer = b.number_customer
    LEFT OUTER JOIN tbl_users c ON b.number_customer = c.number_customer
    LEFT OUTER JOIN tbl_package d ON b.id_package = d.id_package ORDER BY a.id_transaction DESC");
    return $query->result_array();
  }

  public function getAllDataCustomerNumber($numberCustomers)
  {

    $query = $this->db->query("SELECT * FROM tbl_customers as a
    LEFT OUTER JOIN tbl_package b ON a.id_package = b.id_package
    WHERE a.number_customer = $numberCustomers");
    return $query->result_array();
  }

  public function cekTransactionMonth($numberCustomer, $month)
  {
    $query = $this->db->query("SELECT date_invoice as totData FROM tbl_transaction WHERE MONTH(date_invoice) =  $month AND number_customer = $numberCustomer");
    return $query->result_array();
  }

  public function postInsertDataTransaction($numberCustomer, $dateInvoice, $dueDate, $status)
  {

    $datenow = date('Y-m-d');
    $data = array(
      'date_transaction' => $datenow,
      'date_invoice' => $dateInvoice,
      'number_customer' => $numberCustomer,
      'status_transaction' => $status,
      'due_date' => $dueDate
    );
    $this->db->insert('tbl_transaction', $data);
  }

  public function updateDataTransaction($idTransaction, $dInvoice, $dDate, $status)
  {
    $datenow = date('Y-m-d');
    $data = array(
      'date_invoice' => $dInvoice,
      'status_transaction' => $status,
      'due_date' => $dDate
    );
    $this->db->where('id_transaction', $idTransaction);
    $this->db->update('tbl_transaction', $data);
  }

  public function getDataTransaction($idTransaction)
  {
    $query = $this->db->query("SELECT a.*,b.name_customer, d.name_package, b.address_customers,  d.abonemen, d.description  FROM tbl_transaction as a  
    LEFT OUTER JOIN tbl_customers b ON a.number_customer = b.number_customer
    LEFT OUTER JOIN tbl_users c ON b.number_customer = c.number_customer
    LEFT OUTER JOIN tbl_package d ON b.id_package = d.id_package WHERE  a.id_transaction = $idTransaction");
    return $query->result_array();
  }

  //   public function getDataProject($idProject){

  //     $this->db->select('name_project');
  //     $this->db->from('tbl_project');
  //     $this->db->where('id_project', $idProject);
  //     return $this->db->get()->row()->name_project;

  //   }


  //   public function getDataImages($numberDefect){

  //     $query = $this->db->query("SELECT * FROM tbl_images_defect WHERE number_defect = '$numberDefect'");
  //     return $query->result_array();
  //   }



  //   public function getDataSubProject($idProject){

  //     $query = $this->db->query("SELECT * FROM tbl_sub_project WHERE id_project = '$idProject'");
  //     return $query->result_array();

  //   }

  //  public function getDataUnit($idProject,$idSubProject){
  //     $nameProject =  $this->getDataProject($idProject);
  //     $query = $this->db->query("SELECT * FROM tbl_unit WHERE name_project = '$nameProject' AND name_tower = '$idSubProject'");
  //     return $query->result_array();
  //  }





  //  function totDataProject(){
  //     return $this->db->count_all("tbl_project");
  //  }

  //  public function getItemDefectList($nameLocation){
  //     $query = $this->db->query("SELECT * FROM tbl_transaction_defect as a   
  //     LEFT OUTER JOIN tbl_location b ON a.id_location =  b.number_location
  //     LEFT OUTER JOIN tbl_users c ON a.id_user = c.id
  //     WHERE b.name_location = '$nameLocation'");
  //     return $query->result_array();
  //  }

  //  public function getItemDefectListPdf($nameLocation){
  //   $query = $this->db->query("SELECT *, GROUP_CONCAT(d.name_images) as name_images FROM tbl_transaction_defect as a   
  //   LEFT OUTER JOIN tbl_location b ON a.id_location =  b.number_location
  //   LEFT OUTER JOIN tbl_users c ON a.id_user = c.id
  //   LEFT OUTER JOIN tbl_images_defect d ON a.number_defect = d.number_defect
  //   WHERE b.name_location = '$nameLocation'
  //   GROUP BY a.number_defect");
  //   return $query->result_array();
  // }


  // public function getItemDefect($idTransactionDefect){
  //   $query = $this->db->query("SELECT * FROM tbl_transaction_defect as a   
  //   LEFT OUTER JOIN tbl_location b ON a.id_location =  b.number_location
  //   LEFT OUTER JOIN tbl_users c ON a.id_user = c.id
  //   WHERE a.id_transaction_defect = '$idTransactionDefect'");
  //   return $query->result_array();
  // }

  // public function saveDataUpdate($idTransactionDefect,$areaDefect,$dateDefect,$description,$element){
  //   $data = array(
  //     'id_transaction_defect' => $idTransactionDefect,
  //     'area_defect' => $areaDefect,
  //     'date_defect' => $dateDefect,
  //     'element' => $element,
  //     'description' => $description
  // );

  //   $this->db->where('id_transaction_defect', $idTransactionDefect);
  //   $this->db->update('tbl_transaction_defect', $data);

  // }






}
