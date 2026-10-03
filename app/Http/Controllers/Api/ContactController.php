<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactMessageRequest;
use App\Mail\NewContactMessage;
use App\Models\ContactMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Throwable;

class ContactController extends Controller
{
    public function store(StoreContactMessageRequest $request): JsonResponse
    {
        // Honeypot : un humain ne remplit jamais ce champ caché.
        // On répond "succès" aux robots sans rien enregistrer.
        if ($request->filled('website')) {
            return $this->success();
        }

        $contact = ContactMessage::create([
            ...$request->safe()->only(['name', 'email', 'subject', 'message']),
            'ip_address' => $request->ip(),
        ]);

        // Le message est déjà en base : une panne d'envoi d'email ne le fait pas perdre.
        try {
            Mail::to(config('portfolio.contact_email'))->send(new NewContactMessage($contact));
        } catch (Throwable $e) {
            report($e);
        }

        return $this->success();
    }

    private function success(): JsonResponse
    {
        return response()->json([
            'message' => 'Merci ! Votre message a bien été envoyé.',
        ], 201);
    }
}