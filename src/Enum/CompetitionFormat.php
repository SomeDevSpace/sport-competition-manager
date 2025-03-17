<?php

namespace App\Enum;

enum CompetitionFormat: string
{
    case TOURNAMENT = 'tournament';
    case LEAGUE = 'league';
    case INDIVIDUAL = 'individual';
}
