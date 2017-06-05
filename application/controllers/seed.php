<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Seed extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('data');
  }
  public function index()
  {
    $faker = Faker\Factory::create();
    for ($i=0; $i < 30 ; $i++) {
      $nama = $this->mres($faker->name);
      $adrres= $this->mres($faker->address);
      $phone=$this->mres($faker->ean8);
      $data = array('name' => $nama,'addres' => $adrres,'phone' => $phone );

      $this->data->tambah($data);
    }

  }
  public function mres($value)
{
    $search = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a");
    $replace = array("\\\\","\\0","\\n", "\\r", "\'", '\"', "\\Z");

    return str_replace($search, $replace, $value);
}
}
