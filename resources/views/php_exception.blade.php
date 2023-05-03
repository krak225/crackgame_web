<!DOCTYPE html>
<html lang="fr">

<head>        
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <!--[if gt IE 8]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <![endif]-->
    
    <title>E-voyageur | Page d'erreurs</title>

    <link rel="icon" type="image/ico" href="favicon.ico"/>
    
    <link href="{{asset('css/stylesheets.css')}}" rel="stylesheet" type="text/css" />
   
    
</head>
<body>
    
    <div class="loginBlock" id="login" style="display: block;">
        <div style="text-align:center;background:#F9F9F9;"><image src="{{asset('images/logo-large.png')}}" style="height:70px;"/></div>
        <h1 style="text-align:center;font-weight:normal;font-family: 'Open Sans', Arial, Helvetica, sans-serif;"></h1>
        <div class="dr"><span></span></div>
        <div class="loginForm">
		 
			<div class="control-group">
				<div class="">
				@foreach($exception as $ex)
				{{$ex->getMessage()}}
				@endforeach
				</div>
				
				<div class="" style="padding:10px 10px;font-size:15px;text-align:center;">
				Woops! erreurs lors de l'exécution?
				<?php //print_r($exception);?>
				</div>
			</div>

            <div class="dr"><span></span></div>
            <div class="controls">
                <div class="row-fluid">
                    <div class="span6">
                    </div>
                    <div class="span2"></div>
                    <div class="span4">
                    </div>
                </div>
            </div>
        </div>
    </div>    
    
</body>

</html>
