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
    Ticket number: {{$solution->ticket_id}} <br>
    Description: {{$solution->solution}} <br>
    Operator: {{$solution->user->email}}<br>
    Status: {{$solution->ticket->status}}

</body>

</html>
