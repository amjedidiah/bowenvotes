<?php
?>

<!-- Home CSS -->
<link rel="stylesheet" href="../css/dashboard.css">

</head>
<body class=''>
<div class="container-fluid h-100 page">
  <div class="row p-3 fixed dashboard-header">
    <div class="col justify-content-between">

      <p href='#' class='logo color-3 text-center'>bowenuniversityvotes</p>

      <span class='logout dummy-link d-none'>
        Logout
      </span>
    </div>
  </div>

  <div class='row h-100'>

    <div class="col-2 dashboard-header-side fixed bg-2 text-center d-none d-lg-block">
      <p href='#' class='logo color-1 text-center'>
        <i class="far fa-check-square color-1 mt-5"></i>
      </p>

      <ul class="nav flex-column text-left" id="v-tab" role="list" aria-orientation="vertical">
        <li class="nav-item">
          <a class="nav-link"  id="v-students-tab" data-toggle="pill" href="#v-students" role="tab" aria-controls="v-students" aria-selected="false">Students</a>
        </li>
        <li class="nav-item">
          <a class="nav-link"  id="v-elections-tab" data-toggle="pill" href="#v-elections" role="tab" aria-controls="v-elections" aria-selected="false">Elections</a>
        </li>
        <li class="nav-item">
          <a class="nav-link"  id="v-results-tab" data-toggle="pill" href="#v-results" role="tab" aria-controls="v-results" aria-selected="false">Results</a>
        </li>
      </ul>

    </div>
    <div class="col dashboard-header-side dashboard-header-bottom fixed bg-2 text-center d-lg-none">
      <ul class="nav justify-content-around" id="h-tab" role="list" aria-orientation="horizontal">
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


    <div class="col h-100 offset-lg-2">
      <div class="row h-100 dashboard-view">
        <div class="col h-100 tab-content" id="v-tabContent">
          <!-- <div class="tab-pane fade" id="v-feed" role="tabpanel" aria-labelledby="v-feed-tab" style='border: 1px solid red'>
            No feeds to display
          </div> -->
          <div class="row tab-pane fade show active h-100" id="v-students" role="tabpanel" aria-labelledby="v-students-tab">
            <div class="tab-pane-baby col-10 offset-1">

              <h5 class=''>Register Your Students</h5>

              <form id='csvUpload' class="form1 dashboard-baby" action="action.php?jsDoc=1" method="post" enctype="multipart/form-data" target="upload_target">

                <div class='upload-div'>
                  <p class='upload-txt text-center'>
                    Drop your .CSV file here or Click to Browse
                  </p>
                  <div class='form-group input-parent'>
                    <input type="file" id='csvFile' name="csv_file" accept=".csv" class='form-control form-control-validated-file'>
                    <small id="csvFileHelp" class="form-text text-muted color-err"></small>
                  </div>
                </div>

                <iframe id="upload_target" name="upload_target" src="#" style="width:0;height:0;border:0px solid #fff;">
                </iframe>
                <button type="submit"  class="d-none btn btn-primary btn-block bg-1 mt-4" name="">Register</button>
                <div id="sub-msg" class=""></div>

              </form>

            </div>
            <div class="tab-pane-baby col-10 offset-1">
              <h5>Students Search</h5>
              <p>Coming soon</p>
            </div>
          </div>
          <div class="row tab-pane fade h-100" id="v-elections" role="tabpanel" aria-labelledby="v-elections-tab">

            <div class="tab-pane-baby col-10 offset-1" id='electionCreationDiv'>

              <h5 class=''>Create an Election</h5>
              <form id='formCreateElection' class='form form2 text-left'>

                <div class="form-group">
                  <input name='electionName' type="text" class="form-control" id="electionName" aria-describedby="electionNameHelp" placeholder="Election Name" min='5' required>
                  <small id="electionNameHelp" class="form-text text-muted color-err"></small>
                </div>

                <div class="form-group">
                  <select name='est' class="form-control form-control-validated" id="est" aria-describedby="electionTypeHelp" placeholder='Election Type' required>
                    <option disabled selected value>Election Type</option>
                    <option>General</option>
                    <option>Faculty</option>
                    <option>Department</option>
                    <option>Level</option>
                  </select>
                </div>

                <div class="form-group">
                  <select name='esc' class="form-control hide" id="esc" aria-describedby="electionClassHelp">
                  </select>
                </div>

                <button type="submit" class="btn btn-primary btn-block bg-1 mt-3">Create</button>

                <div class="sub-msg" id='sub-msg'></div>
              </form>

            </div>
            <div class="tab-pane-baby col-10 offset-1" id='positionCreationDiv'>

              <h5 class=''>Add a Position</h5>
              <form id="formCreatePosition" class="form form2 text-left">
                <div class="form-group">
                  <input name="positionName" type="text" class="form-control form-control-validated" id="positionName" aria-describedby="positionNameHelp" placeholder="Position Name" min="5" required>
                  <small id="positionNameHelp" class="form-text text-muted color-err"></small>
                </div>
                <div class="form-group">
                  <select name='ElectionName' class="form-control form-control-validated" id="electionName" aria-describedby="ElectionNameHelp" placeholder='Election Name' required>

                    <?php print_r(getSelectElection()); ?>
                  </select>
                </div>
                <button type="submit" class="btn btn-primary btn-block bg-1 mt-3">Add Position</button>
                <div class="sub-msg" id="sub-msg"></div>
              </form>

            </div>
            <div class="tab-pane-baby col-10 offset-1" id='candidateCreationDiv'>

              <h5 class=''>Add a Candidate</h5>
              <form id="formCreatePosition" class="form form2 text-left">
                <div class="form-group">
                  <input name="candidateName" type="text" class="form-control" id="candidateName" aria-describedby="candidateNameHelp" placeholder="Candidate Name" min="5" required>
                  <small id="candidateNameHelp" class="form-text text-muted color-err"></small>
                </div>
                <div class="form-group">
                <select name='ElectionName' class="form-control form-control-validated" id="electionNameCandidate" aria-describedby="ElectionNameHelp" placeholder='Election Name' required>
                  <?php print_r(getSelectElection()); ?>
                </select>
                </div>
                <div class="form-group">
                  <select name='es_p' class="form-control hide" id="es_p" aria-describedby="electionPositonHelp">
                  </select>
                </div>
                <button type="submit" class="btn btn-primary btn-block bg-1 mt-3">Add Candidate</button>
                <div class="sub-msg" id="sub-msg"></div>
              </form>

            </div>
            <div class="tab-pane-baby col-10 offset-1">
              <h5>Election Search</h5>
              <p>Coming soon</p>
            </div>

            <div id='elections'><?php include('election.php'); ?></div>




          </div>
          <div class="row tab-pane fade h-100" id="v-results" role="tabpanel" aria-labelledby="v-results-tab">
            No results to display
          </div>

        </div>
      </div>
    </div>



    <div class="pop-over candidates-load">
    </div>
  </div>
</div>
