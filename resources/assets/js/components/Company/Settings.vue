<template lang="html">
  <div class="company-settings-container">
    <div class="company-settings-table-container">
      <table>
        <thead>
          <th>Company settings</th>
        </thead>
        <tbody>
          <tr>
            <th>Name</th>
            <td>
              <div class="input-field col s6">
                <input id="company_name" type="text" v-model="NewName =currentName.name">
              </div>
            </td>
            <td>
              <a href="#" v-on:click.prevent="updateName()" class="btn btn-floating white"><i class="material-icons red-text darken-1">loop</i></a>
            </td>
          </tr>
          <tr>
            <th>Description</th>
            <td>
              <textarea id="textarea1" v-model="NewDescription=currentDescription.description" class="materialize-textarea"></textarea>
            </td>
            <td>
              <a href="#" class="btn btn-floating white" v-on:click.prevent="updateDescription()"><i class="material-icons red-text darken-1">loop</i></a>
            </td>
          </tr>
          <tr>
            <th>Minimum visitors</th>
            <td><input type="number" min="1" v-model="NewMinimum =currentMinimum.minimum"></td>
            <td>
              <a href="#" class="btn btn-floating white" v-on:click.prevent="updateMinimum()"><i class="material-icons red-text darken-1">loop</i></a>
            </td>
          </tr>
          <tr>
            <th>Maximum visitors</th>
            <td><input type="number" min="1" v-model="currentMaximum"></td>
            <td>
              <a href="#" class="btn btn-floating white" v-on:click.prevent="updateMaximum()"><i class="material-icons red-text darken-1">loop</i></a>
            </td>
          </tr>
          <tr>
            <th>Individual prices</th>
            <td>
              <form>
                 <p>
                   <input name="pricePrivacy" v-model="pricePrivacy " value="0" type="radio" id="public" />
                   <label for="public">Show</label>
                 </p>
                 <p>
                   <input name="pricePrivacy" v-model="pricePrivacy " value="1" type="radio" id="private" />
                   <label for="private">Hide</label>
                 </p>
              </form>
            </td>
            <td>
              <a href="#" class="btn btn-floating white" v-on:click.prevent="updatePricePrivacy()"><i class="material-icons red-text darken-1">loop</i></a>
            </td>
          </tr>
          <tr>
            <th>Logo</th>
            <td>
              <img class="z-depth-3 logo-prev" v-if="currentLogo != ''" :src="'/storage/images/'+currentLogo.logo" alt="">
              <a class="btn food-image-finder btn-floating" @click="toggleShow"><i class="material-icons">search</i></a>
            </td>
            <td>
              <a href="#" class="btn btn-floating white" v-on:click.prevent="updateLogo()"><i class="material-icons red-text darken-1">loop</i></a>
            </td>
          </tr>
          <tr>
            <th>Cover photo</th>
            <td>
              <img class="z-depth-3 cover-prev" v-if="currentCover!=''" :src="'/storage/images/'+currentCover.heroPicture" alt="">
              <a class="btn food-image-finder btn-floating" @click="CovertoggleShow"><i class="material-icons">search</i></a>
            </td>
            <td>
              <a href="#" class="btn btn-floating white" v-on:click.prevent="updateCover()"><i class="material-icons red-text darken-1">loop</i></a>
            </td>
          </tr>
        </tbody>
      </table>
      <div class="available-colors-container">
        <h6>Available color theme</h6>
        <div class="color-form">
          <input type="color" v-model="selectedColor">
          <i class="material-icons" v-on:click="addColor()">add</i>
        </div>
        <div class="divider">
        </div>
        <div class="color-added-chips">
          <p class="chip" :style="'background-color:'+color.hex" v-if="currentColors!=null" v-for="color in currentColors"> {{color.hex}} <i class="material-icons" v-on:click="DeleteColor(color.id)">close</i></p>
        </div>
      </div>
      <div id="map-update">
      </div>
      <div class="map-update-class-container">
        <input type="text" id="geomap-update">
        <a href="#" class="btn btn-floating white" v-on:click.prevent="updateMap()"><i class="material-icons red-text darken-1">loop</i></a>
        <span class="hide">
          <input type="text" id="LatUpdate">
          <input type="text" id="LngUpdate">
        </span>
      </div>
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
        img-format="png">
      </my-upload>
      <my-upload field="img"
          @crop-success="CovercropSuccess"
          @crop-upload-success="CovercropUploadSuccess"
          @crop-upload-fail="CovercropUploadFail"
          v-model="showCover"
          langType="En"
          :width="700"
          :height="300"
          :params="params"
          :headers="headers"
          img-format="jpg">
        </my-upload>
  </div>
</template>

<script>
import axios from 'axios';
import myUpload from 'vue-image-crop-upload';
  export default {
    data () { return {
      show:false,
      showCover:false,
      currentLogo:'',
      currentCover:'',
      selectedColor:'#F44336',
      currentMinimum:'',
      currentMaximum:'',
      currentColors:[],
      currentName:'',
      currentDescription:'',
      NewName:'',
      NewDescription:'',
      NewMinimum:'',
      pricePrivacy:'',

      params: {
          token: '123456798',
          name: 'avatar'
      },
      headers: {
          smail: '*_~'
      },
      imgDataUrl: '',
      imgDataUrlCover: '',
      }
    },
    components: {
              'my-upload': myUpload
    },
    created()
    {
      this.fetchName();
      this.fetchDescription();
      this.fetchMinimumVisitor();
      this.fetchMaximum();
      this.fetchLogo();
      this.fetchCover();
      this.fetchColors();
      this.fetchPricePrivacy();
    },
    methods: {
      fetchMaximum()
      {
        var vm=this;
        axios.get(`/comp-settings-show-maximum`).then(function(response)
        {
          console.log(response);
          vm.currentMaximum = response.data[0].maximum;
        }).catch(function(error)
        {
          console.log(error);
        });
      },
      updateMaximum()
      {
        var vm = this;
        axios.put(`/comp-settings-maximum-update`,{
          newMax:this.currentMaximum,
          minimum:this.currentMinimum.minimum,
        }).then(function(response)
        {
          Materialize.toast('Successfully updated', 4000)
            vm.fetchMaximum();
          console.log(response);
        }).catch(function(error)
        {
          console.log(error);
           Materialize.toast(error.response.data.message, 4000)
            vm.fetchMaximum();
        })
      },
      fetchPricePrivacy()
      {
        var vm=this;
        axios.get(`/comp-settings-show-price-privacy`).then(function(response)
      {
        console.log(response);
        vm.pricePrivacy = response.data[0].show_prices;
      }).catch(function(error)
      {
        console.log(error);
      });
      },
      updatePricePrivacy()
      {
        var vm=this;
        axios.put(`/comp-settings-price-privacy-update`,{
          newPricePrivacy: this.pricePrivacy
        }).then(function(response)
        {
          console.log(response);
          vm.fetchPricePrivacy();
          Materialize.toast('Successfully updated', 4000)
        }).catch(function(error)
        {
          console.log(error);
          Materialize.toast(error.response.data.message, 4000)
            vm.fetchPricePrivacy();
        });
      },
      fetchLogo()
      {
        var vm=this;
        axios.get(`/comp-settings-profile`).then(function(response)
        {
          vm.currentLogo=response.data[0];
          console.log(response);
        }).catch(function(error)
        {
          console.log(error);
        });
      },
      fetchCover()
      {
        var vm=this;
        axios.get(`/comp-settings-cover`).then(function(response)
        {
          vm.currentCover=response.data[0];
          console.log(response);
        }).catch(function(error)
        {
          console.log(error);
        });
      },
      fetchMinimumVisitor()
      {
        var vm=this;
        axios.get(`/comp-settings-minimum`).then(function(response)
        {
          console.log(response);
          vm.currentMinimum= response.data[0];
        });
      },
      fetchColors()
      {
        var vm=this;
        axios.get(`/comp-settings-colors`).then(function(response)
        {
          console.log(response);
          vm.currentColors= response.data;
        })
      },
      fetchName()
      {
        var vm=this;
        axios.get(`/comp-settings-name`).then(function(response)
        {
          console.log(response);
          vm.currentName = response.data[0];
        });
      },
      fetchDescription()
      {
        var vm=this;
        axios.get(`/comp-settings-description`).then(function(response)
        {
          console.log(response);
          vm.currentDescription = response.data[0];
        })
      },
      updateName()
      {
        var vm=this;
        axios.put(`/comp-settings-name-update`,{
          name:this.NewName
        }).then(function(response)
        {
          console.log(response);
          vm.fetchName();
          vm.NewName= '';
          Materialize.toast('Successfully updated', 4000)
        }).catch(function(error)
        {
          console.log(error);
          Materialize.toast(error.response.data.message, 4000)
          vm.fetchName();
        })
      },
      updateDescription()
      {
        var vm=this;
        axios.put(`/comp-settings-description-update`,{
          description:this.NewDescription
        }).then(function(response)
        {
          console.log(response);
          vm.fetchDescription();
          vm.NewDescription= '';
          Materialize.toast('Successfully updated', 4000)
        }).catch(function(error)
        {
          console.log(error);
          Materialize.toast(error.response.data.message, 4000)
          vm.fetchDescription();
        });
      },
      updateMinimum()
      {
        var vm=this;
        axios.put(`/comp-settings-minimum-update`,{
          minimum:this.NewMinimum
        }).then(function(response)
        {
          console.log(response);
          vm.fetchMinimumVisitor();
          vm.NewMinimum= '';
          Materialize.toast('Successfully updated', 4000)
        }).catch(function(error)
        {
          console.log(error);
          Materialize.toast(error.response.data.message, 4000)
            vm.fetchMinimumVisitor();
        });
      },
      updateLogo()
      {
        var vm=this;
        axios.put(`/comp-settings-logo-update`,{
          Logo:this.imgDataUrl
        }).then(function(response)
        {
          console.log(response);
          vm.fetchLogo();
          vm.imgDataUrl= '';
          Materialize.toast('Successfully updated', 4000)
        }).catch(function(error)
        {
          console.log(error);
          Materialize.toast(error.response.data.message, 4000)
        });
      },
      updateCover()
      {
        var vm=this;
        axios.put(`/comp-settings-cover-update`,{
        Cover:this.imgDataUrlCover
        }).then(function(response)
        {
          console.log(response);
          vm.fetchCover();
          vm.imgDataUrlCover= '';
          Materialize.toast('Successfully updated', 4000)
        }).catch(function(error)
        {
          console.log(error);
          Materialize.toast(error.response.data.message, 4000)
        });
      },
      addColor()
      {
        var vm=this;
        axios.post(`/comp-settings-color`,{
        color:this.selectedColor
        }).then(function(response)
        {
          console.log(response);
          vm.fetchColors();
          Materialize.toast('Added successfully', 4000)
        }).catch(function(error)
        {
          console.log(error);
          Materialize.toast(error.response.data.message, 4000)
        });
      },
      DeleteColor(id)
      {
        var vm=this;
        axios.delete(`/comp-settings-color-remove/`+id).then(function(response)
        {
          console.log(response);
          Materialize.toast('removed successfully', 4000)
            vm.fetchColors();
        }).catch(function(error)
        {
          console.log(error);
          Materialize.toast(error.response.data.message, 4000)
        })
      },
      updateMap()
      {
        var vm=this;
        axios.put(`/comp-settings-map-update`,{
          lat:$('#LatUpdate').val(),
          lng:$('#LngUpdate').val()
        }).then(function(response)
        {
          console.log(response);
          Materialize.toast('Location updated', 4000)
        }).catch(function(error)
        {
          console.log(error);
          Materialize.toast(error.response.data.message, 4000)
        });
      },
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
      },
      toggleShow() {
                this.show = !this.show;
      },

      //COVER
      CovercropSuccess(imgDataUrl, field){
          console.log('-------- crop success --------');
          this.imgDataUrlCover = imgDataUrl;

      },
      /**
       * upload success
       *
       * [param] jsonData  server api return data, already json encode
       * [param] field
       */
      CovercropUploadSuccess(jsonData, field){
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
      CovercropUploadFail(status, field){
          console.log('-------- upload fail --------');
          console.log(status);
          console.log('field: ' + field);
      },
      CovertoggleShow() {
                this.showCover = !this.showCover;
      },
    },
  }
</script>
