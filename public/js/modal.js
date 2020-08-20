function showModal(yesCallback, noCallback) {
  $('main').css('filter', 'blur(3px)')
  $('#modal').fadeIn('fast')
  $('#yes-btn').unbind().click(yesCallback)
  $('#no-btn').unbind().click(noCallback)
}

function closeModal() {
  $('main').css('filter', '')
  $('#modal').fadeOut('fast')
}
