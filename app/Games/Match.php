<?php namespace App\Games;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Match
 * An indivual match between two or more competitors.  Can be planned ahead.
 * @package App\Games
 */
class Match extends Model {

	//

	protected $timestamps = false;

	public function league()
	{
		return $this->belongsTo('App\Games\League');
	}


	/**
	 * Matches that are currently being played.
	 * @param Builder $query
	 * @return Builder
	 */
	public function scopeCurrent(Builder $query)
	{
		return $query->where('scheduled', '<', date('Y-m-d H:i:s'))->whereNull('completed');
	}
}
