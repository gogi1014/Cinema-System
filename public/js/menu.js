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

function formdata() 
{
var firstname1= document.getElementById("filterID").value;
window.location  = "/api/movie/" + firstname1;

}

function changeType(typee) 
{
  document.getElementById("Typ").value = typee;
}

function formDelete() 
{
var firstname1= document.getElementById("searchfield").value;
document.document.getElementById('search-theme-form').action = "{{route('movie.destroy'," + firstname1 + ")}}";

}