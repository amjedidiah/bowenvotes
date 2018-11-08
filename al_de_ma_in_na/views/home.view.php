
<!-- Home CSS -->
<link rel="stylesheet" href="../css/home.css">

</head>
<body class='bg-2'>
<div class="container h-100 page">
<div class="row h-100 align-items-center">

  <div class="d-none d-lg-block col-12 col-lg-6 homeBody-child" id='homeBody_logoHouse'>
    <p href='#' class='logo color-1 text-center'>
      <i class="far fa-user color-3"></i> bowenuniversityvotes
    </p>
  </div>

  <div class="col-12 col-lg-6 homeBody-child">
    <p href='#' class='logo color-1 text-center mb-2 d-lg-none'>
      <i class="far fa-user color-3"></i><span class='d-none d-sm-block'> bowenuniversityvotes</span>
    </p>
    <form id='formLogin' class='form1 next-form'>
      <div class="form-group">
        <input type="text" class="form-control form-control-lg" id="loginID" aria-describedby="loginIDHelp" placeholder="Username" required>
        <small id="loginIDHelp" class="form-text text-muted color-err"></small>
      </div>
      <div class="form-group">
        <input type="password" class="form-control form-control-lg" id="loginPass" aria-describedby="loginPassHelp" placeholder="Password" required>
        <small id="loginPassHelp" class="form-text text-muted color-err"></small>
      </div>
      <button type="submit" class="btn btn-primary btn-block btn-lg bg-1">Login</button>
      <!-- <div class='row'>
        <div class="col">
          <p class='color-2 mt-3 mb-3'><span class='dummy-link color-1 grow reset-form-getter'>Forgot Password?</span></p>
        </div>
      </div> -->

      <div class="sub-msg" id='sub-msg'></div>
    </form>
    <form id='formReset' class='form1 d-none'>
      <div class="form-group">
        <input type="text" class="form-control form-control-lg" id="idMatricNum" aria-describedby="idMatricNumHelp" placeholder="Matriculation Number" required>
        <small id="matricNumHelp" class="form-text text-muted color-err"></small>
      </div>
      <div class="form-group">
        <input type="email" class="form-control form-control-lg form-control-validated" id="idMail" aria-describedby="idMailHelp" placeholder="Email Address" required>
        <small id="emailHelp" class="form-text text-muted color-err"></small>
      </div>
      <button type="submit" class="btn btn-primary btn-block btn-lg bg-1">Reset Pasword</button>
      <p class='color-2 mt-3 mb-3'>Remembered Password?  <span class='dummy-link color-1 grow login-form-again-getter'>Login</span></p>
      <div class="sub-msg" id='sub-msg'></div>
    </form>
  </div>

</div>
</div>
