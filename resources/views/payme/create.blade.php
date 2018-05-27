<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

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
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel PayMe 
                </div>
			{{ Form::open(['route' => 'payme.store']) }}
			@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif 
    {{ Form::label('group1', 'New Sale Creation')}}<br><br>
	<table cellpadding="10" border="1">
	<tr>
	<td>
	Product name : </td><td>{{Form::text('prod_name',null, ['class' => 'form-control'])}}
	</td></tr>
	<tr>
	<td>
	Price : </td><td>{{Form::text('prod_price', null, ['class' => 'form-control'])}}
	</td></tr>
	<tr>
	<td>
	Currency : </td><td>{{Form::select('prod_curency', array('ILS' => 'ILS', 'USD' => 'USD', 'EUR' => 'EUR'), 'ILS')}}
	</td></tr>
	<tr>
	<td colspan="2">
	{{Form::submit('Insert Payment Details', ['class' => 'btn btn-info'])}}
	</td></tr>
	</table>
{{ Form::close() }}
<br><br><br>
<table cellpadding="10" border="1">
<tr bgcolor="#eee">
<td>Time</td>
<td>Sale number</td>
<td>Description</td>
<td>Amount</td>
<td>Currency</td>
</tr>
@foreach ($datas as $prod)
         <tr>
            <td>{{ $prod->created_at }}</td>
            <td>{{ $prod->response }}</td>
			<td>{{ $prod->prod_name }}</td>
			<td>{{ $prod->prod_price }}</td>
			<td>{{ $prod->prod_curency }}</td>
         </tr>
         @endforeach
		 </table>
            </div>
        </div>
    </body>
</html>
