<?php 
	class Pages extends CI_Controller{

		
		public function __construct()
		{
			parent::__construct();
			$this->load->model('Administrator_Model');
		}

		public function view($page = 'home'){
			if (!file_exists(APPPATH.'views/pages/'.$page.'.php')) {
				show_404();
			}
			$data['title'] = ucfirst($page);
			$data2['products'] = $this->Administrator_Model->get_products_with_images(); // Panggil fungsi get_products_with_images() dari model Administrator_Model
			$data3['products_2'] = $this->Administrator_Model->get_products();

			$this->load->view('templates/header');
			$this->load->view('pages/'.$page, $data2, $data3);
			$this->load->view('templates/footer');
		}

	}
	