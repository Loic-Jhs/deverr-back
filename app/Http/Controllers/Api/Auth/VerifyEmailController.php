<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResendEmailVerificationRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class VerifyEmailController extends Controller
{
    /**
     * @param $id
     * @param $hash
     * @return Redirector|Application|RedirectResponse|View
     */
    public function verifyEmail($id, $hash): Redirector|Application|RedirectResponse|View
    {
        $user = User::find($id);
        abort_if(! $user, 404);
        // abort if the hashes don't match
        abort_if(! hash_equals((string) $hash, sha1($user->getEmailForVerification())), 404);

        // if the user has already verified their email
        if (! $user->hasVerifiedEmail()) {
            // mark the user as verified in database with the email_verified_at column
            $user->markEmailAsVerified();

            // set the account as active
            $user->is_account_active = 1;
            $user->update();
            // fire the Verified event
            event(new Verified($user));
        }

        return view('verified-account', compact('user'));
    }

    /**
     * @param ResendEmailVerificationRequest $request
     * @return JsonResponse
     */
    public function resendEmailVerification(ResendEmailVerificationRequest $request): JsonResponse
    {
        // get the user by email
        $user = User::where('email', $request->email)->first();

        // resend the verification email
        $user->sendEmailVerificationNotification();

        return response()->json(
            ['message' => "Un lien de vérification d'email viens d'être à nouveau envoyé."]
        );
    }
}
