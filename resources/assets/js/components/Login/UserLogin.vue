<template lang="html">
  <div class="login-container" style="color#fff;">
    <div class="login-title-head">
      <h5>Login</h5>
    </div>
    <div class="input-field col s6">
      <i class="material-icons prefix">account_circle</i>
      <input id="icon_prefix" type="text" v-model="username" class="validate">
      <label for="icon_prefix">Username</label>
    </div>
    <div class="input-field col s6">
      <i class="material-icons prefix">vpn_key</i>
      <input id="icon_telephone" v-model="password" type="password" class="validate">
      <label for="icon_telephone">Password</label>
    </div>
    <div class="login-btn-container">
      <a href="#"><p>Forgot password?</p></a>
      <button class="btn waves-effect waves-light" v-on:click="sendLogin()" type="submit" name="action">Submit
        <i class="material-icons right">send</i>
      </button>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
  export default {
    data () {
      return {
        username:'',
        password:'',
      }
    },
    props: [],
    methods:
    {
      sendLogin()
      {
        var vm=this;
        axios.post(`/user-login`,{
          username:this.username,
          password:this.password
        }).then(function(response)
        {
          console.log(response);
          if (response.data.redirect!=null)
          {
            window.location=response.data.redirect;
          }
        }).catch(function(error)
        {
          console.log(error.response.data);
        });
      }
    },
  }
</script>

<style lang="css">
.login-container
{
  height: 100vh;
  width:600px;
  padding:30px 100px;
  margin: 0 auto;
  background: #fff;
}
.login-btn-container
{
  display: flex;
  margin-top: 30px;
  justify-content:space-between;
}
.login-title-head
{
  margin-bottom: 100px;
}
</style>
