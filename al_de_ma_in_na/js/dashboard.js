// js

//code & decode function

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

const decodeValue = (coded_value, separator='_') => {
  let array = coded_value.split(separator),
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
        ze: 0,
        on: 1,
        tw: 2,
        th: 3,
        fo: 4,
        fi: 5,
        si: 6,
        se: 7,
        ei: 8,
        ni: 9
      },
      decoded_value = []

  array.forEach((a,b) => {
    for (x in cipher) {
      a === x ? decoded_value.push(cipher[x]) : ''
    }
  })
  return decoded_value.join('')
}




const loaderst = (div, a, b) => {
  div.load('./views/candidate.php?position='+a+'&election='+b, function() {
    $('.position').click(function() {
      showPostCand(this.getAttribute('id'), this.getAttribute('election'))
    })

    $('.candidate').click(function() {
      deleteStuff(this)
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




//deleteBtn
const deleteStuff = (btn) => {
  let election = btn.getAttribute('es_n'),
      position = btn.getAttribute('ep_n'),
      candidate = btn.getAttribute('ec_n')

      xhttp = new XMLHttpRequest()
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          let data = this.responseText

          if(data.includes('jedidiah')) {
            let div = $('div.candidates-load')
                data = data.split('jedidiah')

            loaderst(div, data[1], data[0])
          } else {
            $('#elections').load('./views/election.php', function() {

              $('.position').click(function() {
              showPostCand(this.getAttribute('id'), this.getAttribute('election'));
              })

              $('span.del-btn').click(function() {
                deleteStuff(this)
              })
            })
          }

        }
      }
      xhttp.open("GET", `action.php?electionDel=${election}&positionDel=${position}&candidateDel=${candidate}`, true)
      xhttp.send()
}
$('span.del-btn').click(function() {
  deleteStuff(this)
})
