function seat(id) {
  
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
       


      }
    };
    
    xmlhttp.open("GET","booking.php?showtime_id="+id,true);
    xmlhttp.send();
  }