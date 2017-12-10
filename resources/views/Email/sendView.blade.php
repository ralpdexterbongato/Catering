

<style media="all">
  .email-container
  {
    padding:20px;
    background:#ccc;
  }
  .name
  {
    border-top: 1px solid #f7f7f7;
  }
</style>
<div class="email-container">
  <h4>Good day!</h4>
  <p>Thank your for signing up to our website,
  here is your vefirication link <a href="{{route('sendEmailDone',["email"=>$user->email,"verificationCode"=>$user->confirmation_code])}}">CLICK HERE</a>.</p>
  <div class="closing">
    <p class="name">Paclipan Julius</p>
    <p>-Catering staff</p>
  </div>
</div>
