<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Article extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct(){
        parent::__construct();

         //load the model  
		 $result = $this->load->model('Article_model');  

    }


	public function index($id = null)
	{

		
		$result = $this->Article_model->getAllWithUsers();
		echo json_encode($result);
		return;
	}

	public function one($id)
	{
		$result = $this->Article_model->getOne($id);
		echo json_encode($result);
		return;
	}

	public function create()
	{

		$data = array(
			'user_id' => $this->input->get('user_id'),
			'title' => $this->input->get('title'),
			'body' => $this->input->get('body'),
			'created_at' => date ("Y-m-d H:i:s", time()),
			'updated_at' => date ("Y-m-d H:i:s", time())
		);

		$result = $this->Article_model->insert($data);
		echo json_encode($result);
		return;
	
	}

	public function update($id)
	{
		$data = array(
			'user_id' => $this->input->get('user_id'),
			'title' => $this->input->get('title'),
			'body' => $this->input->get('body'),
			'updated_at' => date ("Y-m-d H:i:s", time())
		);

		$result = $this->Article_model->update($id, $data);
		echo json_encode($result);
		return;
	}

	public function delete($id)
	{
		$result = $this->Article_model->delete($id);
		echo json_encode($result);
		return;
	}
}
