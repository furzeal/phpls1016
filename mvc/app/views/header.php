<?php if(Session::get('loggedIn') == true):?>
    <a href="home/logout">Logout</a>
<?php else: ?>
    <a href="login">Login</a>
<?php endif; ?>