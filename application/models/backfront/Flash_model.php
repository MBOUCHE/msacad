<?php
    class Flash_model extends CI_Model
    {
        private $flash = 'msoft_flash';
        function __construct()
        {
            parent::__construct();
        }

        public function getFlash($key=false)
        {
            if($key)
                return $this->db->select()
                    ->from($this->flash)
                    ->where('id', $key)
                    ->get()->result();

            /*return $this->db->select()
                ->from($this->flash)
                ->get()->result();*/
                
                return $this->db->query("
                SELECT * FROM msoft_flash ORDER BY id DESC, state DESC 
                ")->result();
        }

        public function setFlash($data)
        {
            return $this->db->set($data)
                ->insert($this->flash);
        }

        public function updateState($key, $visible=true)
        {
            if($visible)
                $visible = 1;
            else
                $visible = 0;
            return $this->db->set('state', $visible)
                ->where('id', $key)
                ->update($this->flash);
        }

        public function updateContent($content, $key)
        {
            return $this->db->set('content', $content)
                ->where('id', $key)
                ->update($this->flash);
        }
    }