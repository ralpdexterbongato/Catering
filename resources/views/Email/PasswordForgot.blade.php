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
  <h4>Hello there!</h4>
  <p>Did you forgot your password?,
  if yes, change your password <a href="{{route('PasswordRecovery',["email"=>$data->email,"confirmation"=>$data->confirmCode])}}">here</a>.</p>
  <div class="closing">
    <p class="name">Paclipan Julius</p>
    <p>-Catering staff</p>
  </div>
</div>
