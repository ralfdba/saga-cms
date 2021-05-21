<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Notificaciones_model
 *
 * @author ralf
 */
class Mensajeria_model extends CI_Model{
    protected $table = array(
        'tb_notificaciones'=>'conotificaciones',
    );
    
    public function __construct(){
        parent::__construct();
    }
    
    public function get_total(){
        $qry = $this->db->count_all_results($this->table['tb_notificaciones']);
        return $qry;
    }
    
    public function get_current_page_records($limit, $start){
        $this->db->limit($limit, $start);
        $query = $this->db->get($this->table['tb_notificaciones']);
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
            'id'=>$params['mensajeria_id']
        );
        $qry = $this->db->get_where($this->table['tb_notificaciones'], $conditions);
        $result = $qry->result_array();
        return $result;         
    }
    
    public function insert($params){
        $opc = array(
            'titulo'=>$params['titulo'],
            'asunto'=>$params['asunto'],
            'de'=>$params['de'],
            'para'=>$params['para'],
            'cuerpo'=>$params['cuerpo'],
            'tipo_notificacion'=>$params['tipo_notificacion']
        );
        $this->db->insert($this->table['tb_notificaciones'],$opc);
        $insert_id = $this->db->insert_id();
        return  $insert_id;        
    }
    
    public function update($params){
        $data = array(
            'titulo'=>$params['titulo'],
            'estado'=>$params['estado'],
            'asunto'=>$params['asunto'],
            'de'=>$params['de'],
            'para'=>$params['para'],
            'cuerpo'=>$params['cuerpo'],
            'tipo_notificacion'=>$params['tipo_notificacion']
        );
        $this->db->where('id', $params['id']);
        $this->db->update($this->table['tb_notificaciones'], $data);
        $resp = $this->db->affected_rows();
        return $resp;          
    }
    
    public function delete($id){
        $opc = array(
            'id'=>$id
        );
        $this->db->delete($this->table['tb_notificaciones'],$opc);
        $resp = $this->db->affected_rows();
        return $resp;        
    }
}
