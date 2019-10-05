var titles = ['27.08.2017', '15.10.2017', '15.10.2017', '22.10.2017', '22.10.2017', '8.11.2017', '24.12.2017', '29.08.2018', '21.10.2018', '11.11.2018', '28.11.2018', '3.12.2018', '02.01.2019', '08.03.2019', '28.09.2019'];
var photos = ['21041672.jpg', '22430178.jpg', '22580631.jpg', '22710566.jpg', '22636999.jpg', '23347999.jpg', '25015541.jpg', '39301472.jpg', '43201094.jpg', '5.jpg', '4.jpg', '3.jpg', '2.jpg', '1.jpg', '69941812.jpg'];
var count = photos.length

var container = document.getElementById('container')

for (var i = count - 1; i >= 0; i--) {
  var div = document.createElement('div')
  div.className = 'photo'
  div.innerHTML = `<img src="photos/${photos[i]}" alt="${titles[i]}"><div class="description"><p>${titles[i]}</p></div>`;
  container.appendChild(div)
}
