<?php


namespace app\Games\Ranking;

/**
 * A Simple RankingScheme just to show how it can be done. Don't actually use.
 */
class BasicRankingScheme extends RankingScheme
{
	/**
	 * @param \App\Games\Rank[] $ranks
	 * @param int[] $scores
	 * @throws InvalidArgumentException
	 */
	public function updateRanks($ranks, $scores)
	{
		if( count($ranks) !== count($scores) ) {
			throw new InvalidArgumentException( "There should be as many scores as ranks");
		}
		
		// I know this is stupid, but you shouldn't be using it anyways
		$mid_score = (max($scores) + min($scores)) / 2;
		foreach( $ranks as $i=>$rank ){
			if( $scores[$i] < $mid_score ) $rank->skill--;
			if( $scores[$i] > $mid_score ) $rank->skill++;
		}
	}
}