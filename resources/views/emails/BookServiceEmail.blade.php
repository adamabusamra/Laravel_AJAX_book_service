<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email template</title>
  </head>

  <body>
    <h2>{{$details["title"]}}</h2>
    <h3>Name:</h3>
    <p>{{$details["body"]["name"]}}</p>
    <h3>Mobile:</h3>
    <p>{{$details["body"]["mobile"]}}</p>
    <h3>Services:</h3>
    @foreach ($details["body"]["services"] as $item)
    <ul>
      <li>{{$item}}</li>
    </ul>
    @endforeach
    <h3>Interest in this service:</h3>
    <p>{{$details["body"]["interest"]}}</p>
    <div style="margin-top: 20px">
      <h3>Thank you for choosing ITbeeb</h3>
    </div>

  </body>

</html>