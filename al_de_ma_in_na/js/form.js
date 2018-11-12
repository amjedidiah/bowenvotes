// js

const formSubmitEvent = () => {
  document.querySelectorAll('form').forEach((a,b) => {
    a.addEventListener('submit', (event) => {
      event.preventDefault()
      submitForm(a, false)
    })
  })
}





const fileChangeEvent = () => {
  //on change file inputs
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
}





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

          formSubmitEvent()
          fileChangeEvent()

          let esc = document.querySelector('#esc')
              data = JSON.parse(data)

          a.parent().parent().find('#esc').show().addClass('animated fadeInUp')
          esc.innerHTML = `<option id='class-announcer' disabled selected value>Select a ${val}</option>`
          esc.required

          data.forEach((a, b) => {
            esc.innerHTML += `<option>${a}</option>`
          })
        }
      })
    } else {
      a.parent().parent().find('#esc').hide().addClass('animated fadeInUp')
    }
  }

  if(id === 'positionName') {
    let election = a.attr('election')
    $.ajax({
      type: 'POST',
      url: './action.php?jsDoc=yes',
      data: 'position_name_check='+val+'&election_position_name_check='+election,
      success: function(data) {

        formSubmitEvent()
        fileChangeEvent()

        msg = data
        a.parent().find('small').html(msg)
      }
    })
  }

  if(id === 'candidateName') {
    let election = a.attr('election'),
        position = a.attr('position')
    // $.ajax({
    //   type: 'POST',
    //   url: './action.php?jsDoc=yes',
    //   data: 'candidate_name_check='+val+'&position_candidate_name_check='+position+'&election_candidate_name_check='+election,
    //   success: function(data) {
    //     msg = data
    //     a.parent().find('small').html(msg)
    //   }
    // })

    console.log(election, position, 'me');

  }


  a.parent().find('small').html(msg)

}
$('.form-control-validated').change(function() {
  formControlValidate($(this));
});




const submitFormHandler = (form, data) => {

  switch (data) {
    case 'election_created':

      break;
    case '2':
      data = 'Success'
      window.location = './'
      break;
    case 'refresh_election':
      data = 'Election created<br />Scroll down to see election'
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
        inputs = {}
    Object.keys(fields).forEach((a) => inputs[fields[a].id] = fields[a].value)

    const answer = err === 0 ? $.ajax({
      type: 'POST',
      url: './action.php?jsDoc=yes',
      beforeSend: function() {
        btn.innerHTML = `<i class="fas fa-spinner fa-pulse"></i>`
      },
      data: inputs,
      success: function(data) {

        formSubmitEvent()
        fileChangeEvent()
        
        btn.innerHTML = btnHTML

        if(data.includes('Add Position')) {
          $('#elections').html(data).addClass('animated fadeInUp')

          data = 'refresh_election'
        }

        formSubmitEvent()
        fileChangeEvent()

        submitFormHandler(form, data)
      }
    }) : 'no'
  }

}
formSubmitEvent()
fileChangeEvent()
