<?php

namespace app\Games\Ranking;

use App\Games\League;
use App\Games\Rank;
use App\User;

/**
 * Class RankingScheme
 * Used to calculate the relative skills of the players.  Like ELO and friends.
 * @package app\Games\Ranking
 */
abstract class RankingScheme
{
	protected $default_skill = 100.0;
	protected $default_delta_skill = null;

	protected $league;

	public function __construct(League $league)
	{
		$this->league = $league;
	}

	/**
	 * Construct a new Rank for this User
	 * @param User $user
	 * @return Rank
	 */
	public function setUp(User $user)
	{
		$rank = new Rank();
		$rank->user = $user;
		$rank->skill = $this->default_skill;
		$rank->delta_skill = $this->default_delta_skill;
		$rank->league = $this->league;
		$rank->save();
		return $rank;
	}

	/**
	 * Takes an array of Ranks and the scores of the match, and alters them accordingly.  There should be the same
	 * number of scores as Ranks. Does not save the changes to the DB.
	 * @param Rank[] $ranks An array of Ranks with the skill values before the match.
	 * @param int[] $scores Higher numbers are better.  If win/lose use [1,0].
	 */
	abstract public function updateRanks($ranks, $scores);
}