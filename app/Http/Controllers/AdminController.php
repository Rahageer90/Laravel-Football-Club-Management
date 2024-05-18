<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Match;
use App\Models\Injury;
use App\Models\TrainingSession;

class AdminController extends Controller
{
    public function dashboard()
    {
        $upcomingMatches = Match::where('date', '>=', now())->orderBy('date', 'asc')->limit(5)->get();
        $recentInjuries = Injury::with('player')->orderBy('date_of_injury', 'desc')->limit(5)->get();
        $recentTrainingSessions = TrainingSession::orderBy('date', 'desc')->limit(5)->get();

        return response()->json([
            'upcoming_matches' => $upcomingMatches,
            'recent_injuries' => $recentInjuries,
            'recent_training_sessions' => $recentTrainingSessions,
        ]);
    }

    public function announceMatchForm()
    {
        return response()->json(['message' => 'Form data here']);
    }

    public function announceMatch(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'date' => 'required|date',
            'time' => 'required',
            'opponent' => 'required|string',
            'venue' => 'required|string',
        ]);

        // Create a new match
        Match::create([
            'date' => $validatedData['date'],
            'time' => $validatedData['time'],
            'opponent' => $validatedData['opponent'],
            'venue' => $validatedData['venue'],
            'result' => 'TBA', // Default result
        ]);

        return response()->json(['message' => 'Match announced successfully.']);
    }

    public function deleteMatch($match_id)
    {
        $match = Match::findOrFail($match_id);
        $match->delete();

        return response()->json(['message' => 'Match deleted successfully.']);
    }

    public function updateMatchForm($match_id)
    {
        $match = Match::findOrFail($match_id);
        $players = $match->players; // Assuming there's a relationship defined in the Match model

        return response()->json([
            'match' => $match,
            'players' => $players,
        ]);
    }

    public function updateMatch(Request $request, $match_id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'result' => 'required|string',
            'players' => 'array',
            'players.*.player_id' => 'required|integer',
            'players.*.minutes_played' => 'required|integer',
            'players.*.goals_scored' => 'required|integer',
            'players.*.rating' => 'required|integer|min:0|max:10',
        ]);

        // Update match result
        $match = Match::findOrFail($match_id);
        $match->update(['result' => $validatedData['result']]);

        // Update player stats
        foreach ($validatedData['players'] as $playerData) {
            $match->players()->updateExistingPivot($playerData['player_id'], [
                'minutes_played' => $playerData['minutes_played'],
                'goals_scored' => $playerData['goals_scored'],
                'rating' => $playerData['rating'],
            ]);
        }

        return response()->json(['message' => 'Match and player stats updated successfully.']);
    }
}
