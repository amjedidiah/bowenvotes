// js

//Define forms
let regForm = document.querySelector('#formValidate'),
    loginForm = document.querySelector('#formLogin'),
    resetForm = document.querySelector('#formReset')

// Email Validation
const validateEmail = (email) => {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}




//getLoginForm
const getLoginForm = (form, loginForm) => {
  regForm.className = 'form1 d-none animated bounceOutLeft'
  loginForm.className = 'form1 next-form d-block animated bounceInRight'
}
document.querySelector('.login-form-getter').addEventListener('click', () => {
  getLoginForm(regForm, loginForm)
})




//getLoginFormAgain
const getLoginFormAgain = (resetForm, loginForm) => {
  resetForm.className = 'form1 d-none animated bounceOutLeft'
  loginForm.className = 'form1 next-form d-block animated bounceInLeft'
}
document.querySelector('.login-form-again-getter').addEventListener('click', () => {
  getLoginFormAgain(resetForm, loginForm)
})




//getRegsiterForm
const getRegisterForm = (regForm, loginForm) => {
  regForm.className = 'form1 d-block animated bounceInLeft'
  loginForm.className = 'form1 next-form d-none animated bounceOutRight'
}
document.querySelector('.register-form-getter').addEventListener('click', () => {
  getRegisterForm(regForm, loginForm)
})




//getResetForm
const getResetForm = (resetForm, loginForm) => {
  resetForm.className = 'form1 d-block animated bounceInRight'
  loginForm.className = 'form1 next-form d-none animated bounceOutLeft'
}
document.querySelector('.reset-form-getter').addEventListener('click', () => {
  getResetForm(resetForm, loginForm)
})




const formControlValidate = (a) => {
  let val = a.val(),
      id = a.attr('id'),
      msg

  if(id.includes('ail')) {
    if(validateEmail(val) === false) {
        msg = 'Please enter a valid email address'
    } else {
      msg = '';
    }
  } else if(id === '') {

  }

  a.parent().find('small').html(msg);

}
$('.form-control-validated').change(function() {
  formControlValidate($(this));
});




const submitForm = (form, err=0) => {

  //Get errors
  let smalls = form.querySelectorAll('small'),
      btn = form.querySelector('.btn'),
      btnHTML = btn.innerHTML,
      nextForm = document.querySelector('.next-form')
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

      if(data === '0' || data === '1') {
        getLoginForm(form, nextForm)
      }

      form.querySelector('div#sub-msg').innerHTML = data
      form.querySelector('div#sub-msg').className = 'sub-msg-visible'
      btn.innerHTML = btnHTML

      if(data === '2') {
        window.location = './'
      }
    }
  }) : 'no'

}
document.querySelectorAll('form').forEach((a,b) => {
  a.addEventListener('submit', (event) => {
    event.preventDefault()
    submitForm(a)
  })
})
