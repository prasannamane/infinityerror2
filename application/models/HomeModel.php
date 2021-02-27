<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class HomeModel extends CI_model 
    {
        public function update_any($table_name, $array_data, $cond)
        {
            //            $this->db->set('like_', 'like_+1', FALSE);        
            $this->db->where($cond);
            return $this->db->update($table_name, $array_data);
            
        }
        
        public function view_($table_name, $array_data)
        {
            $this->db->set('view', 'view+1', FALSE);        
            $this->db->where($array_data);
            return $this->db->update($table_name);
        }
        
        public function like_($table_name, $array_data)
        {
            $this->db->set('like_', 'like_+1', FALSE);        
            $this->db->where($array_data);
            return $this->db->update($table_name);
        }
        
        public function like_d($table_name, $array_data)
        {
            $this->db->set('like_', 'like_-1', FALSE);        
            $this->db->where($array_data);
            return $this->db->update($table_name);
        }
        
        public function dislike($table_name, $array_data)
        {
            $this->db->set('dislike', 'dislike+1', FALSE);        
            $this->db->where($array_data);
            return $this->db->update($table_name);
        }
        
        public function disliked($table_name, $array_data)
        {
            $this->db->set('dislike', 'dislike-1', FALSE);        
            $this->db->where($array_data);
            return $this->db->update($table_name);
        }
        
        public function quetions()
        {
            $query = $this->db->select('q.id, q.title, q.user_id, q.video, q.description, q.vote, q.view, q.answer, q.created_at, q.updated_at, s.name')
            ->from('quetions as q')
            ->join('signup as s', 'q.user_id = s.id', 'LEFT')
            ->get();
            return $query->result_array();
        }

        public function quetions_search($tbl, $search)
        {
            $query = $this->db->select('q.id, q.title, q.user_id, q.video, q.description, q.vote, q.view, q.answer, q.created_at, q.updated_at, s.name')
            ->from('quetions as q')
            ->join('signup as s', 'q.user_id = s.id', 'LEFT')
            ->like('q.title', $search)
            ->get();
            return $query->result_array();
        }
        
        public function insert_data($table_name, $array_data) 
        {
            return $this->db->insert($table_name, $array_data);
        }
        
        
        public function select_cond_data($table_name, $array_data)
        {
            $query = $this->db->select('*')
		         ->from($table_name)
		         ->where($array_data)
		         ->get();
		         
            return $query->result_array();
        }
        
        public function getall($table_name)
        {
            //SELECT * FROM `quetions`
            $query = $this->db->select('*')
		         ->from($table_name)
		        
		         ->get();
		         
            return $query->result_array();
            //print_r($this->db->last_query());
        }    


		
    }
