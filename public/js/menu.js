function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}


function createBooking() {
  var x = document.getElementById("createBooking");
  x.addEventListener('click', function handleClick() {
    x.textContent = 'Button clicked';
  });
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

function showPass() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

$("#dateSelected").change(function () {
  $("#Selecteed").load(location.href + " #Selecteed>*", "");
});

function timeButton(time, date) {
  document.getElementById("timee").value = time;
  document.getElementById("myPara").innerHTML = "Вие избрахте в " + time + " часа" + " на дата: " + date;
}

function formdata() {
  var firstname1 = document.getElementById("filterID").value;
  window.location = "/api/movie/" + firstname1;

}

function changeType(typee) {
  document.getElementById("Typ").value = typee;
}

function formDelete() {
  var firstname1 = document.getElementById("searchfield").value;
  document.document.getElementById('search-theme-form').action = "{{route('movie.destroy'," + firstname1 + ")}}";

}

function getData(e) {
  e.preventDefault();
}

var cnt = 0;
function reply_click(clicked_id) {
  var cusid_ele = document.getElementsByClassName('seat selected');
  var place = document.getElementById("places");
  var docId = document.getElementById(clicked_id);

  if (document.getElementById(clicked_id).className == "seat") {
    cnt++;
    if (cnt > document.getElementById("ticknum").value) {
      for (var i = 0; i == cusid_ele.length; i++) {
        var item = cusid_ele[i];
        item.className = 'seat';
        place.value = "";
        cnt = 0;
      }
    }
    document.getElementById(clicked_id).className = "seat selected";
    document.getElementById("places").value += clicked_id + " ";
  }
  else {
    document.getElementById(clicked_id).className = "seat";
    place.value = place.value.replace(docId.id, "");
    place.value = place.value.replace(/  +/g, " ");
    cnt--;
  }
}