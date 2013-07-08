<?php
	class division extends CI_Model{

		public function get($slug){
			
			$query = $this->db->get_where('divisions', array('slug' => $slug), 1);

			if($query->num_rows() > 0){

				return $query->result();
			}
			else{

				return false;
			}
		}

		public function get_first(){

			$query = $this->db->get('divisions', 1);

			if($query->num_rows() > 0){

				return $query->result();
			}
			else{

				return false;
			}
		}

		public function add(){

			$name = $this->input->post('division_name');
			$slug = $this->input->post('slug');

			$data = array(

				'name' => $name,
				'slug' => $slug
			);

			$this->db->insert('divisions', $data);

			return $slug;
		}

		public function delete(){

			$id = $this->input->get('id');

			$this->db->delete('divisions', array('id' => $id));
			$this->db->delete('clubs', array('division_id' => $id)); 
			$this->db->delete('groups', array('division_id' => $id));
			$this->db->delete('events', array('division_id' => $id)); 
		}		
	}