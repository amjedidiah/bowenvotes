<?php
?>

<!-- Home CSS -->
<link rel="stylesheet" href="./css/dashboard.css">

</head>
<body class=''>
<div class="container-fluid h-100 page">
  <div class="row p-2 fixed dashboard-header">
    <div class="col pr-5 text-right">
      <span class='logout dummy-link'>
        Logout
      </span>
    </div>
  </div>


  <div class='row h-100'>

    <div class="col-2 fixed dashboard-header-side h-100 bg-2 text-center">
      <p href='#' class='logo color-1 text-center'>
        <i class="far fa-check-square color-1 mt-5"></i>
      </p>

      <ul class="nav flex-column text-left" id="v-tab" role="list" aria-orientation="vertical">
        <li class="nav-item">
          <a class="nav-link active" id="v-feed-tab" data-toggle="pill" href="#v-feed" role="tab" aria-controls="v-feed" aria-selected="true">Feed</a>
        </li>
        <li class="nav-item">
          <a class="nav-link"  id="v-elections-tab" data-toggle="pill" href="#v-elections" role="tab" aria-controls="v-elections" aria-selected="false">Elections</a>
        </li>
      </ul>

    </div>

    <div class="col offset-2 h-100">
    <div class="row dashboard-view mt-5 pt-5">
        <div class="col text-center tab-content h-100" id="v-tabContent">
          <div class="tab-pane fade show active h-100" id="v-feed" role="tabpanel" aria-labelledby="v-feed-tab">
            No feeds to display
          </div>
          <div class="row tab-pane fade" id="v-elections" role="tabpanel" aria-labelledby="v-elections-tab">

            <div class="card-columns">
              <div class="card bg-primary text-white text-center p-3">
                <blockquote class="blockquote mb-0">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat.</p>
                  <footer class="blockquote-footer">
                    <small>
                      Someone famous in <cite title="Source Title">Source Title</cite>
                    </small>
                  </footer>
                </blockquote>
              </div>
              <div class="card">
                <img class="card-img" src=".../100px260/" alt="Card image">
              </div>
            </div>


          </div>
        </div>
    </div>
    </div>

  </div>
</div>
