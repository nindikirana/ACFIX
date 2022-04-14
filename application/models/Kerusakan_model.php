<?php

class kerusakan_model extends CI_MODEL
{
    public function getKerusakan($id_kerusakan = null)
    {

        if( $id_kerusakan === null )  {
            return $this->db->get('kerusakan')->result_array();
        } else {
            return $this->db->get_where('kerusakan', ['Id_Kerusakan' => $id_kerusakan])->result_array();
           
        }
   
}
     public function deleteKerusakan($id_kerusakan)
    {
        $this->db->delete('kerusakan', ['Id_Kerusakan' => $id_kerusakan]);
        return $this->db->affected_rows(); 
    }

    public function createKerusakan($kerusakan)
    {
        $this->db->insert('kerusakan', $kerusakan);
        return $this->db->affected_rows();
    }

    public function updateKerusakan($kerusakan, $id_kerusakan)
    {
       return $this->db->update('kerusakan', $kerusakan , ['Id_Kerusakan' => $id_kerusakan]);
      return $this->db->affected_rows();
    }
}