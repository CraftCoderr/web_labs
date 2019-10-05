function categories() {
  var argc = arguments.length
  var ul = document.getElementById('categorylist').children[0]
  for (var i = 0; i < argc; i++) {
    var li = document.createElement('li')
    li.className = 'categorylink'
    li.innerHTML = `<a href="#${arguments[i]}">${arguments[i].toUpperCase()}</a>`
    ul.appendChild(li)
  }
}
