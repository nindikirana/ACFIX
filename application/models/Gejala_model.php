<?php

class gejala_model extends CI_MODEL
{
    public function getGejala($id_gejala = null)
    {

        if( $id_gejala === null )  {
            return $this->db->get('gejala')->result_array();
        } else {
            return $this->db->get_where('gejala', ['Id_Gejala' => $id_gejala])->result_array();
           
        }
   
}
    public function deleteGejala($id_gejala)
    {
        $this->db->delete('gejala', ['Id_Gejala' => $id_gejala]);
        return $this->db->affected_rows(); 
    }

    public function createGejala($gejala)
    {
        $this->db->insert('gejala', $gejala);
        return $this->db->affected_rows();
    }

    public function updateGejala($gejala, $id_gejala)
    {
       return $this->db->update('gejala', $gejala , ['Id_Gejala' => $id_gejala]);
        return $this->db->affected_rows();
    }
}