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
  <div class="submit-btn">
    <a class="btn" @click="toggleShow">upload image</a>
      <my-upload field="img"
          @crop-success="cropSuccess"
          @crop-upload-success="cropUploadSuccess"
          @crop-upload-fail="cropUploadFail"
          v-model="show"
          langType="En"
          :width="300"
          :height="300"
          :params="params"
          :headers="headers"
          img-format="png"></my-upload>
    <button class="btn waves-effect waves-light" v-on:click="storeAccount()" type="submit" name="action">Submit
      <i class="material-icons right">send</i>
    </button>
  </div>
  <div class="preview">
    <img :src="imgDataUrl">
  </div>
</div>
</template>
<script>
import axios from 'axios';
import myUpload from 'vue-image-crop-upload';
  export default {
    data () { return {
      FullName:'',
      Email:'',
      UserName:'',
      Password:'',
      PasswordConfirmation:'',
      show: true,
            params: {
                token: '123456798',
                name: 'avatar'
            },
            headers: {
                smail: '*_~'
            },
            imgDataUrl: ''
    }
  },
  components: {
            'my-upload': myUpload
    },
    props: [],
    methods: {
      storeAccount()
      {
        var vm=this;
        axios.post(`/register-store`,{
          emulateJSON: true,
          Avatar:this.imgDataUrl,
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
          vm.$swal('Oops...',error.response.data.message,'error');
          });
      },
      toggleShow() {
                this.show = !this.show;
            },
            /**
             * crop success
             *
             * [param] imgDataUrl
             * [param] field
             */
            cropSuccess(imgDataUrl, field){
                console.log('-------- crop success --------');
                this.imgDataUrl = imgDataUrl;
            },
            /**
             * upload success
             *
             * [param] jsonData  server api return data, already json encode
             * [param] field
             */
            cropUploadSuccess(jsonData, field){
                console.log('-------- upload success --------');
                console.log(jsonData);
                console.log('field: ' + field);
            },
            /**
             * upload fail
             *
             * [param] status    server api return error status, like 500
             * [param] field
             */
            cropUploadFail(status, field){
                console.log('-------- upload fail --------');
                console.log(status);
                console.log('field: ' + field);
            }
    },

  }
</script>

<style lang="css">
.customer-reg-container
{
  padding:25px 80px 55px 80px;
  min-height: 100vh;
}
.submit-btn
{
  display: flex;
  justify-content: center;
}
.submit-btn a
{
  margin-right: 10px;
}
.preview
{
  display: flex;
  margin-top: 20px;
}
.preview img
{
  margin:auto;
}
</style>
