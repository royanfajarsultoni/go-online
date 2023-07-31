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
    // $product = $this->Administrator_Model->detail_product($id);

    // $data['product'] = $product; // Menggunakan array produk langsung
	$selectedCategory = $this->input->get('category');
	

	$data['products'] = $this->Administrator_Model->get_products();
	$data['product'] = $this->Administrator_Model->detail_product($id);
	$data['selectedCategory'] = $selectedCategory;
	$data['categories'] = $this->Administrator_Model->getDistinctCategories();

    $this->load->view('templates/header');
    $this->load->view('pages/detail-product', $data);
    $this->load->view('templates/footer');
	}
}