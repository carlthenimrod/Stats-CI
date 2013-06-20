<?php
	class clubs extends CI_Controller{

		public function add(){

			$this->load->helper('form');
			$this->load->library('form_validation');	

			$this->form_validation->set_rules('club_name', 'Club name', 'required|max_length[50]');

			if ($this->form_validation->run()){

				$this->club->add();

				redirect();
			}
			else{

				$this->session->set_flashdata('errors', validation_errors());

				redirect();
			}		
		}
		
		public function delete(){

			$this->club->delete();

			redirect();
		}

		public function edit(){

			$this->load->helper('form');
			$this->load->library('form_validation');	

			$this->form_validation->set_rules('club-edit-name', 'Club name', 'required|max_length[50]');

			if ($this->form_validation->run()){

				$this->club->edit();

				redirect();
			}
			else{

				$this->session->set_flashdata('errors', validation_errors());

				redirect();
			}
		}
	}