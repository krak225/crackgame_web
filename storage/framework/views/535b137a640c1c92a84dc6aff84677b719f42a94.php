<!doctype html>
<html lang="<?php echo e(app()->getLocale()); ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CRACKGAME</title>

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
                    <?php if(auth()->guard()->check()): ?>
						<a href="<?php echo e(route('home')); ?>"><?php echo e(Auth::user()->pseudo); ?></a>
						|
                        <a href="<?php echo e(route('logout')); ?>"
							onclick="event.preventDefault();
									 document.getElementById('logout-form').submit();">
							Se déconnecter
						</a>
						<form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
							<?php echo e(csrf_field()); ?>

						</form>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>">Se connecter</a>
                        <a href="<?php echo e(route('register')); ?>">CREATION DE COMPTE</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
			
			
            <div class="content">
                <div class="title m-b-md" style="color:#38d03e">
                   CrackGame
                </div>

                <div class="links">
                    <a href="<?php echo e(route('home')); ?>">Accueil</a>
                    <a href="<?php echo e(route('categorie_test')); ?>">Test de connaissance</a>
                    <a href="<?php echo e(route('duels')); ?>">Duels</a>
                    <a href="<?php echo e(route('chaps')); ?>">Chaps</a>
                    <a href="<?php echo e(route('quizs')); ?>">Quiz</a>
                </div>
            </div>
        </div>
    </body>
</html>
