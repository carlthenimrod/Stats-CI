<?php
	class groups extends CI_Controller{

		public function add(){

			$this->load->helper('form');
			$this->load->library('form_validation');	

			$this->form_validation->set_rules('group_name', 'Group name', 'required|max_length[50]');

			if ($this->form_validation->run()){

				$this->group->add();

				redirect();
			}
			else{

				$this->session->set_flashdata('errors', validation_errors());

				redirect();
			}	
		}

		public function edit(){

			$this->load->helper('form');
			$this->load->library('form_validation');	

			$this->form_validation->set_rules('group-edit-name', 'Group name', 'required|max_length[50]');

			if ($this->form_validation->run()){

				$this->group->edit();

				redirect();
			}
			else{

				$this->session->set_flashdata('errors', validation_errors());

				redirect();
			}
		}
			

		public function delete(){

			$this->group->delete();

			redirect();
		}
	}