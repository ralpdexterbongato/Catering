<template lang="html">
  <div class="CompanyProfileContainer">
    <div id="MyList" class="modal modal-fixed-footer">
       <div class="modal-content">
         <h4 class="modal-titles">Customized package foods</h4>
         <p v-if="user!=null"><i class="material-icons blue-text">info</i> Please click proceed when you are done. Thank you!</p>
         <p v-else><i class="material-icons blue-text">info</i> Please Login or Register to proceed.</p>
         <div class="added-session-table">
           <table>
             <tr v-for="(session,loopkey) in CompanySession">
               <td><img :src="'/storage/images/'+session.foodImage"></td>
               <td>{{session.foodName}}</td>
               <td v-on:click="RemoveFromList(session.foodId,session.Size)"><i class="material-icons grey-text">close</i></td>
             </tr>
           </table>
         </div>
       </div>
       <div class="modal-footer">
         <a :href="'/request-proceed/'+company.id" v-if="user!=null" class="modal-action modal-close waves-effect waves-light btn-flat blue-text">Proceed</a>
        <span v-else>
          <a href="#" id="login-opener-2" class="modal-action modal-close waves-effect waves-light btn-flat blue-text">Login</a>
          <a href="/register" class="modal-action modal-close waves-effect waves-light btn-flat blue-text">Register</a>
        </span>
       </div>
     </div>
      <div id="addproductmodal" class="modal modal-fixed-footer">
       <div class="modal-content">
         <h5>Add food menu</h5>
        <div class="food-form-container">
          <div class="input-field col s6">
            <input id="foodname" v-model="FoodName" type="text" data-length="20">
            <label for="foodname" >Name</label>
          </div>
          <div class="input-field col s12">
            <textarea id="fdescription" v-model="FoodDescription" class="materialize-textarea" data-length="100"></textarea>
            <label for="fdescription">Description</label>
          </div>
          <div class="category-boxes-container">
            <p v-for="category in fetchedCategories">
              <input type="checkbox" v-model="selectedCategory" :value="category.id" :id="'categ'+category.id"/>
              <label :for="'categ'+category.id">{{category.name}}</label>
            </p>
          </div>
          <a class="btn food-image-finder" @click="toggleShowForFood">food image</a>
          <div class="preview" v-if="imgDataUrlForFood!=''">
            <img :src="imgDataUrlForFood" alt="preview">
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
        <div v-if="((user!=null)&&(AboutCompany.user_id==user.id))" class="edit-profile-btn" @click="toggleShowForLogo">
          <i class="material-icons">camera_alt</i>
        </div>
      </div>
      <h2 class="company-name">{{AboutCompany.name}}</h2>
      <div v-if="((user!=null)&&(AboutCompany.user_id==user.id))" class="company-cover-edit" @click="toggleShowForCover">
        <i class="material-icons">camera_alt</i>
      </div>
    </div>
    <div class="company-cover-hero" v-else>
      <div id="company-logo">
        <img v-if="AboutCompany.logo!=null" :src="'/storage/images/'+AboutCompany.logo" alt="logo">
        <div v-if="((user!=null)&&(AboutCompany.user_id==user.id))" class="edit-profile-btn" @click="toggleShowForLogo">
          <i class="material-icons">camera_alt</i>
        </div>
      </div>
      <h2 class="company-name">{{AboutCompany.name}}</h2>
      <div v-if="((user!=null)&&(AboutCompany.user_id==user.id))" class="company-cover-edit" @click="toggleShowForCover">
        <i class="material-icons">camera_alt</i>
      </div>
    </div>
    <div class="about-company-data">
      <div class="left-about-company">
        <h6 class="bold">Why choose us?</h6>
        <p>{{AboutCompany.description}}</p>
      </div>
      <div class="right-about-company">

      </div>
    </div>
    <h5 class="titles"><i class="material-icons">local_offer</i> Our packages</h5>
    <div class="packages-list">
      <div class="card">
        <div class="card-image">
          <img src="/DesignPic/1.jpg">
          <a :href="'/request-proceed/'+company.id" class="btn-floating halfway-fab waves-effect waves-light redirect red"><i class="material-icons">add</i></a>
        </div>
        <div class="card-content">
          <span class="card-title">P120 per head</span>
          <p><span class="bold">Terms & Conditions:</span><br><br> 3 delicious menu with 3 types of drinks, can be held in your house or at our own restaurant minimum of 100 people only</p>
        </div>
      </div>
      <div class="card">
        <div class="card-image">
          <img src="/DesignPic/1.jpg">
          <a :href="'/request-proceed/'+company.id" class="btn-floating halfway-fab waves-effect waves-light redirect red"><i class="material-icons">add</i></a>
        </div>
        <div class="card-content">
          <span class="card-title">P120 per head</span>
          <p><span class="bold">Terms & Conditions:</span><br><br> 3 delicious menu with 3 types of drinks, can be held in your house or at our own restaurant minimum of 100 people only</p>
        </div>
      </div>
      <div class="card">
        <div class="card-image">
          <img src="/DesignPic/1.jpg">
          <a :href="'/request-proceed/'+company.id" class="btn-floating halfway-fab waves-effect waves-light redirect red"><i class="material-icons">add</i></a>
        </div>
        <div class="card-content">
          <span class="card-title">P120 per head</span>
          <p><span class="bold">Terms & Conditions:</span><br><br> 3 delicious menu with 3 types of drinks, can be held in your house or at our own restaurant minimum of 100 people only</p>
        </div>
      </div>
    </div>
    <h5 class="titles"><i class="material-icons">touch_app</i> Custom package</h5>
    <div class="menu-showcase">
      <div class="showcase-box" v-for="(product,productKey) in CompanyProduct">
        <div class="card">
           <div class="card-image waves-effect waves-block waves-light">
             <img class="activator" :src="'/storage/images/'+product.image">
           </div>
           <div class="card-content">
             <span class="card-title activator grey-text text-darken-4">{{product.name}}<i class="material-icons right">more_vert</i></span>
             <div class="menu-options">
               <div class="menu-option-btn">
                 <i class="material-icons add-btn" v-if="(((user!=null) && (AboutCompany.user_id!=user.id))||(user==null))" v-on:click="addToSessionList(product)">add</i>
                 <i class="material-icons view-btn">remove_red_eye</i>
               </div>
             </div>
           </div>
           <div class="card-reveal">
             <span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i></span>
             <p>{{product.description}}</p>
           </div>
         </div>
      </div>
    </div>
    <div class="fixed-action-btn" v-if="((user!=null)&&(user.id==AboutCompany.user_id))">
       <a class="btn-floating btn-large waves-effect waves-light red" v-on:click="[user.id==AboutCompany.user_id?fetchCategories():'']"><i class="material-icons" onclick="$('#addproductmodal').modal('open');">add</i></a>
    </div>
    <div class="fixed-action-btn" v-else>
      <a  onclick="$('#MyList').modal('open');" class="btn-floating btn-large waves-effect waves-light red" :class="[CompanySession!=null?'pulse':'']"><i class="material-icons">format_list_numbered</i></a>
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
              <li class="tab"><a href="#test6">Social media</a></li>
            </ul>
          </div>
          <div class="card-content grey lighten-4">
            <div id="test4">Mycompany@gmail.com</div>
            <div id="test6">www.facebook.com</div>
          </div>
        </div>
      </div>
      <div class="right-bottom-company">
      </div>
    </div>
    <!-- profile -->
    <my-upload field="img"
        @crop-success="cropSuccessForLogo"
        @crop-upload-success="cropUploadSuccessForLogo"
        @crop-upload-fail="cropUploadFailForLogo"
        v-model="showForLogo"
        langType="En"
        :width="300"
        :height="300"
        :params="params"
        :headers="headers"
        img-format="png">
      </my-upload>
      <!-- cover -->
      <my-upload field="img"
          @crop-success="cropSuccessForCover"
          @crop-upload-success="cropUploadSuccessForCover"
          @crop-upload-fail="cropUploadFailForCover"
          v-model="showForCover"
          langType="En"
          :width="700"
          :height="300"
          :params="params"
          :headers="headers"
          :noCircle="true"
          img-format="png">
        </my-upload>
        <!-- newfood -->
        <my-upload field="img"
            @crop-success="cropSuccessForFood"
            @crop-upload-success="cropUploadSuccessForFood"
            @crop-upload-fail="cropUploadFailForFood"
            v-model="showForFood"
            langType="En"
            :width="300"
            :height="300"
            :params="params"
            :headers="headers"
            img-format="png">
          </my-upload>
        <h5 class="titles"><i class="material-icons">location_on</i> Our location</h5>
        <div class="map-container">
          <div id="company-profile-map">
          </div>
        </div>
  </div>
</template>

<script>
import axios from 'axios';
import myUpload from 'vue-image-crop-upload';
  export default {
    data () {
       return {
         showForLogo: false,
         showForCover: false,
         showForFood: false,
         params: {
             token: '123456798',
             name: 'avatar'
         },
         headers: {
             smail: '*_~'
         },
         imgDataUrlForLogo: '',
         imgDataUrlForCover: '',
         imgDataUrlForFood: '',
         AboutCompany:[],
         FoodName:'',
         FoodDescription:'',
         CompanyProduct:[],
         SelectedSize:[],
         CompanySession:[],
         ListTotal:'0',
         fetchedCategories:[],
         selectedCategory:[]
      }
    },
    components: {
              'my-upload': myUpload
    },
    created()
    {
      this.GetCompanyDetail();
      this.getCompanyProducts();
      this.showAddedSession();
    },
    props: ['company','user'],
    methods: {
      addToSessionList(FoodData)
      {
        var vm=this;
        axios.post('/mylist-session/'+this.company.id,{
          FoodId:FoodData.id,
          FoodName:FoodData.name,
          FoodImage:FoodData.image,
        }).then(function(response)
        {
          console.log(response);
          if (response.data.error!=null) {
            swal({
                position: 'top-right',
                type: 'error',
                title: 'This item is already added',
                showConfirmButton:true
              });
          }else
          {
            vm.showAddedSession();
            swal({
                position: 'top-right',
                type: 'success',
                title: '1 item added to your list',
                showConfirmButton:true
              });
          }
        },function(error)
        {
          console.log(error);
        });
      },
      showAddedSession()
      {
        var vm=this;
        axios.get('/mylist-session-show/'+this.company.id).then(function(response)
        {
          console.log(response);
          vm.CompanySession=response.data.foodsaved;
          vm.ListTotal = response.data.total;
        })
      },
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
          FoodImage:this.imgDataUrlForFood,
          name:this.FoodName,
          description:this.FoodDescription,
          companyid:this.AboutCompany.id,
          categories:this.selectedCategory
        }).then(function(response)
        {
          console.log(response);
          if (response.data.error!=null)
          {
            swal({
                position: 'top-right',
                type: 'error',
                title: response.data.error,
                showConfirmButton:true
              });
          }else
          {
            vm.imgDataUrlForFood = '';
            vm.FoodName = '';
            vm.FoodDescription = '';
            vm.selectedCategory =[];
            swal({
                position: 'top-right',
                type: 'success',
                title: 'New product added',
                showConfirmButton:true
              });
          }
          vm.getCompanyProducts();
        },function(error)
        {
          console.log(error);
          swal({
              position: 'top-right',
              type: 'error',
              title: error.response.data.message,
              showConfirmButton:true
            });
        });
      },
      RemoveFromList(foodid,size)
      {
        var vm=this;
        axios.delete(`/mylist-session-delete/`+this.company.id+`/`+foodid+`/`+size).then(function(response)
        {
          console.log(response);
          vm.showAddedSession();
          swal({
              position: 'top-right',
              type: 'success',
              title: '1 item removed from your list',
              showConfirmButton:true
            });
        });
      },
      toggleShowForLogo() {
                this.showForLogo = !this.show;
            },
      toggleShowForCover() {
                this.showForCover = !this.show;
            },
      toggleShowForFood() {
                this.showForFood = !this.show;
            },
            changeLogo()
            {
              var vm=this;
              axios.put('/company-profile-image/'+this.company.id,
            {
              Logo:this.imgDataUrlForLogo
            }).then(function(response)
              {
                console.log(response);
                vm.GetCompanyDetail();
                vm.$swal({
                    position: 'top-right',
                    type: 'success',
                    title: 'Your Logo has been changed',
                    showConfirmButton: true
                  });
                vm.imgDataUrlForLogo='';
              });
            },
            changeCover()
            {
              var vm=this;
              axios.put('/company-cover-image/'+this.company.id,
            {
              Cover:this.imgDataUrlForCover
            }).then(function(response)
              {
                vm.GetCompanyDetail();
                vm.$swal({
                    position: 'top-right',
                    type: 'success',
                    title: 'Your Cover has been changed',
                    showConfirmButton: true

                  });
                  vm.imgDataUrlForCover='';
              });
            },
            fetchCategories()
            {
              var vm=this;
              axios.get(`/fetch-categories`).then(function(response)
              {
                console.log(response);
                vm.fetchedCategories=response.data;
              });
            },
            getCompanyProducts()
            {
              var vm=this;
              axios.get(`/show-company-products/`+this.company.id).then(function(response)
              {
                console.log(response);
                vm.CompanyProduct=response.data.data;
              });
            },
            /**
             * crop success
             *
             * [param] imgDataUrl
             * [param] field
             */
            cropSuccessForLogo(imgDataUrl, field){
                console.log('-------- crop success --------');
                this.imgDataUrlForLogo = imgDataUrl;
                this.changeLogo();
            },
            /**
             * upload success
             *
             * [param] jsonData  server api return data, already json encode
             * [param] field
             */
            cropUploadSuccessForLogo(jsonData, field){
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
            cropUploadFailForLogo(status, field){
                console.log('-------- upload fail --------');
                console.log(status);
                console.log('field: ' + field);
            },

            // cover

            /**
             * crop success
             *
             * [param] imgDataUrl
             * [param] field
             */
            cropSuccessForCover(imgDataUrl, field){
                console.log('-------- crop success --------');
                this.imgDataUrlForCover = imgDataUrl;
                this.changeCover();
            },
            /**
             * upload success
             *
             * [param] jsonData  server api return data, already json encode
             * [param] field
             */
            cropUploadSuccessForCover(jsonData, field){
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
            cropUploadFailForCover(status, field){
                console.log('-------- upload fail --------');
                console.log(status);
                console.log('field: ' + field);
            },

            //food

            /**
             * crop success
             *
             * [param] imgDataUrl
             * [param] field
             */
            cropSuccessForFood(imgDataUrl, field){
                console.log('-------- crop success --------');
                this.imgDataUrlForFood = imgDataUrl;
            },
            /**
             * upload success
             *
             * [param] jsonData  server api return data, already json encode
             * [param] field
             */
            cropUploadSuccessForFood(jsonData, field){
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
            cropUploadFailForFood(status, field){
                console.log('-------- upload fail --------');
                console.log(status);
                console.log('field: ' + field);
            },

    },
  }
</script>

<style lang="css">
</style>
