var titles = ['27.08.2017', '15.10.2017', '15.10.2017', '22.10.2017', '22.10.2017', '8.11.2017', '24.12.2017', '29.08.2018', '21.10.2018', '11.11.2018', '28.11.2018', '3.12.2018', '02.01.2019', '08.03.2019', '28.09.2019'];
var photos = ['21041672.jpg', '22430178.jpg', '22580631.jpg', '22710566.jpg', '22636999.jpg', '23347999.jpg', '25015541.jpg', '39301472.jpg', '43201094.jpg', '5.jpg', '4.jpg', '3.jpg', '2.jpg', '1.jpg', '69941812.jpg'];
var count = photos.length
var currentIndex = 0

function updateModalContent(animationOff) {
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
      .attr('src', 'photos/' + photos[currentIndex])
      .attr('alt', titles[currentIndex])
      .fadeIn('fast')
    })
  } else {
    $('#photo-img')
    .attr('src', 'photos/' + photos[currentIndex])
    .attr('alt', titles[currentIndex])
  }
}

function photoClick(event) {
  var element = event.currentTarget
  currentIndex = element.id

  updateModalContent(true)
}

function prevPhoto() {
  currentIndex--
  updateModalContent()
}

function nextPhoto() {
  currentIndex++
  updateModalContent()
}

function modalClose(_) {
  $('#modal').fadeOut(130)
}

function modalKey(event) {
  if (event.keyCode === 27) {
    modalClose()
  } else if (event.keyCode === 37) {
    prevPhoto()
  } else if (event.keyCode === 39) {
    nextPhoto()
  }
}

$(() => {
  var container = document.getElementById('container')

  for (var i = count - 1; i >= 0; i--) {
    var div = document.createElement('div')
    div.id = i
    div.className = 'photo'
    div.innerHTML = `<img src="photos/${photos[i]}" alt="${titles[i]}"><div class="description"><p>${titles[i]}</p></div>`
    div.addEventListener('click', photoClick, false)
    container.appendChild(div)
  }

  $('#modal-close').click(modalClose)
  $('#btn-prev').click(prevPhoto)
  $('#btn-next').click(nextPhoto)
  $(document).keydown(modalKey)
})
