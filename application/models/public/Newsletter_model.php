<?php
class Newsletter_model extends CI_Model
{

    private $table = "mailing";

    public function addUser($post){

        if (isset($post['email']) And !empty($this->db->select('id')->from($this->table)->where('email', $post['email'])->get()->result())) {
            return 'Cet email est déjà inscrit à notre newsletter.';
        }

        return $this->db->set($post)->insert('mailing');
    }

    public function check_mail($email){
        if (!empty($this->db->select('id')->from($this->table)->where('email', $email)->get()->result())) {
            return true;
        }
        return false;
    }

    public function signoutUser($email){
        $this->db->query('DELETE FROM mailing WHERE email=?',array($email));
    }
}