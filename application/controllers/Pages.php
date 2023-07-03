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

		$data['products'] = $this->Administrator_Model->get_products_with_images(); // Panggil fungsi get_products_with_images() dari model Administrator_Model
		$data['categories'] = $this->Administrator_Model->getDistinctCategories();
		$data_produk['products'] = $this->Administrator_Model->get_products_by_id($id);

		$this->load->view('templates/header');
		$this->load->view('pages/' . $page, $data, $data_produk);
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

	public function detailProduct($id)
	{
		$data['products'] = $this->Administrator_Model->get_products_by_id($id); // Menggunakan $data['products'] sebagai nama indeks
		$this->load->view('templates/header');
		$this->load->view('detail-product/', $data); // Mengubah $data menjadi $data['product']
		$this->load->view('templates/footer');
	}
}
