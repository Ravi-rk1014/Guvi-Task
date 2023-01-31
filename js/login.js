
const form = document.querySelector('form');
document.getElementById("loginBtn").addEventListener("click", function(){
  let email = document.getElementById("email").value;
  let password = document.getElementById("password").value;
  let data = {
      email: email,
      password: password
  };
  
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/login.php", true);
  xhr.setRequestHeader("Content-Type", "application/json");
  
  xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
          let response = JSON.parse(xhr.responseText);
          if (response.error) {
              alert(response.error);
          } else {
              localStorage.setItem("user_id", response.user_id);
              displayProfile();
          }
      }
  };
  xhr.send(JSON.stringify(data));
  });