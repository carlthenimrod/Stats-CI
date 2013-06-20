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

					$stats->gf += $event->home_s;
					$stats->ga +- $event->vist_s;
					$stats->gd += $event->home_s - $event->vist_s;

				}
				elseif($club->id == $event->vist_id){

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
	};

	function build_json($clubs){

		$i = 0;
		$len = count($clubs);

		$json = '{ "clubs": [ ';

		foreach($clubs as $club) :

			$json .= '{

				"id": '.$club->id.',
				"name": "'.$club->name.'",
				"w": '.$club->w.',
				"l": '.$club->l.',
				"d": '.$club->d.',
				"pts": '.$club->pts.',
				"gf": '.$club->gf.',
				"ga": '.$club->ga.',
				"gd": '.$club->gd.'
			}';

			if ($i != $len - 1) {
				
				$json .= ",";
			}

			$i++;

		endforeach;

		$json .= ' ] }';

		return $json;
	}