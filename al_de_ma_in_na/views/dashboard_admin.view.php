<?php
?>

<!-- Home CSS -->
<link rel="stylesheet" href="../css/dashboard.css">

</head>
<body class=''>
<div class="container-fluid h-100 page">
  <div class="row p-3 fixed dashboard-header d-none d-sm-block">
    <div class="col justify-content-between">
      <span class='logout dummy-link'>
        Logout
      </span>
    </div>
  </div>

  <div class='row h-100'>

    <div class="col-2 dashboard-header-side fixed bg-2 text-center d-none d-sm-block">
      <p href='#' class='logo color-1 text-center'>
        <i class="far fa-check-square color-1 mt-5"></i>
      </p>

      <ul class="nav flex-column text-left" id="v-tab" role="list" aria-orientation="vertical">
        <li class="nav-item">
          <a class="nav-link" id="v-feed-tab" data-toggle="pill" href="#v-feed" role="tab" aria-controls="v-feed" aria-selected="true">Feed</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active"  id="v-students-tab" data-toggle="pill" href="#v-students" role="tab" aria-controls="v-students" aria-selected="false">Students</a>
        </li>
        <li class="nav-item">
          <a class="nav-link"  id="v-elections-tab" data-toggle="pill" href="#v-elections" role="tab" aria-controls="v-elections" aria-selected="false">Elections</a>
        </li>
      </ul>

    </div>
    <div class="col dashboard-header-side dashboard-header-bottom fixed bg-2 text-center d-sm-none">
      <ul class="nav justify-content-around" id="h-tab" role="list" aria-orientation="horizontal">
        <!-- <li class="nav-item">
          <a class="nav-link" id="v-feed-tab" data-toggle="pill" href="#v-feed" role="tab" aria-controls="v-feed" aria-selected="true"><i class="fas fa-comment-alt"></i><span>Feed</span></a>
        </li> -->
        <li class="nav-item">
          <a class="nav-link active"  id="v-students-tab" data-toggle="pill" href="#v-students" role="tab" aria-controls="v-students" aria-selected="false"><i class="fas fa-users"></i><span>Students</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link"  id="v-elections-tab" data-toggle="pill" href="#v-elections" role="tab" aria-controls="v-elections" aria-selected="false"><i class="fas fa-list-ul"></i><span>Elections</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link"  id="v-results-tab" data-toggle="pill" href="#v-results" role="tab" aria-controls="v-results" aria-selected="false"><i class="fas fa-chart-pie"></i><span>Results</span></a>
        </li>
        <li class="nav-item">
          <a href='./action.php?logout=1&jsDoc=bowen' class="nav-link" aria-selected="false"><i class="fas fa-sign-out-alt"></i><span class=''>Logout</span></a>
        </li>
      </ul>

    </div>


    <div class="col offset-lg-2">
      <div class="row dashboard-view">
        <div class="col text-center tab-content" id="v-tabContent">
          <!-- <div class="tab-pane fade" id="v-feed" role="tabpanel" aria-labelledby="v-feed-tab" style='border: 1px solid red'>
            No feeds to display
          </div> -->
          <div class="row tab-pane fade show active" id="v-students" role="tabpanel" aria-labelledby="v-students-tab">
            <div class="col">

              <h3 class='text-left'>Register Your Students</h3>

              <form id='csvUpload' class="form1 dashboard-baby" action="action.php?jsDoc=1" method="post" enctype="multipart/form-data" target="upload_target">

                <div class='upload-div'>
                  <p class='upload-txt'>
                    Drop your .CSV file here or Click to Browse
                  </p>
                  <div class='form-group input-parent'>
                    <input type="file" id='csvFile' name="csv_file" accept=".csv" class='form-control form-control-validated-file p-5'>
                    <small id="csvFileHelp" class="form-text text-muted color-err"></small>
                  </div>
                </div>

                <iframe id="upload_target" name="upload_target" src="#" style="width:0;height:0;border:0px solid #fff;">
                </iframe>
                <button type="submit"  class="d-none btn btn-primary btn-block bg-1 mt-4" name="">Register</button>
                <div id="sub-msg" class=""></div>

              </form>

            </div>
          </div>
          <div class="row tab-pane fade" id="v-elections" role="tabpanel" aria-labelledby="v-elections-tab">

            <div class="col">

              <h3 class='text-left'>Create an Election</h3>
              <form id='formCreateElection' class='form form2 text-left'>

                <div class="form-group">
                  <input type="text" class="form-control" id="electionName" aria-describedby="electionNameHelp" placeholder="Election Name" min='5' required>
                  <small id="electionNameHelp" class="form-text text-muted color-err"></small>
                </div>

                <div class="form-group">
                  <select class="form-control form-control-validated" id="est" aria-describedby="electionTypeHelp" placeholder='Election Type' required>
                    <option disabled selected value>Election Type</option>
                    <option>General</option>
                    <option>Faculty</option>
                    <option>Department</option>
                    <option>Level</option>
                  </select>
                </div>

                <div class="form-group">
                  <select class="form-control hide" id="esc" aria-describedby="electionClassHelp" required>
                    <option id='class-announcer' disabled selected value>No class selected</option>
                  </select>
                </div>

                <!-- <div class="form-group">
                  <label for="esf">Faculties Allowed To Vote</label>
                  <select multiple class="form-control" id="esf">
                    <option>Engineering</option>
                    <option>Pharmacy</option>
                    <option>Physical Sciences</option>
                    <option>Arts</option>
                    <option>Medicine & Surgery</option>
                  </select>
                </div>

                <div class='form-row'>
                  <div class="form-group col-12 col-lg-6">
                    <label for="esd">Departments Allowed To Vote</label>
                    <select multiple class="form-control" id="esd">
                      <option>ECE</option>
                      <option>EEE</option>
                      <option>Linguistics</option>
                      <option>French</option>
                      <option>Pharmacy</option>
                    </select>
                  </div>


                  <div class="form-group col-12 col-lg-6">
                    <label for="esl">Levels Allowed To Vote</label>
                    <select multiple class="form-control" id="exampleFormControlSelect2" required>
                      <option>100</option>
                      <option>200</option>
                      <option>300</option>
                      <option>400</option>
                      <option>500</option>
                      <option>600</option>
                    </select>
                  </div>

                </div> -->

                <button type="submit" class="btn btn-primary btn-block bg-1 mt-3">Create</button>

                <div class="sub-msg" id='sub-msg'></div>
              </form>

              <h3 class='text-left pl-5 pr-5 mt-5'>Your Elections</h3>
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
          <div class="tab-pane fade" id="v-results" role="tabpanel" aria-labelledby="v-results-tab">
            No results to display
          </div>

        </div>
      </div>
    </div>

  </div>
</div>
