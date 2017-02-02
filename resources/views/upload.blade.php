<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Scorm</title>
    <script src="https://code.jquery.com/jquery-3.1.1.js"
            integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA="
            crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 20px;
            margin: auto;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

    </style>
</head>
<body>
<div class="flex-center position-ref full-height">


    <div class="content">

        @if(Session::has('msg'))
            {{ Session::get('msg') }}
        @endif

        <form action="{{route('upload.scorm')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="file" name="zip" accept="application/zip">
            <input type="submit" value="Submit">
        </form>


    </div>
</div>


<script>
    $(document).ready(function() {

        $('input[type=file]').change(function () {
            var val = $(this).val().toLowerCase();
            var regex = new RegExp("(.*?)\.(zip)$");
            if (!(regex.test(val))) {
                $(this).val('');
                alert('Please select a .zip file format.');
            }
        });
    });
</script>

</body>
</html>
