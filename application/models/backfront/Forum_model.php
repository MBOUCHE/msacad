<?php

    class forum_model extends CI_Model
    {
        private $post = 'post';
        private $user = 'user';
        private $forum = 'forum';
        private $comment = 'comment';
        private $category = 'category';

        function __construct()
        {
            parent::__construct();
        }

        public function getAllForum()
        {
            return $this->db->select()
                ->from($this->forum)
                ->get()->result();
        }

        public function getForum($key='',$where=false)
        {
            if(!$where)
                $key = 'id = '.$key;

            return $this->db->select()
                ->from($this->forum)
                ->where($key)
                ->get()->result();
        }

        public function forumExist($name){
           $forum = $this->db->select()
                ->from($this->forum)
                ->where('name',$name)
                ->get()->result();

            if(!empty($forum))
                return true;
            return false;

        }

        public function getAllCategory($forumId='')
       {
           return $this->db->select()
               ->from($this->category)
               ->where('forum', $forumId)
               ->order_by('name',"ASC")
               ->get()->result();
       }

        public function getCategory($key='',$where=false)
       {
           if(!$where)
               $key = 'id = '.$key;

           return $this->db->select('c.*, f.id forum')
               ->from($this->category.' c')
               ->join($this->forum.' f', 'f.id=c.forum')
               ->where("c.".$key)
               ->order_by('c.name', 'asc')
               ->get()->result();
       }

        public function getAllPost($categoryId='')
       {
           $select = 'p.*, u.avatar, u.number_id matricule, u.firstname, u.lastname';
           return $this->db->select($select)
               ->from($this->post.' p')
               ->join($this->user.' u', 'p.user = u.id')
               ->where('category', $categoryId)
               ->order_by('post_date', 'asc')
               ->get()->result();
       }

        public function getPost($id='')
       {
           $select = 'p.*, u.avatar, u.number_id matricule, u.firstname, u.lastname';
           return $this->db->select($select)
               ->from($this->post.' p')
               ->join($this->user.' u', 'p.user = u.id')
               ->where('p.id', $id)
               ->order_by('post_date', 'asc')
               ->get()->result();
       }

        public function UpdateStatusPost($id='', $active=true)
        {
            if($active) $active = '1';
            else $active = '0';
            return $this->db->set('visible', $active)
                ->where('id', $id)
                ->update($this->post);
        }

        public function getAllComment($postId='')
        {
              $select = 'c.*, u.avatar, u.number_id matricule, u.firstname, u.lastname';
            return $this->db->select($select)
                ->from($this->comment.' c')
                ->join($this->user.' u', 'c.user = u.id')
                ->where('c.post',$postId)
                ->order_by('c.post_date', 'DESC')
                ->get()->result();
        }

        public function UpdateStatusComment($id='', $active=true)
        {
            if($active) $active = '1';
            else $active = '0';

            return $this->db->set('visible', $active)
                ->where('id', $id)
                ->update($this->comment);
        }

        public function saveForum($data)
        {
            return $this->db->set($data)->insert($this->forum);
        }

        public function updateForum($data, $id)
        {
            return $this->db->set($data)->where('id', $id)->update($this->forum);
        }

        public function saveCategory($nom, $forum)
        {
            $nom = (array)$nom;

            $this->db->trans_begin();
            foreach ($nom as $item) {
                $this->db->set(array('name'=>$item, 'forum'=>$forum, 'permalink'=>permalink($item)))->insert($this->category);
            }

            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                return false;
            } else {
                $this->db->trans_commit();
                return true;
            }
        }

        public function updateCategory($data, $id)
        {
            return $this->db->set($data)->where('id', $id)->update($this->category);
        }
        
         public function getUserPost($user=null){
            if($user == null)
                return array();
            $select = 'p.*, u.avatar, u.number_id matricule, u.firstname, u.lastname';
            return $this->db->select($select)
                ->from($this->post.' p')
                ->join($this->user.' u', 'p.user = u.id')
                ->where('u.id', $user)
                ->order_by('p.id', 'ASC')
                ->get()->result();
        }
        public function getUserComment($user,$post=null){
            $select = 'c.*, u.avatar, u.number_id matricule, u.firstname, u.lastname';
            if($post == null)
            {
                return $this->db->select($select)
                    ->from($this->comment.' c')
                    ->join($this->user.' u', 'c.user = u.id')
                    ->where('u.id', $user)
                    ->order_by('c.id', 'ASC')
                    ->get()->result();
            }


            return $this->db->select($select)
                ->from($this->comment.' c')
                ->join($this->user.' u', 'c.user = u.id')
                ->where('u.id', $user)
                ->where('c.post',$post)
                ->order_by('c.id', 'DESC')
                ->get()->result();
        }
    }