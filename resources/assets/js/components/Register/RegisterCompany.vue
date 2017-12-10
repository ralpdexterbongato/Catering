<template lang="html">
  <div class="register-company-container">
    <div class="progress" v-if="loading">
      <div class="indeterminate"></div>
    </div>
    <div class="input-field col s6">
      <input id="last_name" v-model="name" type="text" class="validate">
      <label for="last_name">Company name</label>
    </div>
    <div class="input-field col s6">
      <input id="last_name" v-model="description" type="text" class="validate">
      <label for="last_name">Description</label>
    </div>
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
    <div class="register-company-submit">
      <a class="btn" @click="toggleShow">My logo</a>
      <button class="btn waves-effect waves-light" v-on:click="SaveCompany()" type="submit" name="action">Submit
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
    loading:false,
    name:'',
    description:'',
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
  methods: {
    SaveCompany()
    {
      var vm=this;
      this.loading=true;
      axios.post('/company-store',{
        name:this.name,
        description:this.description,
        logo:this.imgDataUrl,
      }).then(function(response)
      {
        console.log(response);
        vm.loading=false;
        window.location.href = window.location.href;
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
.register-company-container
{
  min-height: 100vh;
  padding:25px 80px 55px 80px;
}
.register-company-submit
{
  display: flex;
  justify-content:center;
  margin-bottom: 25px!important;
}
.register-company-submit a
{
  margin-right: 20px;
}
.preview
{
  margin-top: 20px;
  margin:0 auto;
  display: flex;
}
.preview img
{
  margin: auto;
}
</style>
