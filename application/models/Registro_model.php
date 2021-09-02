<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registro_model extends CI_Model{
    protected $table = array(
        'tabla'=>'users'
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
        $this->db->update($this->table['tabla'], $data);
        $resp = $this->db->affected_rows();
        return $resp;
    }

}
