<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- FACEBOOK | HTTPS required. HTTP will give a 403 forbidden response -->
    <script src="https://sdk.accountkit.com/en_US/sdk.js"></script>


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

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
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

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>

    <script
            src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous">

    </script>
</head>
<body>

<div class="content">
    Uppdatera en grupp

</div>

</div>


<table>
    <thead>
    <tr>
        <td>Customer group id</td>
        <td>Customer group code</td>
        <td>Tax class id</td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>{{ $edit->customer_group_id }}</td>
        <td>{{ $edit->customer_group_code }}</td>
        <td>{{ $edit->tax_class_id }}</td>

    </tr>
    </tbody>
</table>

<form action="{{ action('GroupController@update', $edit->customer_group_id) }}"  method="post">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <label>Lägg till en ny kod</label>
    <input name="customer_group_code" type="text" value="{{$edit->customer_group_code}}">
    <label>Lägg till en tax class id</label>
    <input name="tax_class_id" type="text" value="{{$edit->tax_class_id}}">
    <input name="submit" type="submit" value="Uppdatera">

</form>







</body>
</html>
