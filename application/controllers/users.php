<?php 
	class Users extends CI_Controller{

		function login(){

			if($this->session->userdata('logged_in')) redirect();

			if($this->input->post()){

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

					redirect('login');
				}
			}
			else{

				$this->load->view('layout/header');
				$this->load->view('login');
				$this->load->view('layout/footer');
			}
		}

		function logout(){

			$this->session->unset_userdata('email');
			$this->session->unset_userdata('logged_in');

			redirect();
		}
	}