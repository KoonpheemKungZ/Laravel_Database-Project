<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">  
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>เกี่ยวกับเรา</title>
</head>
<body>
    <?php

    $user = "koonpheemkung";
    $arr = array("Home","Member","About","Contact");

    ?>
    <h1>ยินดีต้อนรับAdmin {{$user}}</h1>
    <p>Test TEst</p>

    <h1>{{$user}}</h1>

    @if($user == "koonpheemkung")
        <h1>เป็น admin</h1>
    @else
        <h1>ไม่เป็น admin</h1>
    @endif

    @foreach($arr as $menu)
        <a href="">{{$menu}}</a>
    @endforeach

    <ul>
    @for($i=1;$i<5;$i++)
        <li>{{$i}}</li>
    @endfor
    </ul>
</body>
</html>