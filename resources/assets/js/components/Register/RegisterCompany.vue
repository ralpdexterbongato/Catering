<template lang="html">
  <div class="register-company-container">
    <div class="progress" v-if="loading">
      <div class="indeterminate"></div>
    </div>
    <div class="input-field col s6">
      <input id="companyname" placeholder="`" v-model="name" type="text" v-on:keyup="ValidationErrors.name=null" :class="[ValidationErrors.name!=null?'invalid':'']">
      <label for="companyname" style="width:100%" :data-error="[ValidationErrors.name!=null?ValidationErrors.name[0]:'']">Company name</label>
    </div>
    <div class="input-field col s12">
      <textarea id="companydescription" placeholder="`" v-model="description" class="materialize-textarea" :class="[ValidationErrors.description!=null?'invalid':'']" data-length="191"></textarea>
      <label style="width:100%" for="companydescription" :data-error="[ValidationErrors.description!=null?ValidationErrors.description[0]:'Max is 191']">Description</label>
    </div>
    <div class="input-field col s12">
      <input type="text" placeholder="`" v-on:keyup="ValidationErrors.lat=null" :class="[ValidationErrors.lat!=null?'invalid':'']" id="searchgmap">
      <label for="companyname" style="width:100%" :data-error="[ValidationErrors.lat!=null?'Please search the location of your company':'']">Search location</label>
    </div>
    <div id="map-canvas">
    </div>
    <span class="hide">
      <input type="text" id="lat" name="lataddress">
      <input type="text" id="lng" name="lngaddress">
    </span>
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
    <div class="preview" v-if="imgDataUrl!=''">
      <img :src="imgDataUrl">
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import myUpload from 'vue-image-crop-upload';
export default {
  data () { return {
    latCompany:'',
    lngCompany:'',
    loading:false,
    name:'',
    description:'',
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

  methods: {
    SaveCompany()
    {
      var vm=this;
      this.loading=true;

      axios.post('/company-store',{
        name:this.name,
        description:this.description,
        logo:this.imgDataUrl,
        lat:$('#lat').val(),
        lng:$('#lng').val()
      }).then(function(response)
      {
        console.log(response);
        vm.loading=false;
        window.location =response.data.redirect;
      }).catch(function(error)
      {
        console.log(error.response.data);
        vm.loading=false;
        vm.ValidationErrors = error.response.data.errors;
        Materialize.toast(error.response.data.message, 4000)
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
