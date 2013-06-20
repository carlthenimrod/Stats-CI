<?php
	class stats extends CI_Controller{

		public function index(){

			$clubs = $this->club->get_all();
			$events = $this->event->get_all();

			$data['clubs'] = sort_clubs($clubs, $events);
			$data['events'] = $events;

			$data['errors'] = $this->session->flashdata('errors');

			$this->load->view('layout/index', $data);
		}
	}