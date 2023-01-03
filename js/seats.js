
const container = document.querySelector('.container');
const seats = document.querySelectorAll('.row .seat:not(.occupied');
const count = document.getElementById('count');


var response,booking_info,movie_title,seats_id,num_of_seats;

populateUI();

(function loading(){
   document.getElementById('count').innerHTML=0;
         var selected =document.querySelectorAll('.row .seat.selected');

         for (let i = 0; i < selected.length; i++) {
          selected[i].className="seat";
          
}
 
})();



// update total and count
function updateSelectedCount() {
  const selectedSeats = document.querySelectorAll('.row .seat.selected');

  const seatsIndex = [...selectedSeats].map((seat) => [...seats].indexOf(seat));

  localStorage.setItem('selectedSeats', JSON.stringify(seatsIndex));

  //copy selected seats into arr
  // map through array
  //return new array of indexes

  const selectedSeatsCount = selectedSeats.length;

  count.innerText = selectedSeatsCount;

}

// get data from localstorage and populate ui
function populateUI() {
  const selectedSeats = JSON.parse(localStorage.getItem('selectedSeats'));
  if (selectedSeats !== null && selectedSeats.length > 0) {
    seats.forEach((seat, index) => {
      if (selectedSeats.indexOf(index) > -1) {
        seat.classList.add('selected');
      }
    });
  }

  const selectedMovieIndex = localStorage.getItem('selectedMovieIndex');

  if (selectedMovieIndex !== null) {
    movieSelect.selectedIndex = selectedMovieIndex;
  }
}



// Seat click event
container.addEventListener('click', (e) => {
  if (e.target.classList.contains('seat') && !e.target.classList.contains('occupied')) {
    e.target.classList.toggle('selected');

    updateSelectedCount();
  }
});

// intial count and total
updateSelectedCount();

function seat(id,movie_id) {
  
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        response = this.responseText;
        booking_info = response.split("//");
        movie_title=booking_info[0];
        seats_id=booking_info[1].split(",");
        num_of_seats=parseInt(booking_info[2]);
        for (let i = 0; i < num_of_seats; i++) {
          document.getElementById(""+seats_id[i]+"").className="seat occupied";
        }


      }
    };
    
    xmlhttp.open("GET","booking.php?showtime_id="+id+"&movie_id="+movie_id,true);
    xmlhttp.send();
  }



 

  function send_info(tid,stid) {
 
  
  
    var selectedSeats = document.querySelectorAll('.row .seat.selected');
    var count = selectedSeats.length;
    if(count==0){
      alert("Please select seats");
      return;
    }

     var send_seats_id="";

    for (let i = 0; i < count; i++) {
  
    if(i==count-1){
     send_seats_id += document.querySelectorAll(".selected")[i + 1].id;
     break;
     
   }
   send_seats_id += document.querySelectorAll(".selected")[i + 1].id+',';
  }

  var post = "num_seats="+count+"&seats_id="+send_seats_id+"&tid="+tid+"&stid="+stid;
   window.location.href = "payment.php?"+post;

   
  
  }






  

  
