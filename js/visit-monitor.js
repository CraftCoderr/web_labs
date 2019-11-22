function getCookie (name) {
  document.cookie.split(';').forEach((element) => {
    var parts = element.split('=')
    if (decodeURIComponent(parts[0]) === name) {
      return decodeURIComponent(parts[1])
    }
  })
}

function setCookie (name, value, expiresIn) {
  document.cookie = encodeURIComponent(name) + '=' + encodeURIComponent(value) + '; max-age=' + expiresIn
}

function getSessionHistory () {
  return JSON.parse(window.sessionStorage.getItem(HISTORY_STORAGE_KEY))
}

function getGlobalHistory () {
  return JSON.parse(window.localStorage.getItem(HISTORY_STORAGE_KEY))
}

const HISTORY_STORAGE_KEY = 'history'

var path = window.location.pathname
var page = path.split('/').pop().split('.')[0]
console.log(page)

var global = getGlobalHistory()
var session = getSessionHistory()
if (global == null) global = {}
if (session == null) session = {}

global[page] += 1
session[page] += 1

console.log(global)
console.log(JSON.stringify(global))

window.localStorage.setItem(HISTORY_STORAGE_KEY, JSON.stringify(global))
window.sessionStorage.setItem(HISTORY_STORAGE_KEY, JSON.stringify(session))
