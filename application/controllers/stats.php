<?php
	class stats extends CI_Controller{

		public function index(){

			$clubs = $this->club->get_all();
			$groups = $this->group->get_all();
			$events = $this->event->get_all();

			$data['clubs'] = sort_clubs($clubs, $events);
			$data['groups'] = $groups;
			$data['events'] = sort_events($clubs, $events);

			usort($events, "sort_group_id");
			$recent = array_reverse($events);

			$data['recent'] = find_recent($clubs, $recent);
			$data['upcoming'] = find_upcoming($clubs, $events);

			$data['errors'] = $this->session->flashdata('errors');

			$this->load->view('layout/header');
			$this->load->view('layout/index', $data);
			$this->load->view('layout/footer');
		}
	}