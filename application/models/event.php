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
	}