<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Empresas_model
 *
 * @author ralf
 */
class Empresas_model extends CI_Model{
    protected $table = array(
        'tb_empresas'=>'empresas',
    );
    
    public function __construct(){
        parent::__construct();
    }
    
    public function get_total(){
        $qry = $this->db->count_all_results($this->table['tb_empresas']);
        return $qry;
    }
    
    public function get_current_page_records($limit, $start){
        $this->db->limit($limit, $start);
        $query = $this->db->get($this->table['tb_empresas']);
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
            'id'=>$params['empresa_id']
        );
        $qry = $this->db->get_where($this->table['tb_empresas'], $conditions);
        $result = $qry->result_array();
        return $result;         
    }
    
    public function insert($params){
        $opc = array(
            'empresa'=>strtoupper($params['nombre']),
            'rut'=>$params['rut'],
            'direccion'=>$params['direccion'],
            'email_notificacion'=>$params['correo']
        );
        $this->db->insert($this->table['tb_empresas'],$opc);
        $insert_id = $this->db->insert_id();
        return  $insert_id;         
    }
    
    public function update($params){
        $data = array(
            'empresa'=>strtoupper($params['nombre']),
            'rut'=>$params['rut'],
            'direccion'=>$params['direccion'],
            'email_notificacion'=>$params['correo']
        );
        $this->db->where('id', $params['id']);
        $this->db->update($this->table['tb_empresas'], $data);
        $resp = $this->db->affected_rows();
        return $resp;        
    }
    
    public function delete($id){
        $opc = array(
            'id'=>$id
        );
        $this->db->delete($this->table['tb_empresas'],$opc);
        $resp = $this->db->affected_rows();
        return $resp;        
    }
    
    public function select_all(){
        $qry = $this->db->get($this->table['tb_empresas']);
        $result = $qry->result_array();
        return $result;         
    }
    
}
