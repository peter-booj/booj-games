<?php namespace App\Games;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Rank
 * A user's skill in a specific league.  Since skill is relative, we shouldn't actually show it.  We should only show
 * 1st, 2nd, 3rd, ...
 * @package App\Games
 */
class Rank extends Model {

	public function user(){
		return $this->belongsTo('App\User');
	}
	public function league(){
		return $this->belongsTo('App\Games\League');
	}

}
