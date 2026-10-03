<h2>Nouveau message depuis votre portfolio</h2>

<p><strong>Nom :</strong> {{ $contact->name }}</p>
<p><strong>Email :</strong> {{ $contact->email }}</p>
@if ($contact->subject)
    <p><strong>Sujet :</strong> {{ $contact->subject }}</p>
@endif

<p><strong>Message :</strong></p>
<p>{!! nl2br(e($contact->message)) !!}</p>

<hr>
<small>Reçu le {{ $contact->created_at->format('d/m/Y à H:i') }} (IP : {{ $contact->ip_address }})</small>