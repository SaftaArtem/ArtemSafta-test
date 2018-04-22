<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Result</title>
  </head>
  <body>
    <div class="container">
      <div class="row main">
        <div class="col-1">№</div>
        <div class="col-4">Название проверки</div>
        <div class="col-1">Статус</div>
        <div class="col-4">Текущее состояние</div>
      </div>

      
      <div class="row">
        <div class="col-1">1</div>
        <div class="col-4">Проверка наличия файла robots.txt</div>
        <?php if($state['robot_exist'] == 1):?> <!-- Is File Exist -->
        <div class="col-1 green">OK</div>
        <div class="col-6">
          <div class="row">
            <div class="col-3">Состояние</div>
            <div class="col-9">Файл robots.txt присутствует</div> 
          </div>
          <div class="row">
            <div class="col-3">Рекомендации</div>
            <div class="col-9">Доработки не требуются</div> 
          </div>
        </div> 
      </div>
        <!-- Is Host Exist -->
      <div class="row">
        <div class="col-1">6</div>
        <div class="col-4">Проверка указания директивы Host</div>
        <?php if($state['host_exist'] == 1):?>
          <div class="col-1 green">OK</div>
          <div class="col-6">
            <div class="row">
              <div class="col-3">Состояние</div>
              <div class="col-9">Директива Host указана</div> 
            </div>
            <div class="row">
              <div class="col-3">Рекомендации</div>
              <div class="col-9">Доработки не требуются</div> 
            </div>
          </div>  
        <?php else:?>
          <div class="col-1 red">Ошибка</div>
          <div class="col-6">
            <div class="row">
              <div class="col-3">Состояние</div>
              <div class="col-9">В файле robots.txt не указана директива Host</div> 
            </div>
            <div class="row">
              <div class="col-3">Рекомендации</div>
              <div class="col-9">
                Программист: Для того, чтобы поисковые системы знали, какая
                версия сайта является основных зеркалом, необходимо прописать
                адрес основного зеркала в директиве Host. В данный момент это не прописано.
                Необходимо добавить в файл robots.txt директиву Host. 
                Директива Host задётся в файле 1 раз, после всех правил.
              </div> 
            </div>
          </div>
        <?php endif;?>
      </div>

      <!-- Host Count -->
      <div class="row">
        <div class="col-1">8</div>
        <div class="col-4">Проверка количества директив Host, прописанных в файле</div>
        <?php if($state['host_count'] == 1):?>
          <div class="col-1 green">OK</div>
          <div class="col-6">
            <div class="row">
              <div class="col-3">Состояние</div>
              <div class="col-9">В файле прописана 1 директива Host</div> 
            </div>
            <div class="row">
              <div class="col-3">Рекомендации</div>
              <div class="col-9">Доработки не требуются</div> 
            </div>
          </div>
        <?php elseif($state['host_count'] == 2):?>
          <div class="col-1 red">Ошибка</div>
          <div class="col-6">
            <div class="row">
              <div class="col-3">Состояние</div>
              <div class="col-9">В файле прописано несколько директив Host</div> 
            </div>
            <div class="row">
              <div class="col-3">Рекомендации</div>
              <div class="col-9">
                Программист: Директива Host должна быть указана в файле толоко 1 раз.
                Необходимо удалить все дополнительные директивы Host и оставить только 1,
                корректную и соответствующую основному зеркалу сайта
              </div> 
            </div>
          </div>    
        <?php else:?>
          <div class="col-1 red">Ошибка</div>
          <div class="col-6">
            <div class="row">
              <div class="col-3">Состояние</div>
              <div class="col-9">Проверка невозможна, т.к. директива Host отсутствует</div> 
            </div>
          </div>
        <?php endif;?>
      </div>

      <!-- File size -->
      <div class="row">
        <div class="col-1">10</div>
        <div class="col-4">Проверка размера файла robots.txt</div>
        <?php if($state['is_correct_size'] == 1):?>
          <div class="col-1 green">OK</div>
          <div class="col-6">
            <div class="row">
              <div class="col-3">Состояние</div>
              <div class="col-9">
                Размер файла robots.txt составляет 
                <?php echo $state['file_size']; ?> байт,
                что находится в пределах допустимой нормы
              </div> 
            </div>
            <div class="row">
              <div class="col-3">Рекомендации</div>
              <div class="col-9">Доработки не требуются</div> 
            </div>
          </div>  
        <?php else:?>
          <div class="col-1 red">Ошибка</div>
          <div class="col-6">
            <div class="row">
              <div class="col-3">Состояние</div>
              <div class="col-9">
                Размера файла robots.txt составляет 
                <?php echo $state['file_size']; ?> байт,
                что превышает допустимую норму</div> 
            </div>
            <div class="row">
              <div class="col-3">Рекомендации</div>
              <div class="col-9">
                Программист: Максимально допустимый размер файла robots.txt
                составляем 32 кб. Необходимо отредактировть файл robots.txt
                таким образом, чтобы его размер не превышал 32 Кб
              </div> 
            </div>
          </div>
        <?php endif;?>
      </div>
      
      <!-- Is Sitemap Exist -->
      <div class="row">
        <div class="col-1">11</div>
        <div class="col-4">Проверка указания директивы Sitemap</div>
        <?php if($state['site_map_exist'] >= 1):?>
          <div class="col-1 green">OK</div>
          <div class="col-6">
            <div class="row">
              <div class="col-3">Состояние</div>
              <div class="col-9">Директива Sitemap указана</div> 
            </div>
            <div class="row">
              <div class="col-3">Рекомендации</div>
              <div class="col-9">Доработки не требуются</div> 
            </div>
          </div>  
        <?php else:?>
          <div class="col-1 red">Ошибка</div>
          <div class="col-6">
            <div class="row">
              <div class="col-3">Состояние</div>
              <div class="col-9">В файле robots.txt не указана директива Sitemap</div> 
            </div>
            <div class="row">
              <div class="col-3">Рекомендации</div>
              <div class="col-9">Программист: Добавить в файл robots.txt директиву Sitemap</div> 
            </div>
          </div>
        <?php endif;?>
      </div>

      <!-- Request Code -->
      <div class="row">
        <div class="col-1">12</div>
        <div class="col-4">Проверка кода ответа сервера для файла robots.txt</div>
        <?php if($state["request_code"] == 200):?>
          <div class="col-1 green">OK/</div>
          <div class="col-6">
            <div class="row">
              <div class="col-3">Состояние</div>
              <div class="col-9">Файл robots.txt отдаёт код ответа сервера 200</div>
            </div>
            <div class="row">
              <div class="col-3">Рекомендации</div>
              <div class="col-9">Доработки не требуются</div>
            </div>
          </div>
        <?php else: ?>
          <div class="col-1 red">Ошибка</div>
          <div class="col-6">
            <div class="row">
              <div class="col-3">Состояние</div>
              <div class="col-9">При обращении к файлу robots.txt сервер возвращает код ответа <?php echo $state['request_code'];?></div>
            </div>
            <div class="row">
              <div class="col-3">Рекомендации</div>
              <div class="col-9">
                Программист: Файл robots.txt должны отдавать
                код ответа 200, иначе файл не будет обрабатываться. Необходимо
                настроить сайт таким образом, чтобы при обращении к файлу
                robots.txt сервер возвращает код ответа 200
              </div>
            </div>
          </div>
        <?php endif;?>
      </div>
      <form action="save.php" method="POST">
        <input type="submit" value="save to exel" name="save">
      </form>
      <?php else:?> <!--if file does not exist -->
        <div class="col-1 red">Ошибка</div>
        <div class="col-6">
          <div class="row">
            <div class="col-3">Состояние</div>
            <div class="col-9">Файл robots.txt отсутствует</div> 
          </div>
          <div class="row">
            <div class="col-3">Рекомендации</div>
            <div class="col-9">Программист: Создать файл robots.txt и разместить его на сайте.</div> 
          </div>
        </div>
      <?php endif;?>
      </div>
    </div>

    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
  </body>
</html>