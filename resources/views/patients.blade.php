<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PatientBase</title>
    <script src="{{ mix('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">

        <router-view></router-view>
        @foreach($patients as $patient)
            <div class='box'>
                {{ $patient->name}}
            </div> 
        @endforeach

    </div>
</body>
</html>