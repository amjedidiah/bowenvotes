// js

//Define forms
let loginForm = document.querySelector('#formLogin'),
    resetForm = document.querySelector('#formReset')




const submitForm = (form, upDet, err=0) => {



  //Get errors
  let smalls = form.querySelectorAll('small'),
      btn = form.querySelector('.btn'),
      btnHTML = btn.innerHTML,
      nextForm = document.querySelector('.next-form'),
      id = form.id

  if(upDet === true) {
    iframe = form.querySelector('iframe')



    form.submit()



    //start listening for answer
    // setInterval(() => {
    //   let doc = iframe.contentDocument? iframe.contentDocument: iframe.contentWindow.document,
    //       docHTML = doc.querySelector('body').innerHTML,
    //       msg = form.querySelector('.upload-txt').innerHTML
    //
    //   if(docHTML === '0' || docHTML === '') {
    //     //error
    //     form.querySelector('.upload-txt').innerHTML = msg
    //   } else if(docHTML === '1') {
    //     form.querySelector('.upload-txt').innerHTML = 'Success'
    //     return docHTML
    //   } else {
    //     msg = `<i class="fas fa-spinner fa-pulse"></i>`
    //     form.querySelector('.upload-txt').innerHTML = msg
    //   }
    //
    //   console.log(docHTML);
    //
    // }, 200)
  } else {
    console.log('nice')
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

        form.querySelector('div#sub-msg').innerHTML = data
        form.querySelector('div#sub-msg').className = 'sub-msg-visible'
        btn.innerHTML = btnHTML

        if(data === '2') {
          window.location = './'
        }
      }
    }) : 'no'
  }

}
document.querySelectorAll('form').forEach((a,b) => {
  a.addEventListener('submit', (event) => {
    event.preventDefault()
    submitForm(a, false)
  })
})




//on change file inputs
document.querySelectorAll("form input[type='file']").forEach((a,b) => {
  a.addEventListener('change', (event) => {
    form = a.parentElement.parentElement.parentElement

    function readURL(input) {
       if (input.files && input.files[0]) {
         if( input.files[0].type === 'application/vnd.ms-excel') {
           var reader = new FileReader();
           reader.onload = function (e) {
               $('#blah')
                 .attr('src', e.target.result);

           };
           reader.readAsDataURL(input.files[0]);
         }
       }
   }

   readURL(form.querySelector('input[type="file"]'))
    //submitForm(form, true)
  })
})
