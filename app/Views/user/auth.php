<?php include __DIR__.'/../layouts/header.php';?>
<div class="container">

    <form class="form-signin" action="" method="post" role="form">
        <h2 class="form-signin-heading">Вход</h2>
        <?php
        if ($errors) {
            foreach ($errors as $error){
                echo $error;
            };
        }
        ?>
        <input type="text" name="email" id="email" class="form-control" placeholder="Email address" required autofocus>
        <input type="text" name="password" id="password" class="form-control" placeholder="Password" required>
        <label class="checkbox">
            <input type="checkbox" value="remember-me"> Запомнить меня
        </label>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
    </form>


</div> <!-- /container -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/js/bootstrap.min.js"></script>
<script src="/public/js/jquery.min.js"></script>
</body>
</html>
