<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	 *
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('data');
	}
	public function index()
	{
		$this->load->view('what');
	}
	public function migrate()
	{
					$this->load->library('migration');

					if ($this->migration->current() === FALSE)
					{
									show_error($this->migration->error_string());
					}
	}
	public function getdata()
	{
		$data = $this->data->getall();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	public function searchLike($value,$page)
	{
		$to = 5;
		$from=($page - 1) * $to;
		$data = $this->data->getLike($value,$from,$to);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	public function getLimit($page)
	{
		$to = 5;
		$from=($page - 1) * $to;
		$data=$this->data->getLimit($from,$to);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	public function tes()
	{
		echo DOMAIN;
	}
}
