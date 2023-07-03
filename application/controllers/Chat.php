<?php
class Chat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Chat_model');
    }

    public function index()
    {
        // Tampilkan daftar percakapan pengguna saat ini
        $user_id = 1; // Ganti dengan ID pengguna saat ini
        $data['chats'] = $this->Chat_model->get_chats($user_id);
        $this->load->view('chat_view', $data);
    }

    public function send_chat()
    {
        // Simpan pesan yang dikirim
        $sender_id = 1; // Ganti dengan ID pengguna saat ini
        $receiver_id = 2; // Ganti dengan ID penerima
        $message = $this->input->post('message');
        $this->Chat_model->save_chat($sender_id, $receiver_id, $message);

        redirect('chat');
    }
}
