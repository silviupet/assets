<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email for expired atributes </title>
</head>
<body>


<div>


<p>Salut {{$user->name}}</p>

<p>Iti reamintim ca urmatoarele atribute au data de expirare peste 15 zile</p>
    <table style="width: 100%", class="table">
        <tr style="text-align: center">
            <th>Name</th>
            <th>Belong to asset</th>
            <th>Description</th>
            <th>From_date</th>
            <th>Expire_date</th>
            <th>Price</th>
            <th>Currency</th>
            <th>Vendor</th>
            <th>Other Condition</th>



        </tr>

            <tr style="text-align: center">
                <td>{{$atribute->name}}</td>

                <td>{{$atribute->asset->name?? "asset deleted"}}</td>


                <td>{{$atribute->description}}</td>
                {{--                   {{var_dump($atribute->from_date)}}--}}
                <td>{{\Carbon\carbon::parse($atribute->from_date)->format('d-m-Y')}}</td>
                <td>{{\Carbon\carbon::parse($atribute->expiry_date)->format('d-m-Y')}}</td>
                <td>{{$atribute->price}}</td>
                <td>{{$atribute->currency}}</td>
                <td>{{$atribute->vendor}}</td>
                <td>{{$atribute->other_conditions}}</td>
            </tr>


    </table>
</div>
</body>
</html>
