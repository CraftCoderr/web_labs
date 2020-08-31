function toggleNav() {
  var nav = document.getElementById('mainNav');
  if (nav.className === 'topnav') {
    nav.className += ' responsive'
  } else {
    nav.className = 'topnav'
  }
}

const monthNames = ['January', 'February', 'March', 'April', 'May', 'June',
  'July', 'August', 'September', 'October', 'November', 'December'
]

function onMouseOver (event) {
  event.target.classList.add('hovered')
}

function onMouseOut (event) {
  event.target.classList.remove('hovered')
}

window.addEventListener('load', (event) => {
  setInterval(function () {
    var date = new Date()
    var dateStr = date.getDate() + ' ' + monthNames[date.getMonth()] + ' ' + date.getFullYear()
    // document.getElementById('timer').textContent = dateStr
  }, 1000)

  var children = document.getElementById('mainNav').children
  for (var i = 0; i < children.length; i++) {
    if (children[i].tagName === 'A') {
      children[i].addEventListener('mouseover', onMouseOver, false)
      children[i].addEventListener('mouseout', onMouseOut, false)
    }
  }
})
