var photos = []
var count = 0
var currentIndex = 0

function updateModalContent (animationOff) {
  if (currentIndex < 0) {
    currentIndex = 0
    return
  }
  if (currentIndex > count - 1) {
    currentIndex = count - 1
    return
  }

  if (currentIndex === 0) {
    $('#btn-prev').addClass('disabled-btn')
  } else {
    $('#btn-prev').removeClass('disabled-btn')
  }

  if (currentIndex === count - 1) {
    currentIndex = count - 1
    $('#btn-next').addClass('disabled-btn')
  } else {
    $('#btn-next').removeClass('disabled-btn')
  }

  $('#modal').fadeIn(200)
  $('#image-number').text(`${Number(currentIndex) + 1} of ${count}`)
  if (!animationOff) {
    $('#photo-img').fadeOut('fast', () => {
      $('#photo-img')
        .attr('src', photos[currentIndex].src)
        .attr('alt', photos[currentIndex].title)
        .fadeIn('fast')
    })
  } else {
    $('#photo-img')
      .attr('src', photos[currentIndex].src)
      .attr('alt', photos[currentIndex].title)
  }
}

function photoClick (event) {
  var element = event.currentTarget
  currentIndex = element.id

  updateModalContent(true)
}

function prevPhoto () {
  currentIndex--
  updateModalContent()
}

function nextPhoto () {
  currentIndex++
  updateModalContent()
}

function modalClose (_) {
  $('#modal').fadeOut(130)
}

function modalKey (event) {
  if (event.keyCode === 27) {
    modalClose()
  } else if (event.keyCode === 37) {
    prevPhoto()
  } else if (event.keyCode === 39) {
    nextPhoto()
  }
}

$(() => {
  var photoElements = document.getElementsByClassName('photo')

  let photo
  for (photo of photoElements) {
    var img = photo.getElementsByTagName('img')[0]
    photos.unshift({
      title: img.getAttribute('alt'),
      src: img.getAttribute('src')
    })
    photo.addEventListener('click', photoClick, false)
  }

  count = photos.length

  $('#modal-close').click(modalClose)
  $('#btn-prev').click(prevPhoto)
  $('#btn-next').click(nextPhoto)
  $(document).keydown(modalKey)
})
