const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');
const SIGNUPFIRSTNAME = document.getElementById('FirstName');
const SIGNUPLASTNAME = document.getElementById('LastName');
const BIRTHDATE = document.getElementById('birthdate');
const SIGNUPEMAIL = document.getElementById('SignUpEmail');
const SIGNUPPASSWORD = document.getElementById('pwd');
const passworderror = document.getElementById("passworderror");



signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});

FormData.addEventListener('submit', (e) => {
	let messages = [];
	if(SIGNUPFIRSTNAME.value == NULL || SIGNUPFIRSTNAME.value ===''){
		messages.push("First Name is REQUIRED");

	}

	if(messages.length > 0){
		e.preventDefault();
		passworderror.innerHTML = messages.join(', ');
		alert("eh");
	}
	
})

function Validation() {
	if (passworderror.style.visibility == "visible" ) {
	   

	} else {



	  $.post("insert.php", {
		seats: seats_id,
		numseats: num_seats,
		movieid: movie_id,
		showtimeid: shid,
		price: total,
	  }, function(data, status) {
		alert(data);
	  });

	 




	}
  }



function passwordcheck(pwd){
	var regex = /^(?=.*\d)(?=.*[A-Z])(.{8,50})$/; //at least 1 capital, min length 8, max length 50
	

	if (pwd.value.match(regex)) {
		passworderror.style = "visibility: hidden;color:red;font-size:10px;";
	}else if(pwd == "") {  
		document.getElementById("passworderror").innerHTML = "**Fill the password please!";  
		passworderror.style = "visibility: visible;color:red;font-size:10px;";   
	  } else {
		passworderror.style = "visibility: visible;color:red;font-size:10px;";
 }
}

