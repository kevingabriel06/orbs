<?php
class Guest_model extends CI_Model
{
    public function get_price($room_id) {
        $this->db->select('price');
        $this->db->from('rooms');
        $this->db->where('room_id', $room_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row()->price;
        } else {
            return false;
        }
    }

    public function update_status($room_id) {
        $data = array(
            'status' => 1
        );

        $this->db->where('room_id', $room_id);
        return $this->db->update('rooms', $data);
    }

    public function insert_checkin($data) {
        return $this->db->insert('guest', $data);
    }

    public function get_guest(){
        $this->db->order_by('checkin', 'DESC'); 
        $guest = $this->db->get_where('guest')->result();
        return $guest;
    }

    public function cancel($guest_id) {
        // Update the checkout status in the database
        $data = array(
            'status' => 4
        );
        $this->db->where('guest_id', $guest_id);
        return $this->db->update('guest', $data);
    }

    public function update_room_status($room_id, $status) {
        $data = array(
            'status' => $status // Set the room status to available or any desired status
        );
        $this->db->where('room_id', $room_id);
        return $this->db->update('rooms', $data);
        }
}
