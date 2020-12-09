<!--community area start-->
<div class="community-area v2 wow fadeInUp section-padding" id="contact" style="visibility: visible; animation-name: fadeInUp;">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="heading">
                        <h5></h5>
                        <div class="space-10"></div>
                        <h1>Forgot password Form</h1>
                    </div>
                    <div class="space-30"></div>
                    
                    <div class="space-30"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 offset-3">
                    <div class="contact-form">
                        <form>
                            <input type="email" name="email" placeholder="your email address">
                            <div class="space-20"></div>
                            <button class="btn btn-primary">Send Password Reset Link</button>
                        </form>
                        
                    </div>
                </div>
                
            </div>
            
        </div>
        
       
    </div>
    <!--community area end-->

    <script>
        $('form').submit((e) => {
            e.preventDefault();

            var formdata = $('form').serialize();

            var btn = $('form button');
            btn.prop({'disabled':'true'}).html('processing . . .');

            $.ajax({
                type : 'POST',
                url : '/user/sendpasswordresetlink',
                data : formdata,
                success : (response) => {
                    switch (response) {
                        case 'ie':
                            setTimeout(() => {
                                btn.html('Invalid Email Address');
                            }, 3000);
                            
                            setTimeout(() => {
                                alert('Invalid Email Address');
                                btn.removeAttr('disabled').html('Send Password Reset Link');
                            }, 6000);
                            break;

                        case 'prls':
                            setTimeout(() => {
                                btn.html('email address confirmed');
                            }, 3000);
                            setTimeout(() => {
                                alert('A password reset link has been sent to your email. \n please check your spam if not found inbox and move it to inbox');
                                window.location = '/user/signin';
                            }, 6000);
                            break;
                    
                        default:
                            break;
                    }
                }
            });
        });
    </script>