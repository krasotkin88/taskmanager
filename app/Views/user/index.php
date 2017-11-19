<?php include __DIR__.'/../layouts/header.php';?>

<div class="container">
    <div class="page-header">
        <h2>Сотрудники</h2>
    </div>

</div>
<div id="container" class="container">


    <!--    <div class="row">-->
    <!--        <div class="col-lg-4">-->
    <!--            <form class="form-horizontal">-->
    <!--                <div class="form-group">-->
    <!--                    <label for="department_id" class="control-label">Задачи по подразделению</label>-->
    <!--                    <select id="department_id" class="form-control">-->
    <!--                        <option selected>Выберите подразделение</option>-->
    <!--                        <option value="1">Управление</option>-->
    <!--                        <option value="2">Администрация</option>-->
    <!--                        <option value="3">Экспертная группа</option>-->
    <!--                        <option value="4">Орган инспекции</option>-->
    <!--                    </select>-->
    <!--                </div>-->
    <!--            </form>-->
    <!--        </div>-->
    <!--    </div>-->

    <ul class="nav nav-tabs">
        <li class="active"><a href="?status=active">Сотрудники <span class="badge">1</span></a></li>
        <li><a href="?status=today">На сегодня <span class="badge">0</a></li>
        <li><a href="?status=finished">Завершенные <span class="badge">3</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade active in" id="staff">
            <div class="top-buffer">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Имя пользователя</th>
                        <th>email</th>
                        <th>password</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><a href="/users/<?php echo $user['id']; ?>"><?php echo $user['username']; ?></a></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['password']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/js/bootstrap.min.js"></script>
<script src="/public/js/jquery.min.js"></script>
</body>
</html>
