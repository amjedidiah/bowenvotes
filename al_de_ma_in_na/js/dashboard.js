// js

const showPostCand = (position, election) => {
  let div = $('div.candidates-load'),
      divCont = div.html()

  $.ajax({
    type: 'POST',
    url: './action.php?jsDoc=yes',
    beforeSend: function() {
      div.show().addClass('animated fadeInRight')

      let pst = div.find('#positionName'),
          cst = div.find('#candidateName'),
          est = div.find('#electionName')

          pst.val(position)
          cst.attr('position', position)

          est.val(election)
          cst.attr('election', election)

    },
    data: 'candidatePosition='+position+'&candidateElection='+election,
    success: function(data) {
      div.html(divCont + data)
    }
  })
}
$('.position').click(function() {
  showPostCand(this.getAttribute('id'), this.getAttribute('election'));
})
