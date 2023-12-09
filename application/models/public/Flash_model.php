<?php
    class Flash_model extends CI_Model
    {
        private $flash = 'msoft_flash';
        function __construct()
        {
            parent::__construct();
        }

        public function get()
        {
            return $this->db->select()
                ->from($this->flash)
                ->order_by('id','DESC')
                ->where('state',1)
                ->limit(5)
                ->get()
                ->result();
        }
    }