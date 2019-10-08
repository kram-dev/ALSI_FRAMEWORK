 <!DOCTYPE html>
    <html lang="en">
      <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="description" content="ALSI PHP MVC TEMPLATE">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="author" content="Mark Angelo Sila">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- wag mo tataggalin tong php code na to -->
        <title>@yield('title') {{ app['name'] }} </title>
        <!-- ALSI Main CSS -->
        <link rel="stylesheet" href="{{ app['url'] }}public/css/alsi.css">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Toastr CSS -->
        <link rel="stylesheet" type="text/css" href="{{ app['url'] }}public/plugin/notification/toastr/css/toastr.min.css" />

        <style rel="stylesheet" type="text/css">
            .non-decor:hover{
                text-decoration:none;
            }
            .p{
              font-size:24px;
            }
        </style>
        
    </head>
    <body>
        <!-- <div class="loader_8" data-loader="8"></div> -->
