<template lang="html">
<div class="customer-reg-container">
  <div class="input-field col s6">
    <i class="material-icons prefix">account_circle</i>
    <input id="fullname" placeholder="`" :class="[ValidationErrors.FullName!=null?'invalid':'']" v-model="FullName" class="validate" type="text" >
    <label for="fullname" :data-error="[ValidationErrors.FullName!=null?ValidationErrors.FullName[0]:'']">Fullname</label>
  </div>
  <div class="input-field col s6">
    <i class="material-icons prefix">mail</i>
    <input id="email" placeholder="`" :class="[ValidationErrors.Email!=null?'invalid':'']" v-model="Email" type="email" >
    <label for="email" :data-error="[ValidationErrors.Email!=null?ValidationErrors.Email[0]:'']">Email</label>
  </div>
  <div class="input-field col s6">
    <i class="material-icons prefix">person</i>
    <input id="username" placeholder="`" :class="[ValidationErrors.UserName!=null?'invalid':'']" type="text" v-model="UserName" >
    <label for="username" :data-error="[ValidationErrors.UserName!=null?ValidationErrors.UserName[0]:'']">Username</label>
  </div>
  <div class="input-field col s6">
    <i class="material-icons prefix">lock</i>
    <input id="pword" placeholder="`" :class="[ValidationErrors.password!=null?'invalid':'']"  type="password" v-model="Password" >
    <label for="pword" :data-error="[ValidationErrors.password!=null?ValidationErrors.password[0]:'']">Password</label>
  </div>
  <div class="input-field col s6">
    <i class="material-icons prefix">vpn_key</i>
    <input id="pword-confirm" placeholder="`" :class="[ValidationErrors.password!=null?'invalid':'']" type="password" v-model="PasswordConfirmation" >
    <label for="pword-confirm" :data-error="[ValidationErrors.password!=null?ValidationErrors.password[0]:'']">Confirm-Password</label>
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
      show: false,
            params: {
                token: '123456798',
                name: 'avatar'
            },
            headers: {
                smail: '*_~'
            },
            imgDataUrl: '',
      ValidationErrors:[]
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
          Materialize.toast(error.response.data.message, 4000);
          vm.ValidationErrors = error.response.data.errors;
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
