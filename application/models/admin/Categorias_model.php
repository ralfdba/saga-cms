<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Categorias_model
 *
 * @author ralf
 */
class Categorias_model extends CI_Model{
    protected $table = array(
        'tb_categorias'=>'macategorias',
    );
    
    public function __construct(){
        parent::__construct();
    }
    
    public function get_total(){
        $qry = $this->db->count_all_results($this->table['tb_categorias']);
        return $qry;
    }
    
    public function get_current_page_records($limit, $start){
        $this->db->limit($limit, $start);
        $query = $this->db->get($this->table['tb_categorias']);
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
            'id'=>$params['categoria_id']
        );
        $qry = $this->db->get_where($this->table['tb_categorias'], $conditions);
        $result = $qry->result_array();
        return $result;         
    }
    
    public function insert($params){
        $opc = array(
            'nombre'=>$params['nombre']
        );
        $this->db->insert($this->table['tb_categorias'],$opc);
        $insert_id = $this->db->insert_id();
        return  $insert_id;         
    }
    
    public function update($params){
        $data = array(
            'nombre'=>$params['nombre']
        );
        $this->db->where('id', $params['id']);
        $this->db->update($this->table['tb_categorias'], $data);
        $resp = $this->db->affected_rows();
        return $resp;        
    }
    
    public function delete($id){
        $opc = array(
            'id'=>$id
        );
        $this->db->delete($this->table['tb_categorias'],$opc);
        $resp = $this->db->affected_rows();
        return $resp;        
    }
    
    public function select_all(){
        $qry = $this->db->get($this->table['tb_categorias']);
        $result = $qry->result_array();
        return $result;         
    }
    
}
