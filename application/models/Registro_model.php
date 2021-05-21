<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registro_model extends CI_Model{
    protected $table = array(
        'tb_usuarios'=>'users'
    );
    public function __construct(){
        parent::__construct();
    }

    public function update($params){
        $data = array(
            'active'=>1
        );
        $this->db->where('rut', $params['rut']);
        $this->db->where('email', $params['correo']);
        $this->db->update($this->table['tb_usuarios'], $data);
        $resp = $this->db->affected_rows();
        return $resp;        
    }
    
}

