<?php

/**
 * 
 */

class Paid extends CI_Model {

        public $id_paid;
        public $id_op;
        public $remaining_amount;
        public $reference;
        public $id_lesson;
        public $id_user;
        public $date_paid;
        public $validation_state;
        public $total_slice;
        public $num_slice;
        public $formation_type;
        public $id_wave;


        public function __construct()
        {
            parent:: __construct();
            $this->load->model('e_models/e_admin/wave');
        }

        public function hydrate(array $donnees)
        {
            $tab = array();
            foreach ($donnees as $key => $value)
            {
                //$method = ucfirst($key);
                $this->$key = $value;
                $tab[$key] = $value;
            }
            return $this;
        }

        public function get_here()
        {
            $tab = array();
            $tab['id_paid'] = $this->id_paid;
            $tab['id_op'] = $this->id_op;
            $tab['remaining_amount'] =$this->remaining_amount;
            $tab['reference'] =$this->reference;
            $tab['id_lesson'] =$this->id_lesson;
            $tab['id_user'] = $this->id_user;
            $tab['date_paid'] =$this->date_paid;
            $tab['validation_state'] = $this->validation_state;
            $tab['total_slice'] =$this->total_slice;
            $tab['num_slice'] =$this->num_slice;
            $tab['formation_type'] =$this->formation_type;
            return $tab;
        }

        public function get_last_ten_entries()
        {
                $query = $this->db->get('e_paid', 10);
                return $query->result();
        }

        public function get_inscription_all() {
            return $this->db->get('e_paid')->result_array();
        }

        public function get_inscription_wait() 
        {
            return $this->db->get_where('e_paid' , array('validation_state' => '0') )->result_array();
        }

        public function get_inscription_validate() {
            return $this->db->get_where('e_paid' , array('validation_state' => '1') )->result_array();
        }

        public function get_inscription_reject()
        {
            return $this->db->get_where('e_paid' , array('validation_state' => '-1') )->result_array();
        }

        public function list_wave( $id_lesson='' , $formation_type='' ) {
            return $this->db->get_where('e_wave' , 'id_lesson='.$id_lesson.' and type_wave='.$formation_type )->result_array();
        }

        public function insert_entry()
        {
                $this->id_op = $_POST['id_op']; // please read the below note
                $this->remaining_amount = $_POST['remaining_amount'];
                $this->reference = $_POST['reference'];
                $this->id_lesson = $_POST['id_lesson'];
                $this->date_paid = $_POST['date_paid'];
                $this->id_user = $_POST['id_user'];
                $this->validation_state = $_POST['validation_state'];
                $this->total_slice = $_POST['total_slice'];
                $this->num_slice = $_POST['num_slice'];
                $this->formation_type = $_POST['formation_type'];

                $this->db->insert('e_paid', $this);
        }

        public function get($id_paid){
            return $this->db->get_where('e_paid' , 'id_paid='.$id_paid)->row_array();
        }

        public function get_details($id_paid){
            $details = array();
            $query = $this->get($id_paid);
            if ( ! is_null($query ) ) {

            $details['firstname'] = $this->db->select('firstname')->from('user')->where('id',$query['id_user'])->get()->row()->firstname;
            $details['label'] = $this->db->select('label')->from('lesson')->where('id',$query['id_lesson'])->get()->row()->label;

            $operator = $this->db->select('name_op')->from('e_operator')->where('id_op',$query['id_op'])->get()->row();
            // $details['numbers_used'] = $operator->numbers_used;
            $details['name_op'] = $operator->name_op;
            if ( $query['id_wave'] != null){
                $details['limit_date'] = $this->wave->get_limit_date($id_paid , $query['id_wave']);
            }
            
            }
            // if ($query['total_slice'] == '1' and $qquery['num_slice'] == '1' ) {
            //     $details['next_delay'] = $this->db->select('*')->from('e_wave')->where('id_wave',$query['id_wave'])->get()->row()->date_end;             
            // }
            // if ( $query['total_slice'] >= 2 and $query['num_slice'] >= 2 ) {
            //     $details['next_delay'] = $this->db->select('delay_'.$query['total_slice'].'_'.$query['num_slice'])->from('e_delay')->where('id_wave',$query['id_wave'])->get()->result_array;             
            // }

            // $details['next_delay'] = $this->db->select('')->from('e_operator')->where('id_op',$query['id_op'])->get()->row()->name_op;
            // }
            return $details;
        }


        public function reject($id_paid){
            $this->db->update('e_paid' , array('validation_state' => '-1' ) , 'id_paid='.$id_paid);
        }

        public function accept($id_paid , $id_wave){
            $this->db->update('e_paid' , array('validation_state' => '1' , 'id_wave' => $id_wave) , 'id_paid='.$id_paid);
        }

        public function list_paid_user_wave($id_user , $id_wave){
            return $this->db->get_where( 'e_paid' , array('id_user'=>$id_user , 'id_wave'=>$id_wave) )->result();
        }

        

}