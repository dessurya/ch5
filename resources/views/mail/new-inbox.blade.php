<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <h2>New Inbox</h2>

    <p>Halo, you got new inbox</p>

    <p><label>Name : </label> {{$data[0]['name']}}</p>
    <p><label>Email : </label> {{$data[0]['email']}}</p>
    <p><label>Phone : </label> {{$data[0]['phone']}}</p>
    <p><label>Subject : </label> {{$data[0]['subject']}}</p>
    <p><label>Message : </label> {{$data[0]['message']}}</p>
  </body>
</html>
