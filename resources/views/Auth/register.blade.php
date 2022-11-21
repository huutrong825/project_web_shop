<!DOCTYPE html>
<html lang="en">
<head>
  <title>Đăng ký</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container">
  <h2 style="text-align:center">Tạo tài khoản</h2>
  <form action="" method='post'>
      @csrf
    <div class="form-group">
      <label for="name">User Name:</label>
      <input type="text" class="form-control" id="txtname" placeholder="Enter user name" name="txtname">
      <p style="color:red" class="help is-danger">{{ $errors->first('txtname') }}</p>
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
      <p style="color:red" class="help is-danger">{{ $errors->first('email') }}</p>
    </div>
    <div class="form-group">
      <label for="pass">Password:</label>
      <input type="password" class="form-control" id="pass" placeholder="Enter password" name="pass">
      <p style="color:red" class="help is-danger">{{ $errors->first('pass') }}</p>
    </div>
    <div class="form-group">
      <label for="repass">Repass:</label>
      <input type="password" class="form-control" id="repass" placeholder="Enter repass" name="repass">
      <p style="color:red" class="help is-danger">{{ $errors->first('repass') }}</p>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <div class="form-group" >
			<label>Đã có tài khoản <a href="/login">Đăng nhập</a></label>
		</div>
  </form>
</div>

</body>
</html>