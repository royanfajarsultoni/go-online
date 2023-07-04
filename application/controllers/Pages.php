<?php
class Pages extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		$this->load->model('Administrator_Model');
	}

	public function view($page = 'home')
	{
		if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
			show_404();
		}

		$selectedCategory = $this->input->get('category'); // Menangkap parameter kategori dari URL

		$data['title'] = ucfirst($page);
		$data['selectedCategory'] = $selectedCategory; // Menyimpan nilai kategori terpilih

		if ($selectedCategory) {
			$this->db->where('categories.name', urldecode($selectedCategory));
		}

		$data['products'] = $this->Administrator_Model->get_products(); 
		$data['categories'] = $this->Administrator_Model->getDistinctCategories();

		$this->load->view('templates/header');
		$this->load->view('pages/' . $page, $data);
		$this->load->view('templates/footer');
	}

	public function detailProduct($id)
	{
    $product = $this->Administrator_Model->detail_product($id);

    $data['product'] = $product; // Menggunakan array produk langsung
    $this->load->view('templates/header');
    $this->load->view('pages/detail-product', $data);
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
}