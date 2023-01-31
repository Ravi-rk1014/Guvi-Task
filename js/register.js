$(document).ready(function(){
  $("#registerBtn").click(function(){
    var email = $("#email").val();
    var password = $("#password").val();
    var name = $("#name").val();
    var dob = $("#dob").val();
    var age = $("#age").val();
    var contact = $("#contact").val();
     console.log(email)
    $.ajax({
      url: "php/register.php",
      type: "POST",
      data: {
        email: email,
        password: password,
        name: name,
        dob: dob,
        age: age,
        contact: contact
      },
      success: function(data){
        console.log(data);
      }
    });
  });
});
