<?php 
	class Pages extends CI_Controller{

		
		public function __construct()
		{
			parent::__construct();
			$this->load->model('Administrator_Model');
		}

		public function view($page = 'home') {
			if (!file_exists(APPPATH.'views/pages/'.$page.'.php')) {
				show_404();
			}

			$selectedCategory = $this->input->get('category'); // Menangkap parameter kategori dari URL
		
			$data['title'] = ucfirst($page);
			$data['selectedCategory'] = $selectedCategory; // Menyimpan nilai kategori terpilih
		
			if ($selectedCategory) {
				$this->db->where('categories.name', urldecode($selectedCategory));
			}
		
			$data['products'] = $this->Administrator_Model->get_products_with_images(); // Panggil fungsi get_products_with_images() dari model Administrator_Model
			$data['categories'] = $this->Administrator_Model->getDistinctCategories();
		
			$this->load->view('templates/header');
			if ($selectedCategory) {
				$this->load->view('pages/'.$page , $data); // Tampilkan view khusus untuk hasil pencarian
			} else {
				$this->load->view('pages/'.$page, $data); // Tampilkan view normal jika tidak ada pencarian
			}
			$this->load->view('templates/footer');
		}


		public function search($page = 'home') {
			if (!file_exists(APPPATH.'views/pages/'.$page.'.php')) {
				show_404();
			}

			$searchTerm = $this->input->get('search'); // Mengambil nilai pencarian dari query string
		
			$data['title'] = ucfirst($page);
		
			$data['products'] = $this->Administrator_Model->get_products_with_images(); // Panggil fungsi get_products_with_images() dari model Administrator_Model
			$data['products'] = $this->User_Model->searchProductsByName($searchTerm);
		
			$this->load->view('templates/header');
			$this->load->view('pages/'.$page, $data); // Tampilkan view normal jika tidak ada pencarian
			$this->load->view('templates/footer');
		}
		
		
		// public function viewdetail($page = 'detail-product') {
		// 	if (!file_exists(APPPATH.'views/pages/'.$page.'.php')) {
		// 		show_404();
		// 	}
		
		// 	$data['title'] = ucfirst($page);
		// 	// $data['product_id'] = $id; // Menyimpan nilai id produk
		
		// 	$this->load->view('templates/header');
		// 	$this->load->view('pages/'.$page, $data);
		// 	$this->load->view('templates/footer');
		// }

		public function view_detail($id) {
			// Memuat model produk
			$this->load->model('Administrator_Model');

			// Mengambil data produk berdesarkan $id dari database
			$product = $this->Administrator_Model->get_products($id);

			$dataproduct['product'] = $product;

			$this->load->view('templates/header');
			$this->load->view('detail-product/', $dataproduct);
			$this->load->view('templates/footer');
		}

	}
	