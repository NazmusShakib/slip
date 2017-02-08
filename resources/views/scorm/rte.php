<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script
        src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous"></script>

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

    <script>

       /* $(document).ready(function() {

            $('#API').ready(function() {
                setTimeout("$('#course').attr('src', '/unzipCourse/lesson/KE_Orientation3.htm')", 4000);
            });

            setTimeout("API.LMSFinish('+s+');", 5000);
        });
*/
    </script>

</head>

<body>

<div class="intrinsic-container">

    <iframe src="<?php echo  asset('scorm/api.html'); ?>" id="API" name="API"  noresize></iframe>
    <iframe src="/unzipCourse/cap12/KE_Orientation22.htm" name="SCO" id="course" allowfullscreen></iframe>


</div>


</body>
</html>