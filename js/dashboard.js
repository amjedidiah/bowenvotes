
const codeValue = (value, separator='_') => {
  let array = value.split(''),
      cipher = {
        al: "a",
        ba: "b",
        ca: "c",
        de: "d",
        ec: "e",
        fa: "f",
        ga: "g",
        he: "h",
        in: "i",
        ja: "j",
        ka: "k",
        li: "l",
        ma: "m",
        na: "n",
        os: "o",
        pa: "p",
        qu: "q",
        ra: "r",
        sa: "s",
        ta: "t",
        un: "u",
        vi: "v",
        wh: "w",
        xy: "x",
        ya: "y",
        za: "z",
        at: "@",
        do: ".",
        sp: "%20",
        sl: "/",
        an: "&",
        cl: " ",
        ze: "0",
        on: "1",
        tw: "2",
        th: "3",
        fo: "4",
        fi: "5",
        si: "6",
        se: "7",
        ei: "8",
        ni: "9"
      },
      coded_value = []

  array.forEach((a,b) => {
    for (x in cipher) {
      a === cipher[x] ? coded_value.push(x) : ''
    }
  })

  return coded_value.join(separator)
}




//deleteBtn
const vote = (btn) => {
  let election = btn.getAttribute('es_n'),
      position = btn.getAttribute('ep_n'),
      candidate = btn.getAttribute('ec_n')

      xhttp = new XMLHttpRequest()
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          let data = this.responseText,
              div = $('div.candidates-load')

          if(data.includes('jedidiah')) {
            data = data.split('jedidiah')

            loaderst(div, codeValue(data[0]), codeValue(data[1]))
            $('.modal #sub-msg').show()
            document.querySelector('.modal #sub-msg').className = 'animated fadeInUp text-center p-5 pt-0'


            setTimeout(function() {
              document.querySelector('.modal #sub-msg').className = 'animated fadeOutDown text-center p-5 pt-0'
              $('.modal #sub-msg').hide()
            },3000)
          } else {
            console.log(data)
          }
        }
      }
      xhttp.open("GET", `action.php?electionVote=${election}&positionVote=${position}&candidateVote=${candidate}`, true)
      xhttp.send()
}




const loaderst = (div, a, b) => {

  div.load('./views/candidate.php?position='+a+'&election='+b, function() {
    $('.position').click(function() {
      showPostCand(this.getAttribute('id'), this.getAttribute('election'))
    })

    $('.candidate').click(function() {
      vote(this)
    })
  })
}




const showPostCand = (position, election) => {

  let div = $('div.candidates-load'),
      post = codeValue(position),
      elect = codeValue(election)

  loaderst(div, post, elect)


}
$('.position').click(function() {
  showPostCand(this.getAttribute('id'), this.getAttribute('election'));
})
