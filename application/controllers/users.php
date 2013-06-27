<?php 
	class Users extends CI_Controller{

		function login(){

			$this->load->model('user');

			if($this->user->validate()){

				$data = array(

					'email' => $this->input->post('email'),
					'logged_in' => true
				);

				$this->session->set_userdata($data);

				redirect();
			}
			else{

				$this->session->set_flashdata('errors', 'Login Failed! Check your email/password.');

				redirect();
			}
		}

		function logout(){

			$this->session->unset_userdata('email');
			$this->session->unset_userdata('logged_in');

			redirect();
		}
	}