<!--community area start-->
<div class="community-area v2 wow fadeInUp section-padding" id="contact" style="visibility: visible; animation-name: fadeInUp;">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="heading">
                        <h5></h5>
                        <div class="space-10"></div>
                        <h1>Sign in Form</h1>
                    </div>
                    <div class="space-30"></div>
                    <p><span style="font-size: 1.3em;">Not yet a user ? </span> <a href="<?= SIGNUP; ?>" class="gradient-btn v1">Sign up</a></p>
                    <div class="space-30"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 offset-3">
                    <div class="contact-form">
                        <form>
                            <input type="email" id="email" name="email" placeholder="your email address">
                            <div class="space-20"></div>
                            <input type="password" id="password" name="password" placeholder="your password">
                                                  
                        
                        <div class="space-20"></div>
                        <div class="row">
                            <div class="col">
                            <button style="cursor: pointer;" class="btn btn-primary" id="signin">Sign in</button>
                            </div>
                        </form>
                            <div class="col">
                            <a href="<?= FORGOT_PASSWORD; ?>" class="gradient-btn">Forgot Password ?</a>
                            </div>
                    </div>
                </div>
            </div>
            
        </div>
        
    </div>
    
    
</div>
    <!--community area end-->

    <script>
        $('form').submit((e)=>{
            e.preventDefault();
            
            var email = $('#email').val();
            var pass = $('#password').val();

            if (email == '' || email == ' ' || email == null || email == undefined) {
                $('#emailerror').remove();
                $('#email').after('<p style="color:red;" id="emailerror">email address field is required</p>');
                return;
            } else {
                $('#emailerror').remove();
            }

            if (pass == '' || pass == ' ' || pass == null || pass == undefined) {
                $('#passerror').remove();
                $('#password').after('<p style="color:red;" id="passerror">password field is required</p>');
                return;
            } else {
                $('#passerror').remove();
            }

            var formdata = $('form').serialize();
            var signin = $('#signin');
            signin.prop({'disabled':'true'}).html('processing . . .');

            $.ajax({
                type : 'POST',
                url : '/user/auth',
                data : formdata,
                success : (response) => {
                    
                    switch (response) {
                        case 'ne':
                            alert('This user does not exist');
                            signin.removeAttr('disabled').html('Sign in');
                            break;

                        case 'ic':
                            alert('Incorrect Username or Password');
                            signin.removeAttr('disabled').html('Sign in');
                            break;

                        case 'tni':
                            alert('An Error occurred, please try again in a short while');
                            signin.removeAttr('disabled').html('Sign in');
                            break;

                        case 'mns':
                            alert('An Error occured, please try again in a short while');
                            signin.removeAttr('disabled').html('Sign in');
                            break;

                        case 'ms':
                            alert('Email not verified, a verification link has been sent to your email. \n please check your spam if not found inbox and move it to inbox');
                            signin.removeAttr('disabled').html('Sign in');
                            break;

                        case 'lcni':
                            alert('An error occurred while signing you in, please try again in a short while');
                            signin.removeAttr('disabled').html('Sign in');
                            break;

                        case 'lcns':
                            alert('An error occurred, login code was not sent. please try again in a while');
                            signin.removeAttr('disabled').html('Sign in');
                            break;

                        case 'lcs':
                            $('#signin').prop({'disabled':'true'}).html('credentials verified');
                            setTimeout(() => {
                                alert('Login code has been sent to your email. \n please check your spam if not found inbox and move it to inbox');                          
                                window.location = '/user/login';
                            }, 1000);
                            break;

                        case 'usli':
                            window.location = '/user/dashboard';
                            break;
                    
                        default:
                            break;
                    }
                }
            });
        })

    </script>