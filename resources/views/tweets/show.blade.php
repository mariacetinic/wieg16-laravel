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



        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        #galleri{
            display: flex;
            flex-wrap: wrap;
        }

        img{
            width: 20%;
            height: 200px;
            object-fit: cover;

        }
    </style>

    <script
            src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous">

    </script>
</head>
<body>


<h1>Tweets från metoo</h1>
<div id="galleri">

    @foreach($products as $product)

        <table>
            <thead>
            <tr>
                <td>Id</td>
                <td>Tweet</td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{ $product->entity_id }}</td>
                <td>{{ $product->price }}</td>
            </tr>
            </tbody>
        </table>

    @endforeach

</div>
</body>
</html>
