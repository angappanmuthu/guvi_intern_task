$(document).ready(function() {
    $("#register_form").submit(function(e){
      e.preventDefault();
       console.log("register");
       $("div[name= 'warn']").html("").show();

         var mob = $('input[name="mobile"]').val()
         var pass = $('input[name="pass"]').val()
         var cpass = $('input[name="cpass"]').val()

         if (pass != "" && cpass != "" && pass == cpass){
            
            $.ajax({
               type: 'POST',
               url: 'api/register.php',
               data: $("#register_form").serialize(), // or JSON.stringify ({name: 'jonas'}),
               success: function(data) { 
                  console.log(data);
                  if (data.status == true){
                     $(location).attr('href', 'login.html');
                  }else if(data.status == false){
                     $('#register_form').trigger("reset");
                     alert(data.reason);
                     $(location).attr("href","login.html");
                  }
               },
               // contentType: "application/json",
               // dataType: 'json'
               });
         }else{
            $("div[name= 'warn']").html("wrong password").show();
         }
    });



    // Login From
    $("#login_form").submit(function(e){
      console.log('login');
      var mobile = $('input[name="mobile"]').val();
      var pass = $('input[name="pass"]').val();
      (mobile != "" && pass != "") ?
      $.ajax({
         type: "POST",
         url: "./api/login.php",
         data: $("#login_form").serialize(),
         success: function(data){
            console.log(data);
            if(data.status == true){
               $(location).attr('href','profile.html');
               sessionStorage.setItem("mobile", mobile);
            }else{
               $(location).attr('href','index.php');
            }
         }
      }):alert("Some Field is empty!");
      e.preventDefault();
    });
 });