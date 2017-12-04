<template lang="html">
<div class="customer-reg-container">
  <div class="input-field col s6">
    <i class="material-icons prefix">account_circle</i>
    <input id="icon_prefix" v-model="FullName" type="text" class="validate">
    <label for="icon_prefix">Fullname</label>
  </div>
  <div class="input-field col s6">
    <i class="material-icons prefix">mail</i>
    <input id="icon_mail" v-model="Email" type="email" class="validate">
    <label for="icon_mail">Email</label>
  </div>
  <div class="input-field col s6">
    <i class="material-icons prefix">person</i>
    <input id="icon_prefix" type="text" v-model="UserName" class="validate">
    <label for="icon_prefix">Username</label>
  </div>
  <div class="input-field col s6">
    <i class="material-icons prefix">lock</i>
    <input id="icon_mail" type="password" v-model="Password" class="validate">
    <label for="icon_mail">Password</label>
  </div>
  <div class="input-field col s6">
    <i class="material-icons prefix">vpn_key</i>
    <input id="icon_mail" type="password" v-model="PasswordConfirmation" class="validate">
    <label for="icon_mail">Confirm-Password</label>
  </div>
  <button class="btn waves-effect waves-light" v-on:click="storeAccount()" type="submit" name="action">Submit
    <i class="material-icons right">send</i>
  </button>
</div>
</template>
<script>
import axios from 'axios';
  export default {
    data () { return {
      FullName:'',
      Email:'',
      UserName:'',
      Password:'',
      PasswordConfirmation:''
    }
  },
    props: [],
    methods: {
      storeAccount()
      {
        var vm=this;
        axios.post(`/register`,{
          FullName:this.FullName,
          Email:this.Email,
          UserName:this.UserName,
          password:this.Password,
          password_confirmation:this.PasswordConfirmation
        }).then(function(response)
        {
          console.log(response);
          if (response.data.error==null)
          {
            window.location=response.data.redirect;
          }
        }).catch(function (error)
        {
          console.log(error.response.data);
        });
      },
    },
  }
</script>

<style lang="css">
.customer-reg-container
{
  padding:55px 80px;
}
</style>
