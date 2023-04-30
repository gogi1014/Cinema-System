function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}


function showPass() {
  var x = document.getElementById("passwordLogin");
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
  $("#selectedSeats").load(window.location.href + " #selectedSeats");

  let seatSold = document.getElementById("seatSold");
  var cusid_ele = document.getElementsByClassName('seat');
  for (var i = 0; i < cusid_ele.length; i++) {
    cusid_ele[i].className = 'seat';
    var item = cusid_ele[i].getAttribute('value');
    if (seatSold.value.match(item) != null) {
      cusid_ele[i].className = 'seat sold';
    }
  }
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
$("#ModalSuccess .toggle").click();

$(window).on('load', function() {
  $('#ModalSuccess').modal('show');
});

function getTicketNum(obj) {
  if (obj.value.length > 0) {
    document.getElementById("chooseBtn").disabled = false;
  } else {
    document.getElementById("chooseBtn").disabled = true;
  }
}
var cnt = 0;
function reply_click(clicked_id) {
  var cusid_ele = document.getElementsByClassName('seat selected');
  var place = document.getElementById("places");
  var docId = document.getElementById(clicked_id);

  if (document.getElementById(clicked_id).className == "seat") {
    if (cnt == document.getElementById("ticknum").value) {
      while (cusid_ele.length) {
        var item = cusid_ele[0];
        item.className = 'seat';
        place.value = "";
      }
      cnt = 0;
    }
    document.getElementById(clicked_id).className = "seat selected";
    document.getElementById("places").value += clicked_id + " ";
    cnt++;
    console.log(cusid_ele.length);
  }
  else {
    document.getElementById(clicked_id).className = "seat";
    place.value = place.value.replace(docId.id, "");
    place.value = place.value.replace(/  +/g, " ");
    cnt--;
  }
}

$(document).on('submit', 'form#searchForm', function (e) {
  var q = $(this).find('input[name=q]').val();

  $.ajax({
      type: 'GET',
      dataType: 'html',
      url: '/admin/movies',
      data: {
          q: q
      },
      success: function (result) {

          $("#results_box").html(result);
      }
  });

  e.preventDefault();
});

//Slider
var count = 0;
var inc = 0;
margin = 0;
var slider = document.getElementsByClassName("slider-width")[0];
var itemDisplay = 0;
if (screen.width > 990) {
  itemDisplay = document.getElementsByClassName("slider-container")[0].getAttribute("item-display-d");
  margin = 0;
}
if (screen.width > 700 && screen.width < 990) {
  itemDisplay = document.getElementsByClassName("slider-container")[0].getAttribute("item-display-t");
  margin = itemDisplay * 6.8;
}
if (screen.width > 280 && screen.width < 700) {
  itemDisplay = document.getElementsByClassName("slider-container")[0].getAttribute("item-display-m");
  margin = itemDisplay * 20;
}


var items = document.getElementsByClassName("item");
var itemleft = items.length % itemDisplay;
var itemslide = Math.floor(items.length / itemDisplay) - 1;
for (let i = 0; i < items.length; i++) {
  items[i].style.width = (screen.width / itemDisplay) + "px";
}

function next() {
  if (inc !== itemslide + itemleft) {
    if (inc == itemslide) {
      inc = inc + itemleft;
      count = count - (screen.width / itemDisplay) * itemleft;
    }
    else {
      inc++;
      count = count - screen.width;
    }
  }
  slider.style.left = count + "px";
}

function prev() {
  if (inc !== 0) {
    if (inc == itemleft) {
      inc = inc - itemleft;
      count = count + (screen.width / itemDisplay) * itemleft;
    }
    else {
      inc--;
      count = count + screen.width;
    }
  }
  console.log(inc)
  slider.style.left = count + "px";
}
