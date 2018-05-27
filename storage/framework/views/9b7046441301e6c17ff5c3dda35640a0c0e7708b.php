<!doctype html>
<html lang="<?php echo e(app()->getLocale()); ?>">
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
            <?php if(Route::has('login')): ?>
                <div class="top-right links">
                    <?php if(Auth::check()): ?>
                        <a href="<?php echo e(url('/home')); ?>">Home</a>
                    <?php else: ?>
                        <a href="<?php echo e(url('/login')); ?>">Login</a>
                        <a href="<?php echo e(url('/register')); ?>">Register</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="content">
                <div class="title m-b-md">
                    Laravel PayMe 
                </div>
			<?php echo e(Form::open(['route' => 'payme.store'])); ?>

			<?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?> 
    <?php echo e(Form::label('group1', 'New Sale Creation')); ?><br><br>
	<table cellpadding="10" border="1">
	<tr>
	<td>
	Product name : </td><td><?php echo e(Form::text('prod_name',null, ['class' => 'form-control'])); ?>

	</td></tr>
	<tr>
	<td>
	Price : </td><td><?php echo e(Form::text('prod_price', null, ['class' => 'form-control'])); ?>

	</td></tr>
	<tr>
	<td>
	Currency : </td><td><?php echo e(Form::select('prod_curency', array('ILS' => 'ILS', 'USD' => 'USD', 'EUR' => 'EUR'), 'ILS')); ?>

	</td></tr>
	<tr>
	<td colspan="2">
	<?php echo e(Form::submit('Insert Payment Details', ['class' => 'btn btn-info'])); ?>

	</td></tr>
	</table>
<?php echo e(Form::close()); ?>

<br><br><br>
<table cellpadding="10" border="1">
<tr bgcolor="#eee">
<td>Time</td>
<td>Sale number</td>
<td>Description</td>
<td>Amount</td>
<td>Currency</td>
</tr>
<?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <tr>
            <td><?php echo e($prod->created_at); ?></td>
            <td><?php echo e($prod->response); ?></td>
			<td><?php echo e($prod->prod_name); ?></td>
			<td><?php echo e($prod->prod_price); ?></td>
			<td><?php echo e($prod->prod_curency); ?></td>
         </tr>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		 </table>
            </div>
        </div>
    </body>
</html>
