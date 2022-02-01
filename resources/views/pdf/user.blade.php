<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>

</head>
<body>
    <h1>User details</h1>
    <table id="customers">
  <thead>
    <tr>
      
      <th scope="col">First Name</th>
      <th scope="col">Last name</th>
      <th scope="col">Email</th>
    </tr>
  </thead>
  <tbody>
    @foreach($user as $u)
    <tr>
      <td>{{$u->first_name}}</td>
      <td>{{$u->last_name}}</td>
      <td>{{$u->email}}</td>
    </tr>
   @endforeach
    
  </tbody>
</table>
    
</body>
</html>