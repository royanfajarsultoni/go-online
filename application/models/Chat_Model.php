<?php
class Chat_model extends CI_Model
{
    public function save_chat($sender_id, $receiver_id, $message)
    {
        $data = array(
            'sender_id' => $sender_id,
            'receiver_id' => $receiver_id,
            'message' => $message
        );
        $this->db->insert('chats', $data);
        return $this->db->insert_id();
    }

    public function get_chats($user_id)
    {
        $this->db->where('sender_id', $user_id);
        $this->db->or_where('receiver_id', $user_id);
        $this->db->order_by('created_at', 'asc');
        return $this->db->get('chats')->result();
    }
}
