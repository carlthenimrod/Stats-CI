<?php
	class groups extends CI_Controller{

		public function add(){

			$this->load->helper('form');
			$this->load->library('form_validation');	

			$this->form_validation->set_rules('group_name', 'Group name', 'required|max_length[50]');

			$division_id = $this->input->post('division_id');

			if ($this->form_validation->run()){

				$this->group->add();

				redirect('/' . $division_id);
			}
			else{

				$this->session->set_flashdata('errors', validation_errors());

				redirect('/' . $division_id);
			}	
		}

		public function edit(){

			$this->load->helper('form');
			$this->load->library('form_validation');	

			$division_id = $this->input->post('division_id');

			$this->form_validation->set_rules('group-edit-name', 'Group name', 'required|max_length[50]');

			if ($this->form_validation->run()){

				$this->group->edit();

				redirect('/' . $division_id);
			}
			else{

				$this->session->set_flashdata('errors', validation_errors());

				redirect('/' . $division_id);
			}
		}
			

		public function delete(){

			$this->group->delete();
			
			$division_id = $this->input->get('division_id');

			redirect('/' . $division_id);
		}
	}