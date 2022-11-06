function ajax(){
  var req = new XMLHttpRequest();
  req.onreadystatechange = function(){
    if (req.readyState == 4 && req.status == 200) {
        document.querySelector('#chat').innerHTML = req.responseText;
    }
  }
  req.open('GET', '../pag/chat.php', true);
  req.send();
}

setInterval(function(){ajax();}, 1000);
