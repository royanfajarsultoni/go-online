<?php
	class Users extends CI_Controller
	{

		public function __construct()
		{
			parent::__construct();
			$this->load->model('User_Model');
			$this->load->model('Administrator_Model');
			$this->load->library('session');
			$this->load->library('form_validation');
		}


		public function dashboard(){
			if(!$this->session->userdata('login')) {
				redirect('users/login');
			}
			$data['title'] = 'Dashboard';

			$this->load->view('templates/header');
			$this->load->view('users/dashboard', $data);
			$this->load->view('templates/footer');
		}

		// Register User
		public function register(){
			if($this->session->userdata('login')) {
				redirect('posts');
			}

			$data['title'] = 'Sign Up';

			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
			$this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('users/register', $data);
				$this->load->view('templates/footer');
			}else{
				//Encrypt Password
				$encrypt_password = md5($this->input->post('password'));

				$this->User_Model->register($encrypt_password);

				//Set Message
				$this->session->set_flashdata('user_registered', 'You are registered and can log in.');
				redirect('posts');
			}
		}

		// Edit Profile User
		public function edit_profile() {
			if (!$this->session->userdata('login')) {
				redirect('users/login');
			}
			
			// $this->load->model('User_Model');
			$data['title'] = 'Edit Profile';
		
			$user_id = $this->session->userdata('user_id');
			$user = $this->User_Model->get_user_by_id($user_id);
			if ($user) {
				$data['name'] = $user['name'];
				$data['username'] = $user['username'];
				$data['email'] = $user['email'];
			
				// ...
			} else {
				// Handle case when user data is not found
				redirect('users/login');
			}
		
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
			$this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');
		
			if ($this->form_validation->run() === FALSE) {
				$this->load->view('templates/header');
				$this->load->view('users/edit_profile', $data); // Ganti 'users/edit_profile' dengan path ke file view edit profile Anda
				$this->load->view('templates/footer');
			} else {
				// Encrypt Password
				$encrypt_password = md5($this->input->post('password'));
		
				$this->User_Model->update_profile($user_id, $data);
		
				// Set Message
				$this->session->set_flashdata('profile_updated', 'Your profile has been updated.');
				redirect('posts');
			}
		}
		
		
		// Log in User
		public function login(){
			$data['title'] = 'Sign In';

			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('users/login', $data);
				$this->load->view('templates/footer');
			}else{
				// get username and Encrypt Password
				$username = $this->input->post('username');
				$encrypt_password = md5($this->input->post('password'));

				$user_id = $this->User_Model->login($username, $encrypt_password);
				
				if ($user_id) {
					//Create Session
					$user_data = array(
						'user_id' => $user_id->id,
						'username' => $username,
						'email' => $user_id->email,
						'login' => true
					);
					
					$this->session->set_userdata($user_data);

					//Set Message
					$this->session->set_flashdata('user_loggedin', 'You are now logged in.');
					redirect('users/dashboard');
				}else{
					$this->session->set_flashdata('login_failed', 'Login is invalid.');
					redirect('users/login');
				}
				
			}
		}

		// log user out
		public function logout(){
			// unset user data
			$this->session->unset_userdata('login');
			$this->session->unset_userdata('user_id');
			$this->session->unset_userdata('username');

			//Set Message
			$this->session->set_flashdata('user_loggedout', 'You are logged out.');
			redirect(base_url());
		}

		// Check user name exists
		public function check_username_exists($username){
			$this->form_validation->set_message('check_username_exists', 'That username is already taken, Please choose a different one.');

			if ($this->User_Model->check_username_exists($username)) {
				return true;
			}else{
				return false;
			}
		}


		// Check Email exists
		public function check_email_exists($email){
			$this->form_validation->set_message('check_email_exists', 'This email is already registered.');

			if ($this->User_Model->check_email_exists($email)) {
				return true;
			}else{
				return false;
			}
		}

		// public function searchProduct() {
		// 	$searchTerm = $this->input->get('search'); // Mengambil nilai pencarian dari query string
		
		// 	// Panggil model untuk melakukan pencarian produk berdasarkan nama
		// 	$data['products'] = $this->User_Model->searchProductsByName($searchTerm);
		
		// 	// Muat view yang menampilkan hasil pencarian
		// 	$this->load->view('pages/home', $data);
		// }

	}
	