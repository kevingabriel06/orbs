<?php
class Admin_model extends CI_Model
{

    //floors
    public function get_floors(){
        $floors = $this->db->get_where('floors')->result();
        return $floors;
    }

    public function save_floors($data) {
        $result = $this->db->insert('floors', $data);
        return $result;
    }

    public function update_floors($id, $data) {
        $this->db->where('floor_id', $id);
        return $this->db->update('floors', $data);
    }

    public function delete_floor($id) {
        
        // Check if the ID exists in the database
        $this->db->where('floor_id', $id);
        $query = $this->db->get('floors');

        if ($query->num_rows() > 0) {
            // ID exists, proceed with delete
            $this->db->where('floor_id', $id);
            return $this->db->delete('floors');
        } else {
            // ID does not exist
            return false;
        }
    }

    //roomtypes
    public function get_roomtypes(){
        $roomtype = $this->db->get_where('room_types')->result();
        return $roomtype;
    }

    public function save_roomtypes($data) {
        $result = $this->db->insert('room_types', $data);
        return $result;
    }

    public function update_roomtypes($id, $data) {
        $this->db->where('roomtype_id', $id);
        return $this->db->update('room_types', $data);
    }

    public function delete_roomtypes($id) {
        
        // Check if the ID exists in the database
        $this->db->where('roomtype_id', $id);
        $query = $this->db->get('room_types');

        if ($query->num_rows() > 0) {
            // ID exists, proceed with delete
            $this->db->where('roomtype_id', $id);
            return $this->db->delete('room_types');
        } else {
            // ID does not exist
            return false;
        }
    }

    //rooms
    public function get_rooms(){
        $room = $this->db->get_where('rooms')->result();
        return $room;
    }

    public function save_rooms($data) {
        $result = $this->db->insert('rooms', $data);
        return $result;
    }

    public function update_rooms($id, $data) {
        $this->db->where('room_id', $id);
        return $this->db->update('rooms', $data);
    }

    public function get($id)
    {
        $room = $this->db->get_where('rooms', ['room_id' => $id ])->row();
        return $room;
    }

    public function delete_rooms($id) {
        
        // Check if the ID exists in the database
        $this->db->where('room_id', $id);
        $query = $this->db->get('rooms');

        if ($query->num_rows() > 0) {
            // ID exists, proceed with delete
            $this->db->where('room_id', $id);
            return $this->db->delete('rooms');
        } else {
            // ID does not exist
            return false;
        }
    }

    //checkin
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

    public function insert_checkin($data) {
        return $this->db->insert('guest', $data);
    }

    public function update_status($room_id) {
        $data = array(
            'status' => 1
        );

        $this->db->where('room_id', $room_id);
        return $this->db->update('rooms', $data);
    }

    public function get_guest(){
        $this->db->order_by('checkin', 'ASC'); 
        $guest = $this->db->get_where('guest')->result();
        return $guest;
    }

    public function checkout($guest_id) {
        // Update the checkout status in the database
        $data = array(
            'status' => 2
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
    
    public function get_users(){
        $user = $this->db->get_where('users')->result();
        return $user;
    }

    public function insert_user($data) {
        return $this->db->insert('users', $data);
    }

    public function getuser($id)
    {
        $user = $this->db->get_where('users', ['user_id' => $id ])->row();
        return $user;
    }

    public function delete_user($id) {
        
        // Check if the ID exists in the database
        $this->db->where('user_id', $id);
        $query = $this->db->get('users');

        if ($query->num_rows() > 0) {
            // ID exists, proceed with delete
            $this->db->where('user_id', $id);
            return $this->db->delete('users');
        } else {
            // ID does not exist
            return false;
        }
    }

    public function booked($guest_id) {
        // Update the checkout status in the database
        $data = array(
            'status' => 3
        );
        $this->db->where('guest_id', $guest_id);
        return $this->db->update('guest', $data);
    }

    public function get_user_role($user_id) {
        // Fetch the user data from the 'users' table
        $this->db->select('role');
        $this->db->from('users');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();

        // Check if the query returned a row
        if ($query->num_rows() == 1) {
            // Return the role
            return $query->row()->role;
        } else {
            // Return false if no user found
            return false;
        }
    }

    //dashboard
    public function get_active_rooms_count() {
        $this->db->where('status', 0);
        return $this->db->count_all_results('rooms');
    }

     // Method to get the count of rooms with specific conditions
     public function get_specific_rooms_count() {
        $this->db->where('status', 1);
        return $this->db->count_all_results('rooms');
    }

    public function get_pending_reservations_count() {
        $this->db->where('status', 5);
        return $this->db->count_all_results('guest');
    }

    public function get_confirm_reservations_count() {
        $this->db->where('status', 3);
        return $this->db->count_all_results('guest');
    }

    public function get_cancel_reservations_count() {
        $this->db->where('status', 4);
        return $this->db->count_all_results('guest');
    }

    public function get_guest_count() {
        return $this->db->count_all('guest'); // Assuming 'guests' is the name of the table
    }

    public function get_current_guest_count() {
        $this->db->where('checkin <=', date('Y-m-d'));
        $this->db->where('checkout >=', date('Y-m-d'));
        $this->db->where_in('status', 1); // Include guests with status 1 or 3
        $this->db->from('guest'); // Assuming 'guests' is the name of the table
        return $this->db->count_all_results();
    }
}
