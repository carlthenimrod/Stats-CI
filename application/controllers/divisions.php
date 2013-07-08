<?php
	class divisions extends CI_Controller{

		function add(){

			$this->load->helper('form');
			$this->load->library('form_validation');	

			$this->form_validation->set_rules('division_name', 'Division name', 'required|max_length[50]|is_unique[divisions.name]');

			$slug = to_slug($this->input->post('division_name'));
			
			$_POST['slug'] = $slug;

			$this->form_validation->set_rules('slug', 'Slug', 'required|max_length[50]|is_unique[divisions.slug]');

			if ($this->form_validation->run()){

				$slug = $this->division->add();

				redirect('/stats/' . $slug);
			}
			else{

				$this->session->set_flashdata('errors', validation_errors());

				redirect($this->session->flashdata('redirect'));
			}
		}

		function delete(){

			$this->division->delete();

			redirect();
		}
	}