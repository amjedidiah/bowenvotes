// js

//deleteBtn
const deleteStuff = (btn) => {
  let election = btn.getAttribute('es_n'),
      position = btn.getAttribute('ep_n'),
      candidate = btn.getAttribute('ec_n')

      xhttp = new XMLHttpRequest()
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          let data = this.responseText
          $('#elections').load('./views/election.php', function() {
            $('span.del-btn').click(function() {
              deleteStuff(this)
            })
          })
        }
      }
      xhttp.open("GET", `action.php?electionDel=${election}&positionDel=${position}&candidateDel=${candidate}`, true)
      xhttp.send()
}
$('span.del-btn').click(function() {
  console.log('starting...')
  deleteStuff(this)
})


const showPostCand = (position, election) => {
  let div = $('div.candidates-load'),
      divCont = div.html(),
      data = {
        position,
        election
      },
      inputs = []

      Object.keys(data).forEach((a, b) => inputs[b] = data[a])
}
$('.position').click(function() {
  showPostCand(this.getAttribute('id'), this.getAttribute('election'));
})
