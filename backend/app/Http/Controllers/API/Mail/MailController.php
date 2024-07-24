<?php
namespace App\Http\Controllers\API\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    /**
     * Send a registration email.
     */
    public function sendEmail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $email = $request->email;
        $subject = "Registration Request";
        $registrationLink = "http://127.0.0.1:8000/register";

        $message = "Thank you for your interest in becoming our partner. Please click the following link to register: " . $registrationLink;

        // Send the email
        Mail::raw($message, function ($message) use ($email, $subject) {
            $message->to($email)
                ->subject($subject);
        });

        return response()->json(['message' => 'Email sent successfully']);
    }
}