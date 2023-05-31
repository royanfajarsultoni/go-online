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
			$this->load->view('templates/header');
			$this->load->view('pages/'.$page, $data);
			$this->load->view('templates/footer');
		}

		public function viewProducts()
		{
			$data['products'] = $this->Administrator_Model->get_products_with_images(); // Panggil fungsi get_products_with_images() dari model Administrator_Model
			
			// Panggil view user dan kirimkan data produk
			$this->load->view('templates/header');
			$this->load->view('pages/home', $data);
			$this->load->view('templates/footer');
			
			var_dump($data['products']);
		}
	}
	