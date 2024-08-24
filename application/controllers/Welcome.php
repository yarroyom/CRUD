<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('Persona');
	}//end __construct

	public function index() {
		$datos['personas'] = $this->Persona->seleccionar_todo();
		$this->load->view('welcome_message', $datos);
	}//end insex

	public function agregar() {
		$persona['nombre'] = $this->input->post('nombre');
		$persona['Apellido1'] = $this->input->post('Apellido1');
		$persona['Apellido2'] = $this->input->post('Apellido2');
		$persona['fecha_nacimiento'] = $this->input->post('fecha_nacimiento');
		$persona['genero'] = $this->input->post('genero');

		$this->Persona->agregar($persona);
		redirect('welcome');
	}//end agregar

	public function eliminar($id_persona) {
		$this->Persona->eliminar($id_persona);
		redirect('welcome');
	}//end eliminar

	public function editar($id_persona) {
		$persona['nombre'] = $this->input->post('nombre');
		$persona['Apellido1'] = $this->input->post('Apellido1');
		$persona['Apellido2'] = $this->input->post('Apellido2');
		$persona['fecha_nacimiento'] = $this->input->post('fecha_nacimiento');
		$persona['genero'] = $this->input->post('genero');

		$this->Persona->actualizar($persona, $id_persona);
		redirect('welcome');
	}//end editar

}//end Class Welcome
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
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	

