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

$("#dateSelected").change(function() {
  $("#Selecteed").load(location.href+" #Selecteed>*","");
}); 

function timeButton(time,date) {
  document.getElementById("timee").value = time;
  document.getElementById("myPara").innerHTML = "Вие избрахте в " + time + " часа" + " на дата: " + date;
}