$(document).ready(function(){
    var mobile = sessionStorage.getItem('mobile');
    (mobile != null)?
        $.ajax({
            type: "POST",
            url: "./api/get_profile.php",
            data: 'mobile='+mobile,
            success: function(data) {
                console.log(data);
                $("input[name='name']").val(data[0].name);
                $("input[name='age']").val(data[0].age);
                document.getElementsByName("name").value = data[0].dob;
                $("input[name='email']").val(data[0].email);
                $("input[name='city']").val(data[0].city);
            }
            }):alert("mobile is empty");
    
    $("#profile_form").submit(function(e){
        e.preventDefault();
        console.log('profile');
        var name = $("input[name='name']").val();
        var age = $("input[name='age']").val();
        var dob = $("input[name='dob']").val();
        var email = $("input[name='email']").val();
        var city = $("input[name='city']").val();

        console.log($("#profile_form").serialize()+'&mobile='+sessionStorage.getItem('mobile'));

        if (name != "" && age != "" && dob != "" && email != "" && city != ""){
            $.ajax({
            type: "POST",
            url: "./api/update_profile.php",
            data: $("#profile_form").serialize()+'&mobile='+sessionStorage.getItem('mobile'),
            success: function(data){
                if (data.status == true){
                    alert(data.message);
                }
                console.log(data);
            }
        })
        }else{
            alert("wrong");
        }
    });
})