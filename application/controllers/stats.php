<?php
	class stats extends CI_Controller{

		public function index(){

			$clubs = $this->club->get_all();
			$groups = $this->group->get_all();
			$events = $this->event->get_all();

			$data['clubs'] = sort_clubs($clubs, $events);
			$data['groups'] = $groups;
			$data['events'] = sort_events($clubs, $events);

			$data['errors'] = $this->session->flashdata('errors');

			$this->load->view('layout/index', $data);
		}
	}