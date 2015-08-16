<div id="login" class="container">

  <form class="form-signin" action="/admins/login" method="post">
    <h2 class="form-signin-heading">管理员登录</h2>
    <input type="text" class="input-block-level" name="data[AdminUser][username]" placeholder="管理员账户名">
    <input type="password" class="input-block-level" name="data[AdminUser][password]" placeholder="管理员密码">
    <button class="btn btn-large btn-primary" type="submit">登录</button>
  </form>

</div> <!-- /container -->