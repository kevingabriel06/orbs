<?php
class Auth_model extends CI_Model
{
    function can_login($email, $password)
    {
        // Retrieve user information based on the provided email
        $this->db->where('email', $email);
        $query = $this->db->get('users');
    
        // Check if any user exists with the provided email
        if ($query->num_rows() > 0)
        {
            // Iterate through the result set
            foreach ($query->result() as $row)
            {
                // Verify the provided password with the stored hash
                if (password_verify($password, $row->password))
                {
                    // Set session data for user_id and role
                    $this->session->set_userdata(array(
                        'user_id' => $row->user_id,
                        'role' => $row->role,
                    ));
                    
                    // Return success status
                    return 'Login Successful';
                }
                else
                {
                    // Return error message for incorrect password
                    return 'Wrong Password';
                }
            }
        }
        else
        {
            // Return error message for incorrect email
            return 'Wrong Email Address';
        }
    }
}
