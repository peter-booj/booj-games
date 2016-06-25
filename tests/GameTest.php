<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Carbon\Carbon;
use App\Games\League;
use App\Games\Match;
use App\Games\Rank;
use App\User;

class GameTest extends TestCase
{
    /**
     * Test the ranking schemes.  Don't try too hard, but check that we can make
     *
     * @return void
     */
    public function testRankingSchemes()
    {
        $winner = User::where('name', 'Winner')->first();
        if( ! $winner ) {
            $winner = new User();
            $winner->name = 'Winner';
            $winner->email = 'winner@booj.com';
            $winner->password = 'password';
            $winner->save();
        }
        $this->assertInstanceOf(User::class, $winner);
        
        $loser = User::where('name', 'Loser')->first();
        if( ! $loser ) {
            $loser = new User();
            $loser->name = 'Loser';
            $loser->email = 'loser@booj.com';
            $loser->password = 'password';
            $loser->save();
        }
        $this->assertInstanceOf(User::class, $loser);
        
        $basic_league = new League();
        $basic_league->name = 'Basic League';
        $basic_league->ranking_scheme = 'BasicRankingScheme';
        $basic_league->possible_teams = 0;
        $basic_league->save();

        
        $current_match = Match::SetUp($basic_league, [$winner, $loser], Carbon::now());
        $this->assertInstanceOf(Match::class, $current_match);
        $this->assertEquals($current_match->id, Match::current()->first()->id);

        $current_match->setFinalScore(1, 0);
        $this->assertNotNull($current_match->completed);

        $winner_rank = Rank::where('user_id', $winner->id)->where('league_id', $basic_league->id)->first();
        $loser_rank = Rank::where('user_id', $loser->id)->where('league_id', $basic_league->id)->first();
        $this->assertLessThan($winner_rank->skill, $loser_rank->skill);

        $basic_league->delete();
    }
}
