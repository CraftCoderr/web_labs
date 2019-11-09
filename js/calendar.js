var monthSelect = document.getElementById('calendar-month')
var yearSelect = document.getElementById('calendar-year')
var calendar = document.getElementById('calendar')
var cells = []
var today = new Date()
var input = document.getElementById('dob')
var ignoreChanged = false

var currentDate = new Date()

initCalendar()

function initCalendar () {
  for (var m = 0; m < 12; m++) {
    var option = document.createElement('option')
    option.value = m
    option.text = monthNames[m]
    monthSelect.appendChild(option)
  }

  for (var y = today.getFullYear() - 100; y <= today.getFullYear(); y++) {
    var option = document.createElement('option')
    option.value = y
    option.text = y
    yearSelect.appendChild(option)
  }

  for (var w = 0; w < 6; w++) {
    var weekRow = document.getElementById('week' + (w + 1))
    var weekCells = []
    for (var d = 0; d < 7; d++) {
      var cell = document.createElement('td')
      weekRow.appendChild(cell)
      weekCells.push(cell)
    }
    cells.push(weekCells)
  }

  document.addEventListener('click', documentClick, false)
  calendar.addEventListener('change', yearMonthChange, false)
  calendar.addEventListener('click', dayClick, false)
  input.addEventListener('mousedown', inputDOBMouseDown, false)
  input.addEventListener('change', dateChanged, false)

  updateCalendar(today)
  setInputValue('')
}

function updateCalendar (date) {
  monthSelect.value = date.getMonth()
  yearSelect.value = date.getFullYear()

  var firstDay = new Date(date.getFullYear(), date.getMonth(), 1)
  var day = firstDay.getDay() - 1
  var daysCount = new Date(date.getFullYear(), date.getMonth(), 0).getDate()
  var week = 0
  cells.forEach((week) => week.forEach((cell) => {
    cell.innerText = ''
  }))
  for (var i = 1; i <= daysCount; i++) {
    day = (day + 1) % 7
    if (day === 0) {
      week++
    }

    cells[week][day].innerText = i
    if (date.getDate() === i) {
      cells[week][day].className = 'selected-day'
    } else {
      cells[week][day].className = ''
    }
  }

  currentDate = date
  setInputValue(currentDate.getDate() + '.' + (currentDate.getMonth() + 1) + '.' + currentDate.getFullYear())
}

var nextCalendarState // undefined = none, true = openned, false = closed

function inputDOBMouseDown (event) {
  if (document.activeElement.id === input.id) {
    nextCalendarState = false
    hideCalendar()
  } else {
    nextCalendarState = true
    showCalendar()
  }
}

function showCalendar() {
  calendar.style.visibility = 'visible'
}

function hideCalendar() {
  calendar.style.visibility = 'hidden'
}

function documentClick (event) {
  if (nextCalendarState === undefined) {
    if (event.target.id !== monthSelect.id && event.target.id !== yearSelect.id) {
      hideCalendar()
    }
    return
  }
  if (!nextCalendarState) {
    document.activeElement.blur()
  }
  nextCalendarState = undefined
}

function yearMonthChange (event) {
  var newDate = new Date(yearSelect.value, monthSelect.value, 1)
  updateCalendar(newDate)
}

function dayClick (event) {
  if (event.target.tagName === 'TD') {
    var day = event.target.innerText
    if (day === '') return
    var newDate = new Date(currentDate.getFullYear(), currentDate.getMonth(), day)
    updateCalendar(newDate)
    hideCalendar()
  }
}

function parseDate (str) {
  var parts = str.split('.')

  console.log(parts)

  if (parts.length !== 3) return

  var day = parts[0]
  var month = parts[1]
  var year = parts[2]

  if (year < 0) return
  if (month < 1 || month > 12) return
  if (day < 1 || day > new Date(year, month - 1, 0).getDate()) return
  return new Date(year, month - 1, day)
}

function dateChanged (event) {
  if (ignoreChanged) {
    ignoreChanged = false
    return
  }
  var date = parseDate(input.value)
  if (date !== undefined) updateCalendar(date)
}

function setInputValue(value) {
  input.value = value
  var ev = document.createEvent('Event')
  ev.initEvent('change', true, false)
  ignoreChanged = true
  input.dispatchEvent(ev)
}
