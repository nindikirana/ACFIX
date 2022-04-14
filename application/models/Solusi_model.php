<?php

class solusi_model extends CI_MODEL
{
    public function getSolusi($id_solusi = null)
    {

        if( $id_solusi === null )  {
            return $this->db->get('solusi')->result_array();
        } else {
            return $this->db->get_where('solusi', ['Id_Solusi' => $id_solusi])->result_array();
           
        }
   
}
    public function deleteSolusi($id_solusi)
    {
        $this->db->delete('solusi', ['Id_Solusi' => $id_solusi]);
        return $this->db->affected_rows(); 
    }

    public function createSolusi($solusi)
    {
        $this->db->insert('solusi', $solusi);
        return $this->db->affected_rows();
    }

    public function updateSolusi($solusi, $id_solusi)
    {
        return $this->db->update('solusi', $solusi, ['Id_Solusi' => $id_solusi]);
    }
}