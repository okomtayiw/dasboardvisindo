<?php

Class UserModel extends CI_Model{


  public function __construct()
  {
    $this->load->database();
  }



  public function getAllDataUser(){
  
    $query = $this->db->query("SELECT * FROM tbl_users ORDER BY id DESC");
    return $query->result_array();

  }


  public function getDataUserUpdate($idUser){
  
    $query = $this->db->query("SELECT * FROM tbl_users WHERE id = '$idUser'");
    return $query->result_array();

  }


  public function saveUpdateDataUser($firstname,$lastname,$email,$status, $idUser){

    $data = array(
      'first_name' => $firstname,
      'last_name' => $lastname,
      'email' => $email,
      'is_active' => $status
    );


    $this->db->where('id', $idUser);
    $this->db->update('tbl_users', $data);
  }






    function totDataUser(){
      return $this->db->count_all("tb_users");
    }

        



    public function get_current_page_records_users() 
    {
       
        $query = $this->db->query("SELECT * FROM tb_users ORDER BY id_users DESC");
        return $query->result_array();
  
  
        if ($query->num_rows() > 0)
          {
              foreach ($query->result() as $row)
              {
                  $data[] = $row;
              }
              
              return $data;
          }
    
        return false;
  
      
    }

   


}