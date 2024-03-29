<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=10.0, user-scalable=yes">
  <title>管理画面 | daylinks</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <!--ここからfavicon-->
  <link rel="shortcut icon" href="images/favicons/favicon.ico">
  <link rel="apple-touch-icon" href="images/favicons/apple-touch-icon.png">
  <link rel="icon" type="image/png" href="images/favicons/android-chrome-256x256.png">
  <!--ここまでfavicon-->
</head>
<body>
<div id="wrapper">
   <app></app>
</div>
<script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>