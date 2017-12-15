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
    Radera grupper
</div>
@foreach($products as $product)

    <table>
        <thead>
        <tr>
            <td>Entity id</td>
            <td>Price</td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{ $product->entity_id }}</td>
            <td>{{ $product->price }}</td>
        </tr>
        </tbody>
    </table>
    <a href="{{action('ProductController@edit', $product->entity_id)}}">Redigera</a>
    <form action="{{ action('ProductController@destroy', $product->entity_id) }}" method="post">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <input name="submit" type="submit" value="Radera">
    </form>
@endforeach


</body>
</html>
