   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <!-- Dash UI CSS -->
   <link rel="stylesheet" href="{{ asset('css/theme.min.css') }}">
   <link rel="stylesheet" href="{{ asset('css/theme.css') }}">

   <!-- Favicon icon-->
   <link rel="stylesheet" href="{{ asset('/images/favicon/favicon.ico') }}">

   <!-- Libs CSS -->
   <link rel="stylesheet" href="{{ asset('/libs/prismjs/themes/prism.css') }}">
   <link rel="stylesheet" href="{{ asset('/libs/prismjs/plugins/line-numbers/prism-line-numbers.css') }}">
   <link rel="stylesheet" href="{{ asset('/libs/prismjs/plugins/toolbar/prism-toolbar.css') }}">
   <link rel="stylesheet" href="{{ asset('/libs/bootstrap-icons/font/bootstrap-icons.css') }}">
   <link rel="stylesheet" href="{{ asset('/libs/dropzone/dist/dropzone.css') }}">
   <link rel="stylesheet" href="{{ asset('/libs/@mdi/font/css/materialdesignicons.min.css') }}">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.0/normalize.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

   {{-- logo aplikasi web --}}
   <link rel="shortcut icon" href="{{ asset('images/logo.png') }}">
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.1/css/dataTables.bootstrap5.min.css">
   <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
   <script type="text/javascript" src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
   <script type="text/javascript" src="https://cdn.datatables.net/1.11.1/js/dataTables.bootstrap5.min.js"></script>

   @isset($title)
       <title> {{ $title }}</title>
   @endisset
   <title>Page Not Found</title>
