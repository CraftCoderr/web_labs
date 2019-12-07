var popid = 1

function setPopover(jq, text) {
  var newid = popid++
  jq.eq(0)
    .attr('data-pop-id', 'popover-' + newid)
    .attr('data-pop-state', true)
    .hover(function() {
      $(this).attr('data-pop-state', true)
      var curid = $(this).attr('data-pop-id')
      $('#' + curid).fadeIn('fast')
    }, function() {
      $(this).attr('data-pop-state', false)
      var $this = $(this)
      setTimeout(function() {
        var state = $this.attr('data-pop-state')
        var curid = $this.attr('data-pop-id')
        if (state === 'false') {
          $('#' + curid).fadeOut('fast')
        }
      }, 500)
    })
    .after('<div id="popover-' + newid + '" class="popover" style="display: none;"><div class="arrow-up"></div><p>' + text + '</p></div>')
}

function removePopover(jq) {
  if (jq.is('[data-pop-id]')) {
    $(`#${jq.attr('data-pop-id')}`).remove()
  }
}
