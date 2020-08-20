const HISTORY_STORAGE_KEY = 'history'

function getCookie (name) {
  var cookies = document.cookie.split(';')
  for (var i = 0; i < cookies.length; i++) {
    var parts = cookies[i].split('=')
    if (decodeURIComponent(parts[0]) === name) {
      return decodeURIComponent(parts[1])
    }
  }
}

function setCookie (name, value, expiresIn) {
  document.cookie = encodeURIComponent(name) + '=' + encodeURIComponent(value) + '; max-age=' + expiresIn
}

function getSessionHistory () {
  return JSON.parse(window.sessionStorage.getItem(HISTORY_STORAGE_KEY))
}

function getGlobalHistory () {
  return JSON.parse(getCookie(HISTORY_STORAGE_KEY))
}

var path = window.location.pathname
var page = path.split('/').pop().split('.')[0]

var global = getGlobalHistory()
var session = getSessionHistory()
if (typeof global !== 'object' || global === null) global = {}
if (typeof session !== 'object' || session == null) session = {}

if (global[page] === null || isNaN(global[page])) {
  global[page] = 1
} else {
  global[page] += 1
}
if (session[page] === null || isNaN(session[page])) {
  session[page] = 1
} else {
  session[page] += 1
}

setCookie(HISTORY_STORAGE_KEY, JSON.stringify(global), 2592000)
window.sessionStorage.setItem(HISTORY_STORAGE_KEY, JSON.stringify(session))
