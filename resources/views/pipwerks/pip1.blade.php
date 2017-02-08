<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>VS SCORM - RTE Frameset</title>

    <script type="text/javascript" src="{{asset('scorm-api-wrapper/src/JavaScript/SCORM_API_wrapper.js') }}" ></script>

    <!-- Rev 1.0 - Sunday, May 31, 2009 -->


    <script>
        var myScormData:SCORM = new SCORM();

    </script>



</head>

<body>

<div class="intrinsic-container">

    <iframe src="{{ asset('scorm/api.html') }}" name="API" id="API" noresize></iframe>

    <iframe src="{{ asset('loadSCO.php') }}" name="SCO" id="SCO" allowfullscreen></iframe>

</div>


</body>
</html>