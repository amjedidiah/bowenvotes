<?php
?>

<!-- Home CSS -->
<link rel="stylesheet" href="../css/dashboard.css">

</head>
<body class=''>
<div class="container-fluid h-100 page">
  <div class="row p-3 fixed dashboard-header">
    <div class="col pr-5 text-right">
      <span class='logout dummy-link'>
        Logout
      </span>
    </div>
  </div>

  <div class='row h-100'>

    <div class="col-2 dashboard-header-side h-100 fixed bg-2 text-center">
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

    <div class="col offset-2 h-100">
      <div class="row dashboard-view mt-5 pt-5">
        <div class="col text-center tab-content h-100" id="v-tabContent">
          <div class="tab-pane fade" id="v-feed" role="tabpanel" aria-labelledby="v-feed-tab">
            No feeds to display
          </div>
          <div class="row tab-pane fade show active" id="v-students" role="tabpanel" aria-labelledby="v-students-tab">

            <div class="col">

              <h3 class='text-left pl-5 pr-5'>Register Your Students</h3>

              <form id='csvUpload' class="form1 dashboard-baby pt-2 mb-5 pl-5 pr-5" action="action.php?jsDoc=1" method="post" enctype="multipart/form-data" target="upload_target">

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

              <h3 class='text-left pl-5 pr-5'>Create an Election</h3>
              <form id='formCreateElection' class='form form2 pt-2 mb-5 text-left pl-5 pr-5'>

                <div class="form-group">
                  <input type="text" class="form-control" id="electionName" aria-describedby="electionNameHelp" placeholder="Election Name">
                  <small id="electionNameHelp" class="form-text text-muted color-err"></small>
                </div>

                <div class="form-group">
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
                  <div class="form-group col-6">
                    <label for="esd">Departments Allowed To Vote</label>
                    <select multiple class="form-control" id="esd">
                      <option>ECE</option>
                      <option>EEE</option>
                      <option>Linguistics</option>
                      <option>French</option>
                      <option>Pharmacy</option>
                    </select>
                  </div>


                  <div class="form-group col-6">
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

                </div>
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
        </div>
      </div>
    </div>

  </div>
</div>
