<?php

namespace App\Enum;

enum CompetitionStatus: string
{
    case CREATED = 'created';
    case SCHEDULED = 'scheduled';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';
    case CANCELED = 'canceled';
    case POSTPONED = 'postponed';
}
