<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <style type="text/css">
        @font-face {
            font-family: 'Helvetica';
            font-size:12px;
            font-weight: normal;
            font-style: normal; // use the matching font-style here
        }
        body {
            font-family: 'Helvetica';
            font-size:12px;
        }
    </style>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<body>
<div style="font-size:16px; font-weight: bold; text-align: center; margin: 15px 0 10px;">
    <p style="border-style: solid; width: 170px; margin: auto; position: relative;"> No of Code {{ $code->count() }} </p>
</div>

<table style="margin-left: auto; margin-right: auto;">

    @foreach($code->chunk(7) as $rows)
        <tr>
            @foreach($rows as $row)
                <td style="padding-right: 20px">{{ $row }}</td>
            @endforeach
        </tr>

    @endforeach

</table>
</body>
</html>
