<?php
class User_model extends CI_Model
{
 
    public function get_users() {
        $users = $this->db->get_where('users')->result();
        return $users;
    }

    public function get_rooms() {
        $users = $this->db->get_where('rooms')->result();
        return $users;
    }
    public function getroom($id)
    {
        $room = $this->db->get_where('rooms', ['room_id' => $id ])->row();
        return $room;
    }

    public function get_roomtypes() {
        $users = $this->db->get_where('room_types')->result();
        return $users;
    }
}
