<template lang="html">
  <div class="login-container">
    <div class="login-title-head">
      <h5>Login</h5>
      <div class="progress" v-if="loadingActive">
        <div class="indeterminate"></div>
      </div>
    </div>
    <div class="input-field col s6">
      <i class="material-icons prefix">account_circle</i>
      <input id="icon_prefix" type="text" v-model="username" v-on:keyup.enter="sendLogin()" class="validate">
      <label for="icon_prefix">Username</label>
    </div>
    <div class="input-field col s6">
      <i class="material-icons prefix">vpn_key</i>
      <input id="icon_telephone" v-on:keyup.enter="sendLogin()" v-model="password" type="password" class="validate">
      <label for="icon_telephone">Password</label>
    </div>
    <div class="login-btn-container">
      <a href="/forgot-password">Forgot your password?</a>
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
        loadingActive:false,
      }
    },
    props: [],
    methods:
    {
      sweetalert(msg)
      {
        this.$swal(msg);
      },
      sendLogin()
      {
        this.loadingActive=true
        var vm=this;
        axios.post(`/user-login`,{
          username:this.username,
          password:this.password
        }).then(function(response)
        {
          console.log(response);
          if (response.data.error!=null)
          {
            Materialize.toast(response.data.error, 4000)
          }else
          {
            window.location.href=window.location.href;
          }
          vm.loadingActive=false;
        }).catch(function(error)
        {
          console.log(error.response.data);
          vm.loadingActive=false;
        });
      }
    },
  }
</script>
