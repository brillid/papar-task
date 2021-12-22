<?php
require "Team.php";

$igra[] = array(
    "team_1" => "Team #1",
    "team_2" => "Team #2",
    "score_team_1" => 1,
    "score_team_2" => 0
);
$igra[] = array(
    "team_1" => "Team #3",
    "team_2" => "Team #2",
    "score_team_1" => 1,
    "score_team_2" => 0
);
$igra[] = array(
    "team_1" => "Team #3",
    "team_2" => "Team #1",
    "score_team_1" => 1,
    "score_team_2" => 1
);
$igra[] = array(
    "team_1" => "Team #1",
    "team_2" => "Team #4",
    "score_team_1" => 1,
    "score_team_2" => 2
);
$igra[] = array(
    "team_1" => "Team #10",
    "team_2" => "Team #20",
    "score_team_1" => 1,
    "score_team_2" => 0
);
$igra[] = array(
    "team_1" => "Team #11",
    "team_2" => "Team #21",
    "score_team_1" => 1,
    "score_team_2" => 0
);
$igra[] = array(
    "team_1" => "Team #12",
    "team_2" => "Team #23",
    "score_team_1" => 1,
    "score_team_2" => 0
);


function checkIfTeamAlreadyExists(array $teams, string $name): ?Team
{
    foreach ($teams as $team)
    {
        if ($team->getName() === $name)
        {
            return $team;
        }
    }

    return null;
}

function winner(array $games): array
{

    $teams = [];

    foreach ($games as $game)
    {
        // checking if team_1 outscores team_2
        if ($game['score_team_1'] > $game['score_team_2'])
        {
            // checking if the team already exists
            $team = checkIfTeamAlreadyExists($teams, $game['team_1']);

            // if team does not exist create one
            if ($team === null )
            {
                $team = new Team($game['team_1']);
                $teams[] = $team;
            }

            // increment points of team_1
            $team->incrementPoints();

            // add teams that team_1 won to list
            $team->addLoser($game['team_2']);

            // checking if team_2 outscores team_1
        } elseif ($game['score_team_1'] < $game['score_team_2'])
        {
            // checking if the team already exists
            $team = checkIfTeamAlreadyExists($teams, $game['team_2']);

            // if team does not exist create one
            if ($team === null )
            {
                $team = new Team($game['team_2']);

                $teams[] = $team;
            }

            // increment points of team_2
            $team->incrementPoints();

            // add teams that team_2 won to list
            $team->addLoser($game['team_1']);
        }
    }

    // sort teams by points desc
    usort($teams, function (Team $team1, Team $team2): int {
        return $team1->getPoints() < $team2->getPoints();

    });

    // catching first team by points
    $firstTeam = $teams[0];

    // catching second team by points
    $secondTeam = $teams[1];


    if ($firstTeam->getPoints() > $secondTeam->getPoints())
    {
        return $teams;
    }

    // if the first team beat second team return teams array as it is
    if ($firstTeam->isWinner($secondTeam->getName()))
    {
        return $teams;

        // if second team beat first team put it on the first place and update array
    } elseif ($secondTeam->isWinner($firstTeam->getName()))
    {
        $teams[0] = $secondTeam;
        $teams[1] = $firstTeam;
    }

    return $teams;

}
// get the result of the games
$result = winner($igra);

var_dump($result);


