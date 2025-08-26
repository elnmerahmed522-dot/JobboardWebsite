<?php
namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CandidateProfileController extends Controller
{
    // Show own profile
    public function showSelf()
    {
        $profile = Auth::user()->profile;
        return view('candidate.profile.show', [
            'user' => Auth::user(),
            'profile' => $profile
        ]);
    }

    // Edit own profile
    public function edit()
    {
        $profile = Auth::user()->profile ?? new Profile(['user_id' => Auth::id()]);
        return view('candidate.profile.edit', compact('profile'));
    }

    // Update own profile
    public function update(Request $request)
    {
        $request->validate([
            'headline'   => 'nullable|string|max:255',
            'bio'        => 'nullable|string',
            'location'   => 'nullable|string|max:255',
            'phone'      => 'nullable|string|max:50',
            'linkedin'   => 'nullable|url',
            'github'     => 'nullable|url',
            'skills'     => 'nullable|string',
            'experience' => 'nullable|string',
            'resume'     => 'nullable|mimes:pdf,doc,docx|max:4096',
        ]);

        $data = $request->only([
            'headline','bio','location','phone','linkedin','github','skills','experience'
        ]);

        // handle resume upload
        if ($request->hasFile('resume')) {
            $data['resume'] = $request->file('resume')->store('resumes', 'public');
        }

        $profile = Auth::user()->profile;

        if ($profile) {
            $profile->update($data);
        } else {
            $data['user_id'] = Auth::id();
            $profile = Profile::create($data);
        }

        return redirect()->route('candidate.profile.show')->with('success', 'Profile updated successfully.');
    }

    // Public view of a candidate's profile
    public function showPublic(User $user)
    {
        $profile = $user->profile;

        if (!$profile) {
            abort(404); // no profile yet
        }

        return view('profiles.show', [
            'user' => $user,
            'profile' => $profile
        ]);
    }
}
