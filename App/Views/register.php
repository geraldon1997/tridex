<style>
    select{
        width: 100%;
        background-color: #062489;
        font-family: 'Montserrat', sans-serif;
        font-size: 14px;
        color: #cbe5ff;
        overflow-x : hidden;
        padding: 15px;
        border-radius: 5px;
        border: 1px solid #163fcb;
        text-transform: capitalize;
    }
</style>
<!--community area start-->
<div class="community-area v2 wow fadeInUp section-padding" id="contact" style="visibility: visible; animation-name: fadeInUp;">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="heading">
                        <h5></h5>
                        <div class="space-10"></div>
                        <h1>Sign up Form</h1>
                    </div>
                    <div class="space-30"></div>
                    <p><span style="font-size: 1.3em;">Already a user ? </span> <a href="<?= SIGNIN; ?>" class="gradient-btn v1">Sign in</a></p>
                    <div class="space-30"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 offset-3">
                    <div class="contact-form">
                        <form>
                            <input type="hidden" name="referrer" value="<?= $params ? $params : ''; ?>">
                            <div class="space-20"></div>
                            
                            <input type="email" name="email" placeholder="your Email Address" required id="email">
                            <div class="space-20"></div>

                            <input type="password" name="password" id="password" placeholder="password" required id="password">
                            <div class="space-20"></div>

                            <input type="password" name="confirmpassword" id="confirmpassword" placeholder="confirm password" required>
                            <div class="space-20"></div>
                        
                            <button class="btn btn-primary">Sign up</button>
                        </form>
                    </div>
                </div>
                
            </div>
            
        </div>
        
       
    </div>
    <!--community area end-->

<script>

// (function(){
    
//     var countryForm = $('#country');

//     $.ajax({
//         type : 'GET',
//         url : app_url + 'location/countries',
//         dataType : 'json',
//         success : function(data){
//             data.forEach(country => {
//                 countryForm.append('<option value=' + country.id + '>' + country.name + '</option>');
//             });
//         }
//     });

//     countryForm.change(function(){
//         if (countryForm.val() == '') {
//             $('#phone').val('');
//             $('#phone').focus();
//         } else {
//             $.ajax({
//                 type : 'GET',
//                 url : app_url + 'location/phonecode/' + countryForm.val(),
//                 dataType : 'json',
//                 success : function(data){
//                     $('#phone').val('+' + data + ' ');
//                     $('#phone').focus();
//                 }
//             });
//         }
        
//     });
// })();

$('#password').keyup(()=>{
    var cp = $('#confirmpassword').val();
    var p = $('#password').val();

    if (p != cp) {
        $('#passerror').remove();
        $('#confirmpassword').after('<p style="color:red;" id="passerror">Passwords do not match</p>')
        return;
    } else {
        $('#passerror').remove();
    }
});

$('#confirmpassword').keyup(()=>{
    var cp = $('#confirmpassword').val();
    var p = $('#password').val();

    if (cp != p) {
        $('#passerror').remove();
        $('#password').after('<p style="color:red;" id="passerror">Passwords do not match</p>')
        return;
    } else {
        $('#passerror').remove();
    }
});


$('form').submit((event)=>{
    event.preventDefault();

    $('form button').prop('disabled', 'true');
    $('form button').html('Processing . . .');

    $.ajax({
        type : 'POST',
        url : '/user/store',
        data : {
            email : $('input#email').val(),
            pass : $('input#password').val()
        },
        success : (response) => {
            if (response) {
                setTimeout(() => {
                    $('form button').html('registration was successful');
                }, 1000);
                
                setTimeout(() => {
                    alert('A verification link has been sent to your email.\nplease check your spam if not found inbox and move it to inbox');
                    location.href = "/user/signin"
                }, 2000);
            } else {
                alert('An Error occurred, Registration not successful. possibly duplicate credentials');
                location.href = '/user/signin';
            }
        }
    });
})

</script>