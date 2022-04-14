<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Solusi extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('solusi_model');

    

    }
    public function index_get()
    {
      $id = $this->get('Id_Solusi');
       $delete = $this->get('Delete');
       if($delete === true || $delete === 'true') {
            $this->deleteData($id);
            return;
       }
       
       if ($id === null) {

        $solusi = $this->solusi_model->getSolusi();

       } else {
        $solusi = $this->solusi_model->getSolusi($id);
        
       }
    
        if ($solusi) {
            $this->response([
                'status' => true,
                'data' => $solusi
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'id not found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }

    }
    
    private function deleteData($id) {
          if ($id === null) {
                $this->response([
                    'status' => false,
                    'message' => 'provide an id!'
                ], REST_Controller::HTTP_BAD_REQUEST);
            } else {
               
                if ($this->solusi_model->deleteSolusi($id) > 0 ) {
    
                    $this->set_response([
                        'status' => true,
                        'id' => $id,
                        'message' => 'deleted.'
                    ], REST_Controller::HTTP_OK);
    
                } else {
    
                    $this->response([
                        'status' => false,
                        'message' => 'not found!'
                    ], REST_Controller::HTTP_BAD_REQUEST);
        
                }
            }
    }

    public function index_delete()
    {
        $id = $this->delete('Id_Solusi');

        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'provide an id!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
           
            if ($this->solusi_model->deleteSolusi($id) > 0 ) {

                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message' => 'deleted.'
                ], REST_Controller::HTTP_OK);

            } else {

                $this->response([
                    'status' => false,
                    'message' => 'id not found!'
                ], REST_Controller::HTTP_BAD_REQUEST);
    
            }
        }

    }

    public function index_post()
    {
        $id = $this->post('Id_Solusi');
        
        if ($id === null) {
        $solusi = [
            
            'Id_Solusi' => "S".substr(uniqid(), 9),
            'Solusi_Penanganan' => $this->post('Solusi_Penanganan')
          
        ];

        if ($this->solusi_model->createSolusi($solusi) > 0) {
            $this->response([
                'status' =>true,
                'message' => 'new Solusi created.'
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'failed to create new data!',
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }else {
            $solusi = [
            
            'Solusi_Penanganan' => $this->post('Solusi_Penanganan')
          
        ];
          
            if ($this->solusi_model->updateSolusi($solusi, $id) > 0) {
                $this->response([
                    'status' =>true,
                    'message' => 'Solusi updated.'
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'failed to updated data!'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    public function index_put()
    {
        $id = $this->post('Id_Solusi');
        $solusi = [
            
            'Solusi_Penanganan' => $this->post('Solusi_Penanganan')
          
        ];
    
        if ($this->solusi_model->updateSolusi($solusi, $id) > 0) {
            $this->response([
                'status' =>true,
                'message' => ' updated.'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'failed to updated data!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

}
