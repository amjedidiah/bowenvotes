// js
const formControlValidate = (a) => {
  let val = a.val(),
      id = a.attr('id'),
      msg

  if(id === 'est') {
    if(val !== 'General') {
      $.ajax({
        type: 'POST',
        url: './action.php?jsDoc=yes',
        data: 'election_type='+val,
        success: function(data) {

          let esc = document.querySelector('#esc')
              data = JSON.parse(data)

          a.parent().parent().find('#esc').show().addClass('animated fadeInUp')
          esc.innerHTML = `<option id='class-announcer' disabled selected value>Select a ${val}</option>`
          esc.required

          if(data.length > 0) {
            data.forEach((a, b) => {
              esc.innerHTML += `<option>${a}</option>`
            })
          }
        }
      })
    } else {
      a.parent().parent().find('#esc').hide().addClass('animated fadeInUp')
    }
  }

  if(id === 'electionNameCandidate') {
    if(val !== '') {



      xhttp = new XMLHttpRequest()
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          let data = JSON.parse(this.responseText),
              es_p = document.querySelector('#es_p')

          a.parent().parent().find('#es_p').show().addClass('animated fadeInUp')
          es_p.innerHTML = `<option id='class-announcer' disabled selected value>Select a position</option>`
          es_p.required

          if(data.length > 0) {
            data.forEach((a, b) => {
              es_p.innerHTML += `<option>${a}</option>`
            })
          }
        }
      }
      xhttp.open("GET", "action.php?electionNameCandidate="+val, true)
      xhttp.send()
    } else {
      a.parent().parent().find('#es_p').hide().addClass('animated fadeInUp')
    }
  }

  if(id === 'positionName') {
    let election = a.attr('election')
    $.ajax({
      type: 'POST',
      url: './action.php?jsDoc=yes',
      data: 'position_name_check='+val+'&election_position_name_check='+election,
      success: function(data) {
        msg = data
        a.parent().find('small').html(msg)
      }
    })
  }

  a.parent().find('small').html(msg)

}
$('.form-control-validated').change(function() {
  formControlValidate($(this));
});




const submitFormHandler = (form, data) => {

  switch (data) {
    case '2':
      data = 'Success'
      window.location = './'
      break;
    case 'election_created':
      data = 'Election created<br />Scroll down to see election'
      $('#elections').load('./views/election.php', function() {
        $('.position').click(function() {
          showPostCand(this.getAttribute('id'), this.getAttribute('election'));
        })
        $('span.del-btn').click(function() {
          deleteStuff(this)
        })
      })
      break;
    case 'refresh_position':
      data = 'Position created<br />Scroll down to see position'
      $('#elections').load('./views/election.php', function() {
        $('.position').click(function() {
          showPostCand(this.getAttribute('id'), this.getAttribute('election'));
        })
        $('span.del-btn').click(function() {
          deleteStuff(this)
        })
      })
      break;
    case 'candidate_added':
      data = 'Candidate added<br />Scroll down to see candidate'
      $('#elections').load('./views/election.php', function() {
        $('.position').click(function() {
          showPostCand(this.getAttribute('id'), this.getAttribute('election'));
        })
        $('span.del-btn').click(function() {
          deleteStuff(this)
        })
      })
      break;
    default:
      console.log('')
  }

  let subMsg = form.querySelector('div#sub-msg')
  subMsg.className = 'sub-msg-visible'
  subMsg.innerHTML = data




}




const submitForm = (form, upDet, err=0) => {



  //Get errors
  let smalls = form.querySelectorAll('small'),
      btn = form.querySelector('.btn'),
      btnHTML = btn.innerHTML,
      nextForm = document.querySelector('.next-form'),
      id = form.id

  if(upDet === true) {
    let iframe = form.querySelector('iframe')
    form.submit()

    //after uploading file, start listening for error number: 2
    let frameLoopingFunc = () => {
                                    let doc = iframe.contentDocument? iframe.contentDocument: iframe.contentWindow.document,
                                        docHTML = doc.querySelector('body').innerHTML,
                                        uploadBoxmsg = form.querySelector('.upload-txt').innerHTML

                                    form.querySelector('.upload-txt').innerHTML = `<i class="fas fa-spinner fa-pulse"></i>`

                                    if(docHTML.includes('02')) {
                                      form.querySelector('.upload-txt').innerHTML = msg
                                    } else if(docHTML.includes('01')) {
                                      form.querySelector('.upload-txt').innerHTML = 'Upload successful<br />Click the register button'
                                      form.querySelector('.input-parent').classList = 'd-none'
                                      clearInterval(frameLooping)

                                      form.querySelector('.btn').classList.add('d-block', 'animated','fadeInUp')
                                      form.querySelector('.btn').classList.add('d-block', 'animated','fadeInUp')
                                    }
                                  },
        frameLooping = setInterval(frameLoopingFunc, 200)

  } else {
    smalls.forEach(function(a, b) {
      if(a.innerHTML !== '') {
        err++;
      }
    })

    let fields = form.querySelectorAll('.form-control'),
        inputs = ''

    fields.forEach((a,b) => {
      if(fields.length - 1 === b) {
        inputs += fields[b].id+'='+fields[b].value
      } else {
        inputs += fields[b].id+'='+fields[b].value+'&'
      }
    })

    xhttp = new XMLHttpRequest()
    xhttp.onloadstart = () => {
      btn.innerHTML = `<i class="fas fa-spinner fa-pulse"></i>`
    }
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        let data = this.responseText
        btn.innerHTML = btnHTML

        submitFormHandler(form, data)
      }
    }
    xhttp.open("GET", "action.php?"+inputs, true)
    xhttp.send()
  }

}
document.querySelectorAll('form').forEach((a,b) => {
    a.addEventListener('submit', (event) => {
      event.preventDefault()
      submitForm(a, false)
    })
})
document.querySelectorAll(".form-control-validated-file").forEach((a,b) => {
  a.addEventListener('change', (event) => {
    let form = a.parentElement.parentElement.parentElement,
        msg = ''

      if (a.files && a.files[0]) {
        if(a.accept === ".csv") {
          if (a.files[0].type === 'application/vnd.ms-excel') {
            msg = ''
            submitForm(form, true)
          } else {
            msg = 'Please upload a CSV file'
          }
        }
      }

      // a.parentElement.children[1].innnerHTML = 'hello'
      let z = a.parentElement.children[1].textContent = msg
  })
})
