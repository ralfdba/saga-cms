<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Grupos_model
 *
 * @author ralf
 */
class Grupos_model extends CI_Model{
    protected $table = array(
        'tb_grupos'=>'groups',
    );
    
    public function __construct(){
        parent::__construct();
    }
    
    public function get_total(){
        $qry = $this->db->count_all_results($this->table['tb_grupos']);
        return $qry;
    }
    
    public function get_current_page_records($limit, $start){
        $this->db->limit($limit, $start);
        $query = $this->db->get($this->table['tb_grupos']);
        if ($query->num_rows() > 0){
            foreach ($query->result() as $row){
                $data[] = $row;
            }             
            return $data;
        }
        return false;
    }
    
    public function selectbyid($params){
        $conditions = array(
            'id'=>$params['grupo_id']
        );
        $qry = $this->db->get_where($this->table['tb_grupos'], $conditions);
        $result = $qry->result_array();
        return $result;         
    }
}
