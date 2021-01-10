<?
   $res = $res[0];
   !$res? header('location:/'):null;	
?>
<!DOCTYPE html>
<html lang="ru">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="/views/css/style.css">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
      <title><?=$res['title']?></title>
   </head>
   <body>
      <div class="wrapper">
         <div class="center view">
            <div class="card">
               <div class="card-body text-center">
                  <h4 class="card-title"><?=$res['title']?></h4>
                  <p class="card-text"><?=$res['body']?></p>
                  <p class=" text-muted">
                     Views : <?=$res['views']?>
                  </p>
                  <p class=" text-muted">
                     <? echo date('Y-m-d', $res['time_create']);?>
                  </p>
                  <a href="/" class="card-link">< Назад</a>
               </div>
            </div>
         </div>
      </div>
      <script></script>
   </body>
</html>