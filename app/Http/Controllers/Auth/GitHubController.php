<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class GitHubController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleProviderCallback()
    {
        try {
            $githubUser = Socialite::driver('github')->user();
            Log::info('GitHub User: ' . json_encode($githubUser));

            $user = User::updateOrCreate([
                'github_id' => $githubUser->id,
            ], [
                'name' => $githubUser->name,
                'email' => $githubUser->email,
                'avatar' => $githubUser->avatar,
            ]);

            Auth::login($user, true);

            return redirect('/home');
        } catch (\Exception $e) {
            Log::error('Error during GitHub authentication: ' . $e->getMessage());
            return redirect('/')->with('error', 'Something went wrong.');
        }
    }
}
