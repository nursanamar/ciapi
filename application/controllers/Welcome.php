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
		$this->output->set_header('Access-Control-Allow-Origin: https://nursanamar.github.io');
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	public function searchLike($value,$page)
	{
		$to = 5;
		$from=($page - 1) * $to;
		$data = $this->data->getLike($value,$from,$to);
		$this->output->set_header('Access-Control-Allow-Origin: https://nursanamar.github.io');
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	public function getLimit($page)
	{
		$to = 5;
		$from=($page - 1) * $to;
		$data=$this->data->getLimit($from,$to);
		$this->output->set_header('Access-Control-Allow-Origin: https://nursanamar.github.io');
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	public function addData()
	{
		$data = $this->getInput();
		$this->data->tambah($data);
		$response = array(
			"status" => "sukses",
			"description" => "input data"
		);
		$this->output->set_header('Access-Control-Allow-Origin: https://nursanamar.github.io');
		$this->output->set_content_type('application/json')->set_output(json_encode($response));

	}
	public function deleteData()
	{
		$data = $this->getInput();
		$this->data->delete($data);
		$id = $data['id'];
		$response = array(
			"status" => "succes",
			"Desc" => "Deleted id $id"
		);
		$this->output->set_header('Access-Control-Allow-Origin: https://nursanamar.github.io');
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}
	public function editData()
	{
		$input = $this->getInput();
		$id = $input['id'];
		$data = $input['data'];
		$this->data->edit($id,$data);
		$response = array(
			"status" => "sukses",
			"description" => "update",
			"data" => $data
		);
		$this->output->set_header('Access-Control-Allow-Origin: https://nursanamar.github.io');
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}
	public function getInput()
	{
		$input = $this->input->input_stream();
		foreach ($input as $key => $value) {
			$data=json_decode($key,true);
			return $data;
		}
	}
	public function seed()
  {
    $faker = Faker\Factory::create();
    for ($i=0; $i < 30 ; $i++) {
      $nama = $this->mres($faker->name);
      $adrres= $this->mres($faker->address);
      $phone=$this->mres($faker->ean8);
      $data = array('name' => $nama,'addres' => $adrres,'phone' => $phone );

      $this->data->tambah($data);
    }

		echo "25 data telah ditambahkan";

  }
	public function mres($value)
{
    $search = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a");
    $replace = array("\\\\","\\0","\\n", "\\r", "\'", '\"', "\\Z");

    return str_replace($search, $replace, $value);
}
}
