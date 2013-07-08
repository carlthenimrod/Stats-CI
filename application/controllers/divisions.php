<?php
	class divisions extends CI_Controller{

		function add(){

			$this->load->helper('form');
			$this->load->library('form_validation');	

			$this->form_validation->set_rules('division_name', 'Division name', 'required|max_length[50]');

			$division_id = $this->input->post('division_id');

			if ($this->form_validation->run()){

				$id = $this->division->add();

				redirect('/' . $id);
			}
			else{

				$this->session->set_flashdata('errors', validation_errors());

				redirect('/' . $division_id);
			}	
		}

		function delete(){

			$this->division->delete();

			redirect();
		}
	}