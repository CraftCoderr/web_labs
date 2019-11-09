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

window.addEventListener('load', (event) => {
  setInterval(function () {
    var date = new Date()
    var dateStr = date.getDate() + ' ' + monthNames[date.getMonth()] + ' ' + date.getFullYear()
    document.getElementById('timer').textContent = dateStr
  }, 1000)
})
