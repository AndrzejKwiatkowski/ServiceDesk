<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Service Desk</h1>
    Zgłoszenie o numerze: {{$tickSol->ticket_id}} <br/>
    Treść rozwiązania: {{$tickSol->solution}} <br>
    Realizujący: {{$tickSol->solutionn->progress->name}}, {{$tickSol->solutionn->progress->email}}

</body>
</html>
