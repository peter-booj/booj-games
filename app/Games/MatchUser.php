<?php namespace App\Games;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MatchUser
 * Pivot class between matches and users
 * @package App\Games
 */
class MatchUser extends Model {

	protected $table = 'match_user';
}
