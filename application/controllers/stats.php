<?php
	class stats extends CI_Controller{

		public function index($id = NULL){

			if($id){

				$results = $this->division->get($id);

				if(!$results){

					$results = $this->division->get_first();
				}
			}
			else{

				$results = $this->division->get_first();
			}

			if($results){

				$division_id = $results[0]->id;
				$data['division'] =  $results[0];


				$clubs = $this->club->get_all($division_id);
				$groups = $this->group->get_all($division_id);
				$events = $this->event->get_all($division_id);

				$data['clubs'] = sort_clubs($clubs, $events);
				$data['groups'] = $groups;
				$data['events'] = sort_events($clubs, $events);

				if($events){
					usort($events, "sort_group_id");
					$recent = array_reverse($events);

					$data['recent'] = find_recent($clubs, $recent);
					$data['upcoming'] = find_upcoming($clubs, $events);
				}
				else{
					$data['recent'] = NULL;
					$data['upcoming'] = NULL;
				}
			}
			else{

				$data['clubs'] = false;
				$data['groups'] = false;
				$data['events'] = false;
				$data['division'] = false;
			}

			$data['errors'] = $this->session->flashdata('errors');

			$this->load->view('layout/header');
			$this->load->view('layout/index', $data);
			$this->load->view('layout/footer');
		}
	}