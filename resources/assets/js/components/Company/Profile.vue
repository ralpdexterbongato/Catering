<template lang="html">
  <div class="CompanyProfileContainer">
      <div id="modal1" class="modal modal-fixed-footer">
       <div class="modal-content">
         <h5>Add food menu</h5>
        <div class="food-form-container">
          <div class="input-field col s6">
            <input id="icon_prefix" v-model="FoodName" type="text" data-length="20">
            <label for="icon_prefix" >Name</label>
          </div>
          <div class="input-field col s12">
            <textarea id="textarea1" v-model="FoodDescription" class="materialize-textarea" data-length="100"></textarea>
            <label for="textarea1">Description</label>
          </div>
          <div class="input-field col s12">
            <select multiple>
              <option value="" disabled selected>Choose</option>
              <option value="1">Option 1</option>
              <option value="2">Option 2</option>
              <option value="3">Option 3</option>
            </select>
            <label>Category</label>
          </div>
          <a class="btn" @click="toggleShow" v-on:click="FoodImageActive=true">food image</a>
          <div class="row">
            <div class="input-field col s6">
              <i class="material-icons prefix">local_parking</i>
              <input id="icon_prefix" v-model="AmountSmall" type="number">
              <label for="icon_prefix">Small size price</label>
            </div>
            <div class="input-field col s6">
              <i class="material-icons prefix">drag_handle</i>
              <input id="icon_prefix" v-model="GoodForSmall" type="number">
              <label for="icon_prefix">People</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s6">
              <i class="material-icons prefix">local_parking</i>
              <input id="icon_prefix" v-model="AmountMedium" type="number">
              <label for="icon_prefix">Medium size price</label>
            </div>
            <div class="input-field col s6">
              <i class="material-icons prefix">drag_handle</i>
              <input id="icon_prefix" v-model="GoodForMedium" type="number">
              <label for="icon_prefix">People</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s6">
              <i class="material-icons prefix">local_parking</i>
              <input id="icon_prefix" v-model="AmountLarge" type="number">
              <label for="icon_prefix">Large size price</label>
            </div>
            <div class="input-field col s6">
              <i class="material-icons prefix">drag_handle</i>
              <input id="icon_prefix" v-model="GoodForLarge" type="number">
              <label for="icon_prefix">People</label>
            </div>
          </div>
        </div>
       </div>
       <div class="modal-footer">
         <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Cancel</a>
         <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat " v-on:click="AddNewFood()">Save</a>
       </div>
      </div>
    <div class="company-cover-hero" v-if="AboutCompany.heroPicture!=null" :style="'background-image:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),url(/storage/images/'+AboutCompany.heroPicture+')'">
      <div id="company-logo">
        <img v-if="AboutCompany.logo!=null" :src="'/storage/images/'+AboutCompany.logo" alt="logo">
        <div v-if="((user!=null)&&(AboutCompany.user_id==user.id))" class="edit-profile-btn" @click="toggleShow" v-on:click="smallPic=true">
          <i class="material-icons">camera_alt</i>
        </div>
      </div>
      <h2 class="company-name">{{AboutCompany.name}}</h2>
      <div v-if="((user!=null)&&(AboutCompany.user_id==user.id))" class="company-cover-edit" v-on:click="smallPic=false" @click="toggleShow">
        <i class="material-icons">camera_alt</i>
      </div>
    </div>
    <div class="company-cover-hero" v-else>
      <div id="company-logo">
        <img v-if="AboutCompany.logo!=null" :src="'/storage/images/'+AboutCompany.logo" alt="logo">
        <div v-if="((user!=null)&&(AboutCompany.user_id==user.id))" class="edit-profile-btn" @click="toggleShow" v-on:click="smallPic=true">
          <i class="material-icons">camera_alt</i>
        </div>
      </div>
      <h2 class="company-name">{{AboutCompany.name}}</h2>
      <div v-if="((user!=null)&&(AboutCompany.user_id==user.id))" class="company-cover-edit" v-on:click="smallPic=false" @click="toggleShow">
        <i class="material-icons">camera_alt</i>
      </div>
    </div>
    <div class="about-company-data">
      <table>
        <tr>
          <th></th>
          <th>Why choose us?</th>
          <th></th>
          <th>Quick links</th>
        </tr>
        <tr>
          <td></td>
          <td>
            <p>{{AboutCompany.description}}</p>
          </td>
          <td></td>
          <td><a href="#">www.facebook.com</a> | <a href="#">www.twitter.com</a> | <a href="#">www.youtube.com</a></td>
        </tr>
      </table>
    </div>
    <div>
    </div>
    <div class="menu-showcase">
      <div class="showcase-box">
        <div class="card">
           <div class="card-image waves-effect waves-block waves-light">
             <img class="activator" src="/DesignPic/1.jpg">
           </div>
           <div class="card-content">
             <span class="card-title activator grey-text text-darken-4">Food 1<i class="material-icons right">more_vert</i></span>
             <p class="bold">
               P 3,000.00
             </p>
             <div class="menu-options">
               <a href="#" class="btn"><i class="material-icons">restaurant</i> Reserve</a>
               <i class="material-icons fav-btn">favorite</i>
             </div>
           </div>
           <div class="card-reveal">
             <span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i></span>
             <p>Here is some more information about this product that is only revealed once clicked on.</p>
           </div>
         </div>
      </div>
      <div class="showcase-box">
        <div class="card">
           <div class="card-image waves-effect waves-block waves-light">
             <img class="activator" src="/DesignPic/1.jpg">
           </div>
           <div class="card-content">
             <span class="card-title activator grey-text text-darken-4">Card Title<i class="material-icons right">more_vert</i></span>
             <p class="bold">
               P 3,000.00
             </p>
             <div class="menu-options">
               <a href="#" class="btn"><i class="material-icons">restaurant</i> Reserve</a>
               <i class="material-icons fav-btn">favorite</i>
             </div>
           </div>
           <div class="card-reveal">
             <span class="card-title grey-text text-darken-4">Card Title<i class="material-icons right">close</i></span>
             <p>Here is some more information about this product that is only revealed once clicked on.</p>
           </div>
         </div>
      </div>
      <div class="showcase-box">
        <div class="card">
           <div class="card-image waves-effect waves-block waves-light">
             <img class="activator" src="/DesignPic/1.jpg">
           </div>
           <div class="card-content">
             <span class="card-title activator grey-text text-darken-4">Card Title<i class="material-icons right">more_vert</i></span>
             <p class="bold">
               P 3,000.00
             </p>
             <div class="menu-options">
               <a href="#" class="btn"><i class="material-icons">restaurant</i> Reserve</a>
               <i class="material-icons fav-btn">favorite</i>
             </div>
           </div>
           <div class="card-reveal">
             <span class="card-title grey-text text-darken-4">Card Title<i class="material-icons right">close</i></span>
             <p>Here is some more information about this product that is only revealed once clicked on.</p>
           </div>
         </div>
      </div>
      <div class="showcase-box">
        <div class="card">
           <div class="card-image waves-effect waves-block waves-light">
             <img class="activator" src="/DesignPic/1.jpg">
           </div>
           <div class="card-content">
             <span class="card-title activator grey-text text-darken-4">Card Title<i class="material-icons right">more_vert</i></span>
             <p class="bold">
               P 3,000.00
             </p>
             <div class="menu-options">
               <a href="#" class="btn"><i class="material-icons">restaurant</i> Reserve</a>
               <i class="material-icons fav-btn">favorite</i>
             </div>
           </div>
           <div class="card-reveal">
             <span class="card-title grey-text text-darken-4">Card Title<i class="material-icons right">close</i></span>
             <p>Here is some more information about this product that is only revealed once clicked on.</p>
           </div>
         </div>
      </div>
      <div class="showcase-box">
        <div class="card">
           <div class="card-image waves-effect waves-block waves-light">
             <img class="activator" src="/DesignPic/1.jpg">
           </div>
           <div class="card-content">
             <span class="card-title activator grey-text text-darken-4">Card Title<i class="material-icons right">more_vert</i></span>
             <p class="bold">
               P 3,000.00
             </p>
             <div class="menu-options">
               <a href="#" class="btn"><i class="material-icons">restaurant</i> Reserve</a>
               <i class="material-icons  fav-btn">favorite</i>
             </div>
           </div>
           <div class="card-reveal">
             <span class="card-title grey-text text-darken-4">Card Title<i class="material-icons right">close</i></span>
             <p>Here is some more information about this product that is only revealed once clicked on.</p>
           </div>
         </div>
      </div>
      <div class="showcase-box">
        <div class="card">
           <div class="card-image waves-effect waves-block waves-light">
             <img class="activator" src="/DesignPic/1.jpg">
           </div>
           <div class="card-content">
             <span class="card-title activator grey-text text-darken-4">Card Title<i class="material-icons right">more_vert</i></span>
             <p class="bold">
               P 3,000.00
             </p>
             <div class="menu-options">
               <a href="#" class="btn"><i class="material-icons">restaurant</i> Reserve</a>
               <i class="material-icons fav-btn">favorite</i>
             </div>
           </div>
           <div class="card-reveal">
             <span class="card-title grey-text text-darken-4">Card Title<i class="material-icons right">close</i></span>
             <p>Here is some more information about this product that is only revealed once clicked on.</p>
           </div>
         </div>
      </div>
    </div>
    <div class="fixed-action-btn" v-if="((user!=null)&&(user.id==AboutCompany.user_id))">
       <a href="#modal1" class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">add</i></a>
    </div>
    <div class="bottom-company-details">
      <div class="left-bottom-company">
        <div class="card">
          <div class="card-content">
            <p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>
          </div>
          <div class="card-tabs">
            <ul class="tabs tabs-fixed-width">
              <li class="tab"><a href="#test4">Email</a></li>
              <li class="tab"><a class="active" href="#test5">Telephone</a></li>
              <li class="tab"><a href="#test6">Social media</a></li>
            </ul>
          </div>
          <div class="card-content grey lighten-4">
            <div id="test4">Mycompany@gmail.com</div>
            <div id="test5"># 09105959449</div>
            <div id="test6">www.facebook.com</div>
          </div>
        </div>
      </div>
      <div class="right-bottom-company">
      </div>
    </div>
    <my-upload v-if="smallPic==true || FoodImageActive == true" field="img"
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
      <my-upload v-else field="img"
          @crop-success="cropSuccess"
          @crop-upload-success="cropUploadSuccess"
          @crop-upload-fail="cropUploadFail"
          v-model="show"
          langType="En"
          :width="400"
          :height="400"
          :params="params"
          :headers="headers"
          img-format="png">
        </my-upload>
  </div>
</template>

<script>
import axios from 'axios';
import myUpload from 'vue-image-crop-upload';
  export default {
    data () {
       return {
         smallPic:true,
         show: false,
         params: {
             token: '123456798',
             name: 'avatar'
         },
         headers: {
             smail: '*_~'
         },
         imgDataUrl: '',
         AboutCompany:[],
         FoodName:'',
         FoodDescription:'',
         AmountSmall:'',
         AmountMedium:'',
         AmountLarge:'',
         GoodForSmall:'',
         GoodForMedium:'',
         GoodForLarge:'',
         FoodImageActive:false
      }
    },
    components: {
              'my-upload': myUpload
    },
    created()
    {
      this.GetCompanyDetail();
    },
    props: ['company','user'],
    methods: {
      GetCompanyDetail()
      {
        var vm=this;
        axios.get('/company-show-data/'+this.company.id).then(function(response)
        {
          console.log(response);
          vm.AboutCompany=response.data;
        })
      },
      AddNewFood()
      {
        var vm=this;
        axios.post('/store-food',{
          FoodImage:this.imgDataUrl,
          name:this.FoodName,
          description:this.FoodDescription,
          AmountS:this.AmountSmall,
          AmountM:this.AmountMedium,
          AmountL:this.AmountLarge,
          goodforS:this.GoodForSmall,
          goodforM:this.GoodForMedium,
          goodforL:this.GoodForLarge,
          companyid:this.AboutCompany.id
        }).then(function(response)
        {
          console.log(response);
          vm.$swal({
              position: 'top-right',
              type: 'success',
              title: 'New product added',
              showConfirmButton: true,
              timer: 1500
            });
        },function(error)
        {
          console.log(error);
        });
      },
      toggleShow() {
                this.show = !this.show;
            },
            changeLogo()
            {
              var vm=this;
              axios.put('/company-profile-image/'+this.company.id,
            {
              Logo:this.imgDataUrl
            }).then(function(response)
              {
                console.log(response);
                vm.GetCompanyDetail();
                vm.$swal({
                    position: 'top-right',
                    type: 'success',
                    title: 'Your Logo has been changed',
                    showConfirmButton: false,
                    timer: 1500
                  });
                  vm.imgDataUrl='';
              });
            },
            changeCover()
            {
              var vm=this;
              axios.put('/company-cover-image/'+this.company.id,
            {
              Cover:this.imgDataUrl
            }).then(function(response)
              {
                vm.GetCompanyDetail();
                vm.$swal({
                    position: 'top-right',
                    type: 'success',
                    title: 'Your Cover has been changed',
                    showConfirmButton: false,
                    timer: 1500
                  });
                  vm.imgDataUrl='';
              });
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
                if (this.smallPic==true && this.FoodImageActive==false)
                {
                  this.changeLogo();
                }else if(this.smallPic==false && this.FoodImageActive==false)
                {
                  this.changeCover();
                }

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
</style>
