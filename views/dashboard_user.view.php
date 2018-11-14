<?php
?>

<!-- Home CSS -->
<link rel="stylesheet" href="./css/dashboard.css">

</head>
<body class=''>
<div class="container-fluid h-100 page">
  <div class="row p-3 fixed dashboard-header">
    <div class="col">
      <p href='#' class='logo color-3 text-center'>bowenuniversityvotes</p>
    </div>
  </div>

  <div class='row h-100'>

    <div class="col-3 dashboard-header-side fixed bg-2 text-center d-none d-md-block">
      <ul class="nav flex-column text-left" id="v-tab" role="list" aria-orientation="vertical">
        <li class="nav-item">
          <a class="nav-link active"  id="v-elections-tab" data-toggle="pill" href="#v-elections" role="tab" aria-controls="v-elections" aria-selected="false">Elections</a>
        </li>
        <li class="nav-item">
          <a href='./action.php?logout=1&jsDoc=bowen' class="nav-link" aria-selected="false">Logout</a>
        </li>
      </ul>

    </div>
    <div class="col dashboard-header-side dashboard-header-bottom fixed bg-2 text-center d-md-none pt-0" style='font-size: 160%'>
      <ul class="nav justify-content-around" id="h-tab" role="list" aria-orientation="horizontal">
        <li class="nav-item">
          <a class="nav-link active"  id="v-elections-tab" data-toggle="pill" href="#v-elections" role="tab" aria-controls="v-elections" aria-selected="false"><i class="fas fa-list-ul"></i><span>Elections</span></a>
        </li>
        <li class="nav-item">
          <a href='./action.php?logout=1&jsDoc=bowen' class="nav-link" aria-selected="false"><i class="fas fa-sign-out-alt"></i><span class=''>Logout</span></a>
        </li>
      </ul>

    </div>


    <div class="col h-100 offset-md-3">
      <div class="row h-100 dashboard-view">
        <div class="col h-100 tab-content" id="v-tabContent">
          <!-- <div class="tab-pane fade" id="v-feed" role="tabpanel" aria-labelledby="v-feed-tab" style='border: 1px solid red'>
            No feeds to display
          </div> -->
          <div class="row tab-pane fade show active h-100" id="v-elections" role="tabpanel" aria-labelledby="v-elections-tab">
          <div class="col">
          <div class="row">
            <div class="tab-pane-baby col-10 offset-1 col-lg-5 offset-lg-0" id='electionCreationDiv'>

            </div>

            <div class='col-12' id='elections'><?php include('election.php'); ?></div>


          </div>
          </div>
          </div>
          <div class="row tab-pane fade h-100 text-center" id="v-results" role="tabpanel" aria-labelledby="v-results-tab">
            No results to display
          </div>

        </div>
      </div>
    </div>



    <div class="pop-over candidates-load">

    </div>
  </div>
</div>
