<?php
	class Group extends CI_Model{

		public function get_all(){

			$query = $this->db->get('groups');

			if ($query->num_rows() > 0) {

				return $query->result();
			}
			else{

				return false;
			}
		}

		public function add(){

			$name = $this->input->post('group_name');

			$data = array(

				'name' => $name
			);

			$this->db->insert('groups', $data);
		}

		public function edit(){

			$id = $this->input->post('group-edit-id');
			$name = $this->input->post('group-edit-name');

			$this->db->where('id', $id);
			$this->db->update('groups', array('id' => $id, 'name' => $name )); 
		}		

		public function delete(){

			$id = $this->input->get('id');

			$this->db->delete('groups', array('id' => $id));
			$this->db->delete('events', array('group_id' => $id)); 
		}		
	}