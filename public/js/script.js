// realtime clock
function startTime() {
  var today = new Date()
  let h = today.getHours()
  let m = today.getMinutes()
  let s = today.getSeconds()
  h = checkTime(h)
  m = checkTime(m)
  s = checkTime(s)
  document.getElementById('rtc').innerHTML = h + ":" + m + ":" + s
  setTimeout(startTime, 1000)
}

function checkTime(i) {
  if (i < 10) {
    i = "0" + i
  }
  return i
}
