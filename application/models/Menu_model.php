<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 * @author ralf
 * @desc Trae todos los ítem de menú por privilegio de usuario
 */
class Menu_model extends CI_Model{
    protected $table = array(
        'tb_menu'=>'menu',
        'tb_permisos'=>'permisos'
    );
    
    public function __construct(){
        parent::__construct();
    }
    
    public function get($id){
        $conditions = array(
            'usuario_id'=>$id
        );
        $qry = $this->db->get_where($this->table['tb_menu'], $conditions);
        $result = $qry->result_array();
        return $result;
    }
    
    public function get_menu($id=NULL,$isfront_menu){
        if($isfront_menu == 0){
            //menu 0 indica solo mostrar en el administrador
            if(count($id) == 1){
                $sql = "select distinct m.nombre_menu,m.controlador from menu as m, permisos as p where m.id = p.menu_id and p.grupo_id = ".$this->db->escape($id[0]->id) ." and m.front = ".$this->db->escape($isfront_menu)." order by m.orden asc";
                $qry = $this->db->query($sql);
                return $qry->result_array();            
            }else{
                for($n = 0; $n < count($id); $n++){
                    $sql = "select distinct m.nombre_menu,m.controlador from menu as m, permisos as p where m.id = p.menu_id and p.grupo_id = ".$this->db->escape($id[$n]->id) ." and m.front = ".$this->db->escape($isfront_menu)." order by m.orden asc";
                    $qry = $this->db->query($sql);
                    return $qry->result_array();
                }            
            }
        }else{
            $sql = "select distinct nombre_menu,controlador from menu where front = ".$this->db->escape($isfront_menu) ." order by orden asc";
            $qry = $this->db->query($sql);
            return $qry->result_array();            
        }
    }
    
    public function get_total(){
        $qry = $this->db->count_all_results($this->table['tb_menu']);
        return $qry;
    }
    
    public function get_current_page_records($limit, $start){
        $this->db->limit($limit, $start);
        $query = $this->db->get($this->table['tb_menu']);
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
            'front'=>$params['front']
        );
        $this->db->insert($this->table['tb_menu'],$opc);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }
    
    public function delete($id){
        $opc = array(
            'id'=>$id
        );
        $this->db->delete($this->table['tb_menu'],$opc);
        $resp = $this->db->affected_rows();
        return $resp;
    }
    
    public function update($params){
        $data = array(
            'nombre_menu'=>$params['nombre'],
            'descripcion'=>$params['desc'],
            'controlador'=>$params['controlador'],
            'orden'=>$params['orden'],
            'front'=>$params['front']
        );
        $this->db->where('id', $params['menu_id']);
        $this->db->update($this->table['tb_menu'], $data);
        $resp = $this->db->affected_rows();
        return $resp;        
    }
    
    public function selectbyid($params){
        $conditions = array(
            'id'=>$params['menu_id'],
            'nombre_menu'=>$params['menu_name']
        );
        $qry = $this->db->get_where($this->table['tb_menu'], $conditions);
        $result = $qry->result_array();
        return $result;        
    }
    public function select(){
        $qry = $this->db->get($this->table['tb_menu']);
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

