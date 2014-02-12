<style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>

<div class="container">

      <form class="form-signin">
        <h2 class="form-signin-heading">Please sign in</h2>
        <input type="text" class="input-block-level email" placeholder="Email address">
        <input type="text" class="input-block-level name" placeholder="Name">
        <button class="btn btn-large btn-primary submit">Sign in</button>
      </form>

    </div> <!-- /container -->

<script type="text/javascript">
    $(document).ready(function(){
      $('.form-signin .submit').click(function(){
          var reg = new RegExp("^[A-Za-z0-9._%+-]+@[A-Za-z0-9-]+(.[A-Za-z0-9-]+)*\.[A-Za-z]{2,5}$");
          var email = $('.form-signin .email').val();
          console.log(email)
          var name = $('.form-signin .name').val();
          console.log(name)
          if( (typeof email == 'undefined' || email == "") || !reg.test(email)){
            alert('Please enter a valid email');
            return
          }
          if(typeof name == 'undefined' || name == ""){
            alert('Please enter a name');
            return;
          }
          $.ajax({
            type: "POST",
            url: '/auth/loginSuccess',
            data: {'name' : name, 'email' : email},
            success: function(resp){
              if(resp.status == "success")
                window.location.href = "/";
              else
                alert("Unable to login");
            },
            dataType: "json"
          });
          return false;
      })
    })
</script>