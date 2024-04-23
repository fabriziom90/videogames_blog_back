<h1>Ciao Admin</h1>
<p>
    Hai ricevuto una nuova email: <br>
    Nome: {{ $lead->name }} <br>
    Cognome: {{ $lead->surname }} <br>
    Email: {{ $lead->email }} <br>
    Telefono: {{ $lead->phone }} <br>
    Messaggio: <br>
    {{ $lead->content }}
</p>
