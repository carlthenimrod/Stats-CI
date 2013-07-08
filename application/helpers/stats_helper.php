<?php
	function sort_clubs($clubs, $events){

		if(!$clubs) return false;

		$arr = array();

		foreach($clubs as $club) :

			$obj = new stdClass();

			$obj->id = $club->id;
			$obj->name = $club->name;

			$stats = calculate_stats($club, $events);

			$obj->w = $stats->w;
			$obj->l = $stats->l;
			$obj->d = $stats->d;
			$obj->pts = $stats->pts;
			$obj->gf = $stats->gf;
			$obj->ga = $stats->ga;
			$obj->gd = $stats->gd;

			array_push($arr, $obj);

		endforeach;

		usort($arr, "sort_pos");

		$rank = 1;

		foreach($arr as $obj) :

			$obj->pos = $rank;

			++$rank;

		endforeach;

		return $arr;
	}

	function calculate_stats($club, $events){

		$stats = new stdClass();

		if($events){

			$stats->w = 0;
			$stats->l = 0;
			$stats->d = 0;
			$stats->pts = 0;
			$stats->gf = 0;
			$stats->ga = 0;
			$stats->gd = 0;

			foreach($events as $event) :

				if($club->id == $event->home_id){

					if($event->vist_s && $event->home_s){

						if($event->home_s > $event->vist_s){

							++$stats->w;

							$stats->pts += 3;
						}
						elseif($event->home_s < $event->vist_s){

							++$stats->l;
						}
						elseif($event->home_s == $event->vist_s){

							++$stats->d;

							++$stats->pts;
						}
					}

					$stats->gf += $event->home_s;
					$stats->ga +- $event->vist_s;
					$stats->gd += $event->home_s - $event->vist_s;

				}
				elseif($club->id == $event->vist_id){

					if($event->vist_s && $event->home_s){

						if($event->vist_s > $event->home_s){

							++$stats->w;

							$stats->pts += 3;
						}
						elseif($event->vist_s < $event->home_s){

							++$stats->l;
						}
						elseif($event->vist_s == $event->home_s){

							++$stats->d;

							++$stats->pts;
						}

					}

					$stats->gf += $event->vist_s;
					$stats->ga +- $event->home_s;
					$stats->gd += $event->vist_s - $event->home_s;

				}

			endforeach;

			return $stats;
		}
		else{

			$stats->w = 0;
			$stats->l = 0;
			$stats->d = 0;
			$stats->pts = 0;
			$stats->gf = 0;
			$stats->ga = 0;
			$stats->gd = 0;

			return $stats;
		}
	}

	function sort_pos($a, $b){

		if($a->pts == $b->pts){

			if($a->l > $b->l){

				return 1;
			}

			return 0;
		}

		return ($a->pts > $b->pts) ? -1 : 1;
	}

	function sort_events($clubs, $events){

		$arr = array();

		if(!$events) return false;

		foreach($events as $event) :

			$obj = new stdClass();
			$obj->id = $event->id;
			$obj->group_id = $event->group_id;
			$obj->h_club = find_club($event->home_id, $clubs);
			$obj->v_club = find_club($event->vist_id, $clubs);
			$obj->h_score = $event->home_s;
			$obj->v_score = $event->vist_s;
			$obj->loc = $event->loc;
			$obj->date = $event->date;
			$obj->time = $event->time;

			array_push($arr, $obj);

		endforeach;

		usort($arr, "sort_group_id");
		usort($arr, "sort_date");

		$arr = sort_like_date($arr);

		return $arr;
	}

	function sort_date($a, $b){
		if($a->date > $b->date){

			if($a->group_id != $b->group_id) return 0;

			return 1;
		}
		elseif($a->date == $b->date){

			return 0;
		}
		else{

			return -1;
		}

		return $a->date == $b->date ? 0 : ( $a->date > $b->date ) ? 1 : -1;
	}

	function sort_loc($a, $b){
		return $a->loc == $b->loc ? 0 : ( $a->loc > $b->loc ) ? 1 : -1;
	}

	function sort_group_id($a, $b){
		return $a->group_id == $b->group_id ? 0 : ( $a->group_id > $b->group_id ) ? 1 : -1;
	}

	function sort_like_date($arr){

		$new_arr = array();
		$date = false;
		$count = 0;

		foreach($arr as $obj) :

			if($obj->date != $date) :

				if($date) : 
					usort($date_obj->events, "sort_loc");
					array_push($new_arr, $date_obj);
				endif;

				$date = $obj->date;

				$date_obj = new stdClass();
				$date_obj->date = $date;
				$date_obj->group_id = $obj->group_id;
				$date_obj->events = array();

			endif;

			$sub_obj = new stdClass();

			$sub_obj->id = $obj->id;
			$sub_obj->h_club = $obj->h_club;
			$sub_obj->v_club = $obj->v_club;
			$sub_obj->h_score = $obj->h_score;
			$sub_obj->v_score = $obj->v_score;
			$sub_obj->loc = $obj->loc;
			$sub_obj->time = $obj->time;

			array_push($date_obj->events, $sub_obj);

			if(count($arr) == $count + 1) :

				usort($date_obj->events, "sort_loc");
				array_push($new_arr, $date_obj);

			else :

				++$count;

			endif;

		endforeach;

		return $new_arr;
	}

	function find_club($club_id, $clubs){

		foreach($clubs as $club) :

			if($club->id == $club_id) return $club->name;

		endforeach;

		return false;
	}

	function find_group_id($events, $group_id){

		$results = 0;
		$arr = array();

		if(!$events) return false;

		foreach($events as $event) :

			if($event->group_id == $group_id){

				array_push($arr, $event);

				++$results;
			}

		endforeach;

		if($results > 0){

			return $arr;
		}
		else{

			return false;
		}
	}

	function find_recent($clubs, $events){

		$arr = array();
		$group_id = NULL;

		if(!$events) return false;

		foreach($events as $event) :

			if(is_null($group_id) && !is_null($event->home_s) && !is_null($event->vist_s)) $group_id = $event->group_id;

			if($event->group_id != $group_id && !is_null($group_id)) break;

			if(!is_null($event->home_s) && !is_null($event->vist_s)){

				$obj = new stdClass();
				$obj->id = $event->id;
				$obj->group_id = $event->group_id;
				$obj->h_club = find_club($event->home_id, $clubs);
				$obj->v_club = find_club($event->vist_id, $clubs);
				$obj->h_score = $event->home_s;
				$obj->v_score = $event->vist_s;

				array_push($arr, $obj);
			}

		endforeach;

		return $arr;
	}

	function find_upcoming($clubs, $events){

		$arr = array();
		$group_id = NULL;

		if(!$events) return false;

		foreach($events as $event) :

			if(is_null($group_id) && is_null($event->home_s) && is_null($event->vist_s)) $group_id = $event->group_id;

			if($event->group_id != $group_id && !is_null($group_id)) break;

			if(is_null($event->home_s) && is_null($event->vist_s)){

				$obj = new stdClass();
				$obj->id = $event->id;
				$obj->group_id = $event->group_id;
				$obj->h_club = find_club($event->home_id, $clubs);
				$obj->v_club = find_club($event->vist_id, $clubs);
				$obj->date = $event->date;
				$obj->time = $event->time;

				array_push($arr, $obj);
			}

		endforeach;

		return $arr;
	}

	function to_slug($string){
    
    	return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
	}