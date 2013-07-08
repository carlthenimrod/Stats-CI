<?php
	class events extends CI_Controller{

		public function add(){
			
			$division_id = $this->input->post('division_id');

			$this->load->helper('form');
			$this->load->library('form_validation');	

			$this->form_validation->set_rules('group_id', 'Group ID', 'required|integer');

			$this->form_validation->set_rules('h_team', 'Home Team', 'required|integer');
			$this->form_validation->set_rules('v_team', 'Visitor Team', 'required|integer');

			$this->form_validation->set_rules('h_score', 'Home Score', 'integer');
			$this->form_validation->set_rules('v_score', 'Visitor Score', 'integer');

			$this->form_validation->set_rules('location', 'Location', 'required|max_length[50]');
			$this->form_validation->set_rules('date', 'Date', 'required|max_length[50]');
			$this->form_validation->set_rules('time', 'Time', 'required|max_length[50]');

			if ($this->form_validation->run()){

				$this->event->add();

				redirect('/' . $division_id);
			}
			else{

				$this->session->set_flashdata('errors', validation_errors());

				redirect('/' . $division_id);
			}	
		}

		public function edit(){
			
			$division_id = $this->input->post('division_id');

			$this->load->helper('form');
			$this->load->library('form_validation');	

			$this->form_validation->set_rules('group_id', 'Group ID', 'required|integer');

			$this->form_validation->set_rules('h_team', 'Home Team', 'required|integer');
			$this->form_validation->set_rules('v_team', 'Visitor Team', 'required|integer');

			$this->form_validation->set_rules('h_score', 'Home Score', 'integer');
			$this->form_validation->set_rules('v_score', 'Visitor Score', 'integer');

			$this->form_validation->set_rules('location', 'Location', 'required|max_length[50]');
			$this->form_validation->set_rules('date', 'Date', 'required|max_length[50]');
			$this->form_validation->set_rules('time', 'Time', 'required|max_length[50]');

			if ($this->form_validation->run()){

				$this->event->edit();

				redirect('/' . $division_id);
			}
			else{

				$this->session->set_flashdata('errors', validation_errors());

				redirect('/' . $division_id);
			}	
		}

		public function delete(){

			$this->event->delete();

			$division_id = $this->input->get('division_id');

			redirect('/' . $division_id);
		}
	}