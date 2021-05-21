<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permisos_model extends CI_Model{
    protected $table = array(
        'tb_permisos'=>'permisos',
        'tb_permisosdict'=>'permisos_dic',
    );
    public function __construct(){
        parent::__construct();
    }

    public function get_permisosdict(){
        $qry = $this->db->get($this->table['tb_permisosdict']);
        $result = $qry->result_array();
        return $result;
    }
    
    public function get(){
        $qry = $this->db->get($this->table['tb_permisos']);
        $result = $qry->result_array();
        return $result;
    }

    public function delete_permisos_dict($params){
        $salida = "";
        $opt = array(
            'id'=>$params['id'],
        );
        
        if($this->db->delete($this->table['tb_permisosdict'], $opt)){
            $salida = true;
        }else{
            $salida = false;
        }

        return $salida;
    }
    
    public function insert_permiso_dict($params){
        $salida = "";
        $opt = array(
            'nombre_permiso'=>$params['nombre'],
            'descripcion'=>$params['descripcion']
        );
        if($this->db->insert($this->table['tb_permisosdict'], $opt)){
            $salida = true;
        }else{
            $salida = false;
        }
        return $salida;
    }
    
    public function insert($params){
        
        $parameters = array(
            'usuario_id'=>$params['usuario_id'],
            'permiso_id'=>$params['permiso_id'],
            'usuario_id'=>$params['usuario_id'],
            'menu_id'=>$params['menu_id']
        );
        $this->db->insert($this->table['tb_permisos'], $parameters);
        //
        
        /**
         * insert into tabla (a,b,c,d) values (a1,b1,c1,d1);
         * 
         */
    }
    
}

