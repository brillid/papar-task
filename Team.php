<?php

class Team
{

    private string $name;

    private int $points = 0;

    private array $losers = [];

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function incrementPoints(): void
    {
        $this->points++;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPoints(): int
    {
        return $this->points;
    }

    public function addLoser($loser): void
    {
        $this->losers[] = $loser;
    }

    public function isWinner($name): bool
    {
        foreach ($this->losers as $teamName)
        {
            if ($teamName === $name)
            {
                return true;
            }
        }
        return false;
    }





}