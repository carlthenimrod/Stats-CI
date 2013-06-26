<?php
	class Club extends CI_Model{

		public function add(){

			$name = $this->input->post('club_name');

			$data = array(

				'name' => $name
			);

			$this->db->insert('clubs', $data);
		}

		public function edit(){

			$id = $this->input->post('club-edit-id');
			$name = $this->input->post('club-edit-name');

			$this->db->where('id', $id);
			$this->db->update('clubs', array('id' => $id, 'name' => $name )); 
		}

		public function delete(){

			$id = $this->input->get('id');

			$this->db->delete('clubs', array('id' => $id)); 
			$this->db->delete('events', array('home_id' => $id)); 
			$this->db->delete('events', array('vist_id' => $id)); 
		}

		public function get_all(){

			$query = $this->db->get('clubs');

			if($query->num_rows() > 0) {

				return $query->result();
			}
			else{

				return false;
			}
		}
	}