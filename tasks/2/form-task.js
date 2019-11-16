function sumForm (form) {
  var elements = form.elements
  var sum = 0
  for (var i = 0; i < elements.length; i++) {
    if (elements[i].type === 'text') {
      var value = elements[i].value
      var num = Number(value)
      if (num > 0) {
        sum += num
      } else {
        console.log('Error: ' + num)
      }
    }
  }
  console.log('Form sum is ' + sum)
  return sum
}
