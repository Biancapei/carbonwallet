<?php

namespace App\Http\Controllers;

use App\Models\Waitlist;
use App\Notifications\WaitlistConfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class WaitlistController extends Controller
{
    /**
     * Display the waitlist form.
     */
    public function index()
    {
        return view('waitlist');
    }

    /**
     * Store a new waitlist entry and send confirmation email.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:waitlist,email',
            'name' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'message' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Create waitlist entry
            $waitlistEntry = Waitlist::create([
                'email' => $request->email,
                'name' => $request->name,
                'company' => $request->company,
                'message' => $request->message,
            ]);

            // Send confirmation email
            try {
                Notification::route('mail', $request->email)
                    ->notify(new WaitlistConfirmation($waitlistEntry));

                // Update email sent status
                $waitlistEntry->update([
                    'email_sent' => true,
                    'email_sent_at' => now(),
                ]);

                Log::info('Waitlist confirmation email sent successfully to: ' . $request->email);

            } catch (\Exception $emailError) {
                // Log email sending error but don't fail the request
                Log::error('Email sending failed: ' . $emailError->getMessage());
                Log::error('Email error stack: ' . $emailError->getTraceAsString());

                // Mark email as not sent
                $waitlistEntry->update([
                    'email_sent' => false,
                    'email_sent_at' => null,
                ]);
            }

            return redirect()->back()->with('success', 'Thank you for joining our waitlist! Check your email for confirmation.');

        } catch (\Exception $e) {
            // Log the actual error for debugging
            Log::error('Waitlist submission error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            return redirect()->back()
                ->withErrors(['error' => 'Something went wrong. Please try again.'])
                ->withInput();
        }
    }
}
