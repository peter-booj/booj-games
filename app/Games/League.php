<?php
namespace App\Games;

use Illuminate\Database\Eloquent\Model;

/**
 * Class League
 * "League" might be the wrong word.  It's used for things like "Foozball" and "Table Tennis".
 * @package App\Games
 */
class League extends Model {

	//
	protected $table = 'leagues';

	public function matches()
	{
		return $this->hasMany('App\Games\Match');
	}
	public function ranks()
	{
		return $this->hasMany('App\Games\Rank');
	}
}
