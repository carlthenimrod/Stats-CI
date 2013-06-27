<?php
	class Event extends CI_Model{

		public function get_all(){

			$query = $this->db->get('events');

			if ($query->num_rows() > 0) {

				return $query->result();
			}
			else{

				return false;
			}
		}

		public function add(){

			$home_s = $this->input->post('h_score');
			$vist_s = $this->input->post('v_score');

			if(!is_numeric($home_s) || !is_numeric($vist_s)){

				$home_s = NULL;
				$vist_s = NULL;
			}

			$data = array(

				'group_id' => $this->input->post('group_id'),
				'home_id' => $this->input->post('h_team'),
				'vist_id' => $this->input->post('v_team'),
				'home_s' => $home_s,
				'vist_s' => $vist_s,
				'loc' => $this->input->post('location'),
				'date' => $this->input->post('date'),
				'time' => $this->input->post('time')
			);

			$this->db->insert('events', $data);
		}

		public function edit(){

			$id = $this->input->post('event_id');

			$home_s = $this->input->post('h_score');
			$vist_s = $this->input->post('v_score');

			if(!is_numeric($home_s) || !is_numeric($vist_s)){

				$home_s = NULL;
				$vist_s = NULL;
			}

			$data = array(

				'group_id' => $this->input->post('group_id'),
				'home_id' => $this->input->post('h_team'),
				'vist_id' => $this->input->post('v_team'),
				'home_s' => $home_s,
				'vist_s' => $vist_s,
				'loc' => $this->input->post('location'),
				'date' => $this->input->post('date'),
				'time' => $this->input->post('time')
			);

			$this->db->where('id', $id);
			$this->db->update('events', $data); 
		}

		public function delete(){

			$id = $this->input->get('id');

			$this->db->delete('events', array('id' => $id)); 
		}
	}