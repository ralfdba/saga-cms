<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 * @author ralf
 * @desc Trae todos los ítem de menú por privilegio de usuario
 */
class Menu_model extends CI_Model{
    protected $table = array(
        'tabla'=>'menu',
        'tb_permisos'=>'permisos'
    );
    
    public function __construct(){
        parent::__construct();
    }
    
    public function get($id){
        $conditions = array(
            'usuario_id'=>$id
        );
        $qry = $this->db->get_where($this->table['tabla'], $conditions);
        $result = $qry->result_array();
        return $result;
    }
    
    public function get_menu_admin( $rut_empresa ){
        $this->db->order_by('orden','asc');
        $opt = array(
            'rut_empresa' => $rut_empresa,
            'front' => 0
        );
        $qry = $this->db->get_where( $this->table['tabla'], $opt );
        $result = $qry->result_array();
        return $result;
    }
    public function get_menu_users( $rut_empresa ){
        $this->db->order_by('orden','asc');
        $opt = array(
            'rut_empresa' => $rut_empresa,
            'front' => 0
        );
        $qry = $this->db->get_where( $this->table['tabla'], $opt );
        $result = $qry->result_array();
        return $result;
    }
    public function get_menu_view_fronts(){
        $this->db->order_by('orden','asc');
        $opt = array(
            'rut_empresa' => $rut_empresa,
            'front' => 1
        );
        $qry = $this->db->get_where( $this->table['tabla'], $opt );
        $result = $qry->result_array();
        return $result;
    }
    
    public function get_total(){
        $qry = $this->db->count_all_results($this->table['tabla']);
        return $qry;
    }
    
    public function get_current_page_records($limit, $start){
        $this->db->limit($limit, $start);
        $query = $this->db->get($this->table['tabla']);
        if ($query->num_rows() > 0){
            foreach ($query->result() as $row){
                $data[] = $row;
            }             
            return $data;
        }
        return false;
    }
    
    public function insert($params){
        $opc = array(
            'nombre_menu'=>$params['nombre'],
            'descripcion'=>$params['desc'],
            'controlador'=>$params['controlador'],
            'orden'=>$params['orden'],
            'front'=>$params['front'],
            'rut_empresa'=>$params['rut_empresa']
        );
        $this->db->insert($this->table['tabla'],$opc);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }
    
    public function delete($id){
        $opc = array(
            'id'=>$id
        );
        $this->db->delete($this->table['tabla'],$opc);
        $resp = $this->db->affected_rows();
        return $resp;
    }
    
    public function update($params){
        $data = array(
            'nombre_menu'=>$params['nombre'],
            'descripcion'=>$params['desc'],
            'controlador'=>$params['controlador'],
            'orden'=>$params['orden'],
            'front'=>$params['front'],
            'rut_empresa'=>$params['rut_empresa']
        );
        $this->db->where('id', $params['menu_id']);
        $this->db->update($this->table['tabla'], $data);
        $resp = $this->db->affected_rows();
        return $resp;        
    }
    
    public function selectbyid($params){
        $conditions = array(
            'id'=>$params['menu_id'],
        );
        $qry = $this->db->get_where($this->table['tabla'], $conditions);
        $result = $qry->result_array();
        return $result;        
    }
    public function select(){
        $qry = $this->db->get($this->table['tabla']);
        $result = $qry->result_array();
        return $result;
    }    
    public function associatemenurol($params){
        for($n = 0; $n < count($params['menus']); $n++){
            $opc = array(
                'grupo_id'=>$params['roles'],
                'menu_id'=>$params['menus'][$n],
                'permiso_id'=>1
            );            
            $this->db->insert($this->table['tb_permisos'],$opc);
            $insert_id = $this->db->insert_id();
        }
        return  $insert_id;        
    }
    public function get_all_rol_menu_associate(){
        $sql = "select distinct g.id as grupo_id, g.description as grupo_nombre, p.id as permiso_id, m.nombre_menu from permisos as p, menu as m, groups as g where p.grupo_id = g.id and p.menu_id = m.id;";
        $qry = $this->db->query($sql);
        return $qry->result_array(); 
    }
    public function delete_menu_associate($id){
        $opc = array(
            'id'=>$id
        );
        $this->db->delete($this->table['tb_permisos'],$opc);
        $resp = $this->db->affected_rows();
        return $resp;        
    }
    
}

