<!DOCTYPE html>
<html>
<head>
    <title>Test Mail</title>
</head>
<body>
    {{--  <h1>{{ $details['title'] }}</h1>
    <p>{{ $details['body'] }}</p>  --}}

    <form action="{{ route('mail_now.store') }}" method="POST">
        @csrf
        <input type="text" name="test" id="">
        <button type="submit">Send</button>
    </form>

    {{--  <p>Thank you</p>  --}}
</body>
</html>
