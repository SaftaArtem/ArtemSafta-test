<?php
session_start();

$state = $_SESSION['data'];

function set_tab_info($name, $status, $state, $recomendation){
  $file = 'tab.xls';
  $tofile = "'$name'; '$status';'$state';'$recomendation'; \n";
  $bom = "\xEF\xBB\xBF";
  file_put_contents($file, $bom . $tofile . file_get_contents($file)); 
}

foreach ($state as $key => $value) {  
  if ($key == 'robot_exist') {
    if($value == 1) {
      $name = 'Проверка наличия файла robots.txt';
      $status = 'Ok';
      $state = 'Файл robots.txt присутствует';
      $recomendation = 'Доработки не требуются';
      set_tab_info($name, $status, $state, $recomendation);
    }
  }
  elseif ($key == 'host_exist') {
    if($value == 1) {
      $name = 'Проверка указания директивы Host';
      $status = 'Ok';
      $state = 'Директива Host указана';
      $recomendation = 'Доработки не требуются';
      set_tab_info($name, $status, $state, $recomendation);
    }
    else {
      $name = 'Проверка указания директивы Host';
      $status = 'Ошибка';
      $state = 'Директива Host не указана';
      $recomendation = 'Программист: Для того, чтобы поисковые системы знали, какая версия сайта является основных зеркалом, необходимо прописать адрес основного зеркала в директиве Host. В данный момент это не прописано. Необходимо добавить в файл robots.txt директиву Host. Директива Host задётся в файле 1 раз, после всех правил.';
      set_tab_info($name, $status, $state, $recomendation);
    }
  }
  elseif ($key == 'host_count') {
    if($value == 1) {
      $name = 'Проверка количества директив Host, прописанных в файле';
      $status = 'Ok';
      $state = 'В файле прописана 1 директива Host';
      $recomendation = 'Доработки не требуются';
      set_tab_info($name, $status, $state, $recomendation);
    }
    elseif ($value == 2) {
      $name = 'Проверка количества директив Host, прописанных в файле';
      $status = 'Ошибка';
      $state = 'В файле прописано несколько директив Host';
      $recomendation = 'Программист: Директива Host должна быть указана в файле толоко 1 раз. Необходимо удалить все дополнительные директивы Host и оставить только 1, корректную и соответствующую основному зеркалу сайта';
      set_tab_info($name, $status, $state, $recomendation);
    }
    else {
      $name = 'Проверка указания директивы Host';
      $status = 'Ошибка';
      $state = 'Директива Host не указана';
      $recomendation = 'Проверка невозможна, т.к. директива Host отсутствует';
      set_tab_info($name, $status, $state, $recomendation);
    }
  }
  elseif ($key == 'file_size') {
    if( $value < 32000) {
      $name = 'Проверка размера файла robots.txt';
      $status = 'OK';
      $state = 'Размер файла robots.txt составляет '.$value.' байт, что находится в пределах допустимой нормы';
      $recomendation = 'Доработки не требуются';
      set_tab_info($name, $status, $state, $recomendation);
    }
    else {
      $name = 'Проверка размера файла robots.txt';
      $status = 'Ошибка';
      $state = 'Размера файла robots.txt составляет '.$value.' байт, что превышает допустимую норму';
      $recomendation = 'Доработки не требуются';
      set_tab_info($name, $status, $state, $recomendation);
    }
  }
  elseif ($key == 'site_map_exist') {
    if ($value == 1) {
      $name = 'Проверка указания директивы Sitemap';
      $status = 'Ok';
      $state = 'Директива Sitemap указана';
      $recomendation = 'Доработки не требуются';
      set_tab_info($name, $status, $state, $recomendation);
    }
    else {
      $name = 'Проверка указания директивы Sitemap';
      $status = 'Ok';
      $state = 'Директива Sitemap не указана';
      $recomendation = 'Доработки не требуются';
      set_tab_info($name, $status, $state, $recomendation);
    }
  }
  if($key == 'request_code') {
    if($value == 200){
      $name = 'Проверка кода ответа сервера для файла robots.txt';
      $status = 'Ok';
      $state = 'Файл robots.txt отдаёт код ответа сервера 200';
      $recomendation = 'Доработки не требуются';
      set_tab_info($name, $status, $state, $recomendation);
    }
    else{
        $name = 'Проверка кода ответа сервера для файла robots.txt';
        $status = 'Ошибка';
        $state = 'При обращении к файлу robots.txt сервер возвращает код ответа (указать код)';
        $recomendation = 'Программист: Файл robots.txt должны отдавать код ответа
        200, иначе файл не будет обрабатываться. Необходимо настроить сайт таким
        образом, чтобы при обращении к файлу robots.txt сервер возвращает код ответа 200';
        set_tab_info($name, $status, $state, $recomendation);
    }
  }
}
?>
<P>Таблица успешно сохранена</P>
<a href="tab.xls" download>Скачать файл с таблицей</a>