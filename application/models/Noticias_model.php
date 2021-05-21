<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Noticias_model extends CI_Model{
    protected $table = array(
        'tb_noticias'=>'copublicacion'
    );

    public function get($id){
        $conditions = array(
            'categoria_id'=>$id
        );
        $qry = $this->db->get_where($this->table['tb_noticias'], $conditions);
        $result = $qry->result_array();
        return $result;
    }
}