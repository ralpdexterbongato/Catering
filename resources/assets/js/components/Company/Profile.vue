<template lang="html">
  <div class="CompanyProfileContainer">
    <div id="MyList" class="modal modal-fixed-footer">
       <div class="modal-content">
         <h4 class="modal-titles">Customized package</h4>
         <p v-if="user!=null"><i class="material-icons indigo-text">info</i> Please click proceed when you are done. Thank you!</p>
         <p v-else><i class="material-icons indigo-text">info</i> Please Login or Register to proceed.</p>
         <div class="added-session-table">
           <table>
             <thead>
               <tr>
                 <th>Products selected</th>
               </tr>
             </thead>
             <tbody>
               <tr v-for="(session,loopkey) in CompanySession">
                 <td><img :src="'/storage/images/'+session.foodImage"></td>
                 <td>{{session.foodName}}</td>
                 <td v-on:click="RemoveFromList(session.foodId)"><i class="material-icons grey-text">close</i></td>
               </tr>
             </tbody>
           </table>
         </div>
       </div>
       <div class="modal-footer">
         <a :href="'/request-proceed/'+company.id" v-if="user!=null" class="modal-action modal-close waves-effect waves-light btn-flat indigo-text">Proceed</a>
        <span v-else>
          <a href="#" id="login-opener-2" class="modal-action modal-close waves-effect waves-light btn-flat indigo-text">Login</a>
          <a href="/register" class="modal-action modal-close waves-effect waves-light btn-flat indigo-text">Register</a>
        </span>
       </div>
     </div>
      <div id="addproductmodal" class="modal modal-fixed-footer">
       <div class="modal-content">
         <h5>Add product menu</h5>
        <div class="food-form-container">
          <div class="input-field col s6">
            <input id="foodname" v-model="FoodName" type="text" data-length="20">
            <label for="foodname" >Name</label>
          </div>
          <div class="input-field col s12">
            <textarea id="fdescription" v-model="FoodDescription" class="materialize-textarea" data-length="100"></textarea>
            <label for="fdescription">Description</label>
          </div>
          <div class="input-field col s12">
            <select id="typeSelect">
              <option value="" disabled selected></option>
              <option value="0">Food</option>
              <option value="1">Drink</option>
              <option value="2">Sweet</option>
            </select>
            <label>Select type</label>
          </div>
          <div class="category-boxes-container">
            <p v-for="category in fetchedCategories">
              <input type="checkbox" v-model="selectedCategory" :value="category.id" :id="'categ'+category.id"/>
              <label :for="'categ'+category.id">{{category.name}}</label>
            </p>
          </div>
          <a class="btn food-image-finder" @click="toggleShowForProduct">Image</a>
          <div class="preview" v-if="imgDataUrlForFood!=''">
            <img :src="imgDataUrlForFood" alt="preview">
          </div>
        </div>
       </div>
    <div class="modal-footer">
     <a href="#!" class="modal-action modal-close waves-effect waves-indigo btn-flat ">Cancel</a>
     <a href="#!" class="modal-action modal-close waves-effect waves-indigo btn-flat " v-on:click="AddNewProduct()">Save</a>
    </div>
    </div>
    <div class="company-cover-hero" v-if="AboutCompany.heroPicture!=null" :style="'background-image:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),url(/storage/images/'+AboutCompany.heroPicture+')'">
      <div id="company-logo">
        <img v-if="AboutCompany.logo!=null" :src="'/storage/images/'+AboutCompany.logo" alt="logo">
        <div v-if="((user!=null)&&(AboutCompany.user_id==user.id))" class="edit-profile-btn" @click="toggleShowForLogo">
          <i class="material-icons">camera_alt</i>
          <p>change logo</p>
        </div>
      </div>
      <h2 class="company-name">{{AboutCompany.name}}</h2>
      <div v-if="((user!=null)&&(AboutCompany.user_id==user.id))" class="company-cover-edit" @click="toggleShowForCover">
        <i class="material-icons">camera_alt</i>
        <p>Change cover</p>
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
        <p>Change cover</p>
      </div>
    </div>
    <div class="about-company-data">
      <div class="left-about-company">
        <h6 class="bold">Why choose us?</h6>
        <p>{{AboutCompany.description}}</p>
      </div>
      <div class="right-about-company">
        <h5 class="location-title"><i class="material-icons">location_on</i> Our location</h5>
        <div class="map-container">
          <div id="company-profile-map">
          </div>
        </div>
      </div>
    </div>
    <div class="divider">
    </div>
    <span v-if="Packages[0]!=null">
    <h5 class="titles"><i class="material-icons">local_offer</i> Our packages</h5>
    <div class="packages-list">
      <div class="card" v-for="Profilepackage in Packages">
        <div class="card-image">
          <img src="/DesignPic/1.jpg">
          <a :href="'/package-show/'+Profilepackage.id" class="btn-floating halfway-fab waves-effect waves-light redirect indigo"><i class="material-icons">remove_red_eye</i></a>
        </div>
        <div class="card-content">
          <span class="card-title">P{{Profilepackage.price}} per head</span>
          <p><span class="bold">{{Profilepackage.name}}</span><br><br> {{Profilepackage.description}}</p>
        </div>
      </div>
    </div>
    <ul class="pagination">
        <li class="waves-effect" v-if="paginationPackage.current_page > 1"><a href="#" @click.prevent="changepagePackage(paginationPackage.current_page - 1)"><i class="material-icons">chevron_left</i></a></li>
        <li v-for="page in pagesNumberPackage" v-bind:class="[ page == isActivePackage ? 'active indigo':'']"><a href="#!" @click.prevent="changepagePackage(page)">{{page}}</a></li>
        <li class="waves-effect" v-if="paginationPackage.current_page < paginationPackage.last_page"><a href="#!" @click.prevent="changepagePackage(paginationPackage.current_page + 1)"><i class="material-icons">chevron_right</i></a></li>
    </ul>
    </span>
    <!-- <h5 class="custom-package-title"><i class="material-icons">touch_app</i>Pick and send</h5> -->
    <h5 class="custom-package-foodmenu"><i class="material-icons">local_dining</i> Product menu</h5>
    <div class="sorting-container">
      <form action="#" class="radio-sort-container">
         <p>
           <input class="with-gap"  v-model="SortType" name="SortType" value="0" type="radio" id="sort1"  />
           <label for="sort1">Foods</label>
         </p>
         <p>
           <input class="with-gap" v-model="SortType" name="SortType" value="1" type="radio" id="sort2"  />
           <label for="sort2">Drinks</label>
         </p>
         <p>
           <input class="with-gap" v-model="SortType" name="SortType" value="2" type="radio" id="sort3"  />
           <label for="sort3">Sweets</label>
         </p>
      </form>
      <div class="search-container">
        <input type="text" placeholder="Product" v-on:keypress.enter="getCompanyProducts()" v-model="productSearch">
        <a href="#" class="btn btn-floating" v-on:click.prevent="getCompanyProducts()">GO</a>
      </div>
      </div>
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
    <ul class="pagination">
        <li class="waves-effect" v-if="paginationFood.current_page > 1"><a href="#" @click.prevent="changepage(paginationFood.current_page - 1)"><i class="material-icons">chevron_left</i></a></li>
        <li v-for="page in pagesNumberFood" v-bind:class="[ page == isActiveFood ? 'active indigo':'']"><a href="#!" @click.prevent="changepage(page)">{{page}}</a></li>
        <li class="waves-effect" v-if="paginationFood.current_page < paginationFood.last_page"><a href="#!" @click.prevent="changepage(paginationFood.current_page + 1)"><i class="material-icons">chevron_right</i></a></li>
    </ul>
    <div class="fixed-action-btn click-to-toggle" v-if="((user!=null)&&(user.id==AboutCompany.user_id))">
       <a class="btn-floating btn-large indigo">
         <i class="material-icons">add</i>
       </a>
       <ul>
         <li onclick="$('#addproductmodal').modal('open');" v-on:click="[user.id==AboutCompany.user_id && fetchedCategories[0]==null?fetchCategories():'']"><a class="btn-floating indigo darken-1"><i class="material-icons">restaurant</i></a></li>
       </ul>
    </div>
    <div class="fixed-action-btn" v-else>
      <a  onclick="$('#MyList').modal('open');" class="btn-floating btn-large waves-effect waves-light indigo" :class="[CompanySession!=null?'pulse':'']"><i class="material-icons">format_list_numbered</i></a>
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
        v-model="showForProduct"
        langType="En"
        :width="300"
        :height="300"
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
         showForLogo: false,
         showForCover: false,
         showForProduct: false,
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
         fetchedCategories:[],
         selectedCategory:[],
         paginationFood:[],
         offsetFood:4,
         offsetPackage:4,
         SortType:0,
         productSearch:'',
         Packages:[],
         paginationPackage:[]
      }
    },
    components: {
              'my-upload': myUpload
    },
    created()
    {
      this.GetCompanyDetail();
      this.getCompanyProducts(1);
      this.showAddedSession();
      this.showpackages(1);
    },
    props: ['company','user'],
    methods: {
      changepage(next){
        this.paginationFood.current_page = next;
        this.getCompanyProducts(next);
      },
      changepagePackage(next){
        this.paginationFood.current_page = next;
        this.showpackages(next);
      },
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
                title: 'This food is already added',
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
      AddNewProduct()
      {
        var vm=this;
        axios.post('/store-product',{
          FoodImage:this.imgDataUrlForFood,
          name:this.FoodName,
          description:this.FoodDescription,
          companyid:this.AboutCompany.id,
          categories:this.selectedCategory,
          type:$('#typeSelect').val()
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
          vm.getCompanyProducts(1);
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
      RemoveFromList(foodid)
      {
        var vm=this;
        axios.delete(`/mylist-session-delete/`+this.company.id+`/`+foodid).then(function(response)
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
      toggleShowForProduct() {
                this.showForProduct = !this.show;
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
            getCompanyProducts(page)
            {
              var vm=this;
              swal({
                  text: "Please wait.",
                  showConfirmButton: false
              });
              axios.get(`/show-company-products/`+this.company.id+`?page=`+page+`&type=`+this.SortType+`&search=`+this.productSearch).then(function(response)
              {
                console.log(response);
                vm.CompanyProduct=response.data.data;
                vm.paginationFood=response.data;
                swal.close();
              });
            },
            showpackages(page)
            {
              var vm=this;
              axios.get(`/package-all/`+this.company.id+`?page=`+page).then(function(response)
              {
                console.log(response);
                vm.Packages = response.data.data;
                vm.paginationPackage=response.data;
              }).catch(function(error)
              {
                console.log(error);
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
    computed:{
      isActiveFood:function(){
        return this.paginationFood.current_page;
      },
      pagesNumberFood:function(){
        if (!this.paginationFood.to) {
           return [];
        }
        var from = this.paginationFood.current_page - this.offsetFood;
        if (from < 1) {
            from = 1;
        }
        var to = from + (this.offsetFood * 2);
        if (to >= this.paginationFood.last_page) {
            to = this.paginationFood.last_page;
        }
        var pagesArray = [];
        while (from <= to) {
            pagesArray.push(from);
            from++;
        }
        return pagesArray;
      },
      isActivePackage:function(){
        return this.paginationPackage.current_page;
      },
      pagesNumberPackage:function(){
        if (!this.paginationPackage.to) {
           return [];
        }
        var from = this.paginationPackage.current_page - this.offsetPackage;
        if (from < 1) {
            from = 1;
        }
        var to = from + (this.offsetPackage * 2);
        if (to >= this.paginationPackage.last_page) {
            to = this.paginationPackage.last_page;
        }
        var pagesArray = [];
        while (from <= to) {
            pagesArray.push(from);
            from++;
        }
        return pagesArray;
      }
    },

  }
</script>
