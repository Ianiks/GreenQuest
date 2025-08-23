<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    public function updating(User $user)
    {
        if ($user->isDirty('points')) {
            $totalPoints = $user->points;
            $originalPoints = $user->getOriginal('points');
            
            // Calculate new trees only from increased points
            if ($totalPoints > $originalPoints) {
                $pointsGained = $totalPoints - $originalPoints;
                $treesEarned = floor($pointsGained / 20);
                
                if ($treesEarned > 0) {
                    $user->trees_planted += $treesEarned;
                    $user->points = $originalPoints + ($pointsGained % 20);
                }
            }
        }
    }
}