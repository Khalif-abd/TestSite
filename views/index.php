<!DOCTYPE html>
<html lang="ru">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="views/css/style.css">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
      <script src="views/js/main.js"></script>
      <title>Документ</title>
   </head>
   <body>
      <div class="wrapper">
         <div class="left">
            <form>
               <select name="sel" id="sel">
                  <option value="0" disabled>Выберите количетсво</option>
                  <option value="1">1</option>
                  <option value="3">3</option>
                  <option value="5">5</option>
                  <option selected value="10">10</option>
                  <option value="20">20</option>
                  <option value="40">40</option>
               </select>
               <br>
               <p>Фильтры:</p>
               <input checked  type="radio" id="viewsChoice"name="filter" value="views">
               <label for="viewsChoice">По количеству просмотров</label>
               <input type="radio" id="dateChoice" name="filter" value="time_create">
               <label for="dateChoice">По дате</label>
               <br>
               <button type="button" id="show" onclick ="loadPost()">Показать</button>
            </form>
         </div>
         <div class="center"> 
         </div>
      </div>
      <script >
         loadPost();
      </script>
   </body>
</html>