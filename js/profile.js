function displayProfile() {
    let user_id = localStorage.getItem("user_id");
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "php/profile.php?user_id=" + user_id, true);
    
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let response = JSON.parse(xhr.responseText);
            document.getElementById("name").innerHTML = response.name;
            document.getElementById("age").innerHTML = response.age;
            document.getElementById("dob").innerHTML = response.dob;
            document.getElementById("email").innerHTML = response.email;
            document.getElementById("contact").innerHTML = response.contact;
        }
    };
    xhr.send();
    }
    
    document.getElementById("logoutBtn").addEventListener("click", function(){
    localStorage.removeItem("user_id");
    window.location.href = "php/login.php";
    });