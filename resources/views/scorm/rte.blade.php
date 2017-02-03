<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>VS SCORM - RTE Frameset</title>

    <!-- Rev 1.0 - Sunday, May 31, 2009 -->
    <style>

        /* 16x9 Aspect Ratio */
        .intrinsic-container-16x9 {
            padding-bottom: 46.25%;
        }

        /* 4x3 Aspect Ratio */
        .intrinsic-container-4x3 {
            padding-bottom: 65%;
        }

        .intrinsic-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 90%;
            height: 90%;
        }
    </style>
</head>

<body>

@if(Session::has('msg'))
    {{ Session::get('msg') }}
@endif

<div class="intrinsic-container">
    <iframe src="{{asset('scorm/api.html')}}" name="API" noresize></iframe>

    <iframe src="{{asset("unzipCourse/$lessonFolderName/KE_Orientation3.htm")}}" name="course" allowfullscreen></iframe>
</div>

</body>

</html>