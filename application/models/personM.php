<?php
// extends class Model
class PersonM extends CI_Model{
// response jika field ada yang kosong
  public function empty_response(){
    $response['status']=502;
    $response['error']=true;
    $response['message']='Field tidak boleh kosong';
    return $response;
  }
// function untuk insert data ke tabel tb_person
  public function add_person($name,$hp,$email,$message){
if(empty($name) || empty($hp) || empty($hp) || empty($message)){
      return $this->empty_response();
    }else{
      $data = array(
        "name"=>$name,
        "hp"=>$hp,
        "email"=>$email,
        "message"=>$message
      );
$insert = $this->db->insert("tb_person", $data);
if($insert){
        $response['status']=200;
        $response['error']=false;
        $response['message']='Data person ditambahkan.';
        return $response;
      }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']='Data person gagal ditambahkan.';
        return $response;
      }
    }
}
// mengambil semua data person
  public function all_person(){
$all = $this->db->get("tb_person")->result();
    $response['status']=200;
    $response['error']=false;
    $response['person']=$all;
    return $response;
}
// hapus data person
  public function delete_person($id){
if($id == ''){
      return $this->empty_response();
    }else{
      $where = array(
        "id"=>$id
      );
$this->db->where($where);
      $delete = $this->db->delete("tb_person");
      if($delete){
        $response['status']=200;
        $response['error']=false;
        $response['message']='Data person dihapus.';
        return $response;
      }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']='Data person gagal dihapus.';
        return $response;
      }
    }
}
// update person
  public function update_person($id,$name,$hp,$email,$message){
if($id == '' || empty($name) || empty($hp) || empty($email) || empty($message)){
      return $this->empty_response();
    }else{
      $where = array(
        "id"=>$id
      );
$set = array(
    "name"=>$name,
    "hp"=>$hp,
    "email"=>$email,
    "message"=>$message
      );
$this->db->where($where);
      $update = $this->db->update("tb_person",$set);
      if($update){
        $response['status']=200;
        $response['error']=false;
        $response['message']='Data person diubah.';
        return $response;
      }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']='Data person gagal diubah.';
        return $response;
      }
    }
}
}
?>