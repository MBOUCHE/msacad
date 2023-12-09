<?php

/**
 * 
 */

class Question extends CI_Model {

        public $id_question;
        public $question;
        public $answer;
        public $prop1;
        public $prop2;
        public $prop3;
        public $point;
        public $id_exercise;
        public $type_question;

        public function hydrate(array $donnees)
        {
            foreach ($donnees as $key => $value)
            {
                //$method = ucfirst($key);
                    $this->$key = $value;
            }
            return $this;
        }

        public function insert_entry()
        {
                $this->question = $_POST['question']; // please read the below note
                $this->answer = $_POST['answer'];
                if ($_POST['type_question'] == 'QRU') {
                    $this->prop1 = $_POST['prop1'];
                    $this->prop2 = $_POST['prop2'];
                    $this->prop3 = $_POST['prop3'];
                }                
                $this->point = $_POST['point'];
                $this->id_exercise = $_POST['id_exercise'];
                $this->type_question = $_POST['type_question'];

                $this->db->insert('e_question', $this);
        }

        public function get_question($id_question){
            return $this->db->get_where('e_question' , array('id_question'=>$id_question) )->row();
        }

        public function copy_question($id_new_exercise , $id_question){
            $question = $this->get_question($id_question);
            unset($question->id_question);
            $question->id_exercise = $id_new_exercise;
            $this->db->insert( 'e_question' , $question );
        }
        
        public function get(){
            $tab = array();
            $tab['id_question'] = $this->id_question;
            $tab['question'] = $this->question;
            $tab['answer'] = $this->answer;
            $tab['prop1'] = $this->prop1;
            $tab['prop2'] = $this->prop2;
            $tab['prop3'] = $this->prop3;
            $tab['point'] = $this->point;
            $tab['id_exercise'] = $this->id_exercise;
            $tab['type_question'] = $this->type_question;
            return $tab;
        }

        public function get_exercise_question($id_exercise)
        {
            $list = array();
            $this->db->from('e_question');
            $this->db->where('id_exercise',$id_exercise);
            $query = $this->db->get();
            foreach ($query->result() as $question) {
                $list[] = $question;
            }
                
                return $list;
        }

        public function get_last_ten_entries()
        {
                $query = $this->db->get('e_question', 10);
                return $query->result();
        }

        public function modify_question(){
            $id_question = $_POST['id_question'];
            $tab = array();
            $tab['id_question'] = $_POST['id_question'];
            $tab['id_exercise'] = $_POST['id_exercise'];
            $tab['question'] = $_POST['question'.$id_question];
            $tab['answer'] = $_POST['answer'.$id_question];
            $tab['point'] = $_POST['point'.$id_question];
            $tab['type_question'] = $_POST['type_question'.$id_question];

            if( $_POST['type_question'.$id_question] == 'QRU' )
            {
                $tab['prop1'] = $_POST['prop1'.$id_question];
                $tab['prop2'] = $_POST['prop2'.$id_question];
                $tab['prop3'] = $_POST['prop3'.$id_question];
            }

            return $this->db->update('e_question' , $tab , 'id_question = '.$id_question  );
            
        }

        
        
}