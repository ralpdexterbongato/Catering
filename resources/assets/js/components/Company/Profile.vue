<template lang="html">
  <div class="CompanyProfileContainer">
    <div id="MyList" class="modal modal-fixed-footer" v-if="(((user==null))||((user!=null) &&(user.role==0)))">
       <div class="modal-content">
         <h4 class="modal-titles">Customized package</h4>
         <p v-if="user!=null"><i class="material-icons red-text">info</i> Please click proceed when you are done. Thank you!</p>
         <p v-else><i class="material-icons red-text">info</i> Please Login or Register to proceed.</p>
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
                 <td v-if="AboutCompany.show_prices==0">₱{{session.foodPrice}}</td>
                 <td v-else><i class="material-icons">visibility_off</i></td>
                 <td v-on:click="RemoveFromList(session.foodId)"><i class="material-icons grey-text">close</i></td>
               </tr>
             </tbody>
           </table>
         </div>
       </div>
       <div class="modal-footer">

        <a href="#" v-on:click.prevent class="grey-text text-darken-2" v-if="foodsavedTotalPrice!=null">Total: ₱{{foodsavedTotalPrice.toLocaleString()}} perhead</a>
        <a :href="'/request-proceed/'+company.id" v-if="(foodsavedTotalPrice!=null)&&(user!=null)" class="modal-action modal-close waves-effect waves-light btn-flat red-text">Proceed</a>
        <span v-else-if="user==null">
          <a href="#" id="login-opener-2" class="modal-action modal-close waves-effect waves-light btn-flat red-text">Login</a>
          <a href="/register" class="modal-action modal-close waves-effect waves-light btn-flat red-text">Register</a>
        </span>
       </div>
     </div>
     <!-- product modal -->
      <div id="addproductmodal" class="modal modal-fixed-footer">
       <div class="modal-content">
         <h5>Add product menu</h5>
        <div class="food-form-container">
          <div class="input-field col s6">
            <input id="foodname" v-model="FoodName" type="text" data-length="20">
            <label for="foodname" >Name</label>
          </div>
          <div class="input-field col s12">
            <textarea id="fdescription" v-model="FoodDescription" class="materialize-textarea" data-length="190"></textarea>
            <label for="fdescription">Description</label>
          </div>
          <div class="input-field col s12">
            <input id="priceperhead" v-model="price"  type="text" data-length="20">
            <label for="priceperhead">Price</label>
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
          <a class="btn food-image-finder" @click="toggleShowForProduct">Image</a>
          <div class="preview" v-if="imgDataUrlForFood!=''">
            <img :src="imgDataUrlForFood" alt="preview">
          </div>
        </div>
       </div>
    <div class="modal-footer">
     <a href="#" v-on:click.prevent class="modal-action modal-close waves-effect waves-red btn-flat ">Cancel</a>
     <a href="#" v-on:click.prevent class="modal-action modal-close waves-effect waves-red btn-flat " v-on:click="AddNewProduct()">Save</a>
    </div>
    </div>
    <div class="company-cover-hero" v-if="AboutCompany.heroPicture!=null" :style="'background-image:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),url(/storage/images/'+AboutCompany.heroPicture+')'">
      <div id="company-logo" class="z-depth-3">
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
    <div v-if="Packages[0]!=null">
    <h5 class="titles"><i class="material-icons">local_offer</i> Our packages</h5>
    <div class="packages-list">
      <div class="card" v-for="Profilepackage in Packages">
        <div class="card-image">
          <img src="/DesignPic/1.jpg">
          <a :href="'/package-show/'+Profilepackage.id" class="btn-floating halfway-fab waves-effect waves-light redirect red">
            <i  v-if="((user!=null)&&(user.id==AboutCompany.user_id))" class="material-icons">edit</i>
            <i v-else class="material-icons">remove_red_eye</i>
          </a>
        </div>
        <div class="card-content">
          <span class="card-title">₱{{Profilepackage.price}} per head</span>
          <p><span class="bold">{{Profilepackage.name}}</span><br><br> {{Profilepackage.description}}</p>
        </div>
      </div>
    </div>
    <ul class="pagination">
        <li class="waves-effect" v-if="paginationPackage.current_page > 1"><a href="#" @click.prevent="changepagePackage(paginationPackage.current_page - 1)"><i class="material-icons">chevron_left</i></a></li>
        <li v-for="page in pagesNumberPackage" v-bind:class="[ page == isActivePackage ? 'active red':'']"><a href="#" @click.prevent="changepagePackage(page)">{{page}}</a></li>
        <li class="waves-effect" v-if="paginationPackage.current_page < paginationPackage.last_page"><a href="#" @click.prevent="changepagePackage(paginationPackage.current_page + 1)"><i class="material-icons">chevron_right</i></a></li>
    </ul>
    </div>
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
             <div class="menu-action-btns"v-if="((user!=null)&&(AboutCompany.user_id==user.id))">
               <div class="product-switch" v-on:click="toggleProduct(product.id)">
                 <p v-if="product.Available=='0'" class="white-text"><i class="material-icons">check</i> Available</p>
                 <p v-else class="white-text"><i class="material-icons">close</i>Unavailable</p>
               </div>
               <div class="right-option">
                 <i class="material-icons" onclick="$('#updateProduct').modal('open');" v-on:click="fetchEditProduct(product.id)">edit</i>
                 <i class="material-icons" v-on:click="deleteProduct(product.id)">close</i>
               </div>
             </div>
           </div>
           <div class="card-content">
             <span class="card-title activator grey-text text-darken-4">{{product.name}}<i class="material-icons right">more_vert</i></span>
             <p v-if="AboutCompany.show_prices==0">₱ {{product.price}}</p>
             <div class="menu-options">
               <div class="menu-option-btn">
                 <i class="material-icons add-btn" v-if="(((user==null))||((user!=null) &&(user.role==0)))" v-on:click="addToSessionList(product)">add</i>
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
        <li class="waves-effect" v-if="paginationProduct.current_page > 1"><a href="#" @click.prevent="changepage(paginationProduct.current_page - 1)"><i class="material-icons">chevron_left</i></a></li>
        <li v-for="page in pagesNumberFood" v-bind:class="[ page == isActiveFood ? 'active red':'']"><a href="#" @click.prevent="changepage(page)">{{page}}</a></li>
        <li class="waves-effect" v-if="paginationProduct.current_page < paginationProduct.last_page"><a href="#" @click.prevent="changepage(paginationProduct.current_page + 1)"><i class="material-icons">chevron_right</i></a></li>
    </ul>
    <div class="fixed-action-btn click-to-toggle" v-if="((user!=null)&&(user.id==AboutCompany.user_id))">
       <a href="#" v-on:click.prevent class="btn-floating btn-large red">
         <i class="material-icons">add</i>
       </a>
       <ul>
         <li onclick="$('#addproductmodal').modal('open');"><a class="btn-floating red darken-1"><i class="material-icons">restaurant</i></a></li>
       </ul>
    </div>
    <div class="fixed-action-btn" v-else-if="(((user==null))||((user!=null) &&(user.role==0)))">
      <a  onclick="$('#MyList').modal('open');" class="btn-floating btn-large waves-effect waves-light red" :class="[CompanySession!=null?'pulse':'']"><i class="material-icons">format_list_numbered</i></a>
    </div>
    <div id="updateProduct" class="modal modal-fixed-footer">
    <div class="modal-content">
      <h5>Edit product</h5>
      <div class="food-form-container">
        <div class="input-field col s6">
          <input id="editName" placeholder="Product name" v-model="editName =EditProductData.name" type="text" data-length="20">
          <label for="editName" >Name</label>
        </div>
        <div class="input-field col s12">
          <textarea id="editDescription" placeholder="Product description" v-model="editDesc =EditProductData.description" class="materialize-textarea" data-length="190"></textarea>
          <label for="editDescription">Description</label>
        </div>
        <div class="input-field col s6">
          <input id="priceupdate" placeholder="Product name" v-model="editPrice = EditProductData.price" type="text" data-length="20">
          <label for="priceupdate" >Price</label>
        </div>
        <div class="input-field col s12">
          <select id="EdittypeSelect">
            <option value="0">Food</option>
            <option value="1">Drink</option>
            <option value="2">Sweet</option>
          </select>
          <label for="EdittypeSelect">Select type</label>
        </div>
        <a class="btn food-image-finder" @click="toggleShowForUpdate()">Image</a>
        <div class="preview" v-if="imgDataUrlProductUpdate">
          <img :src="imgDataUrlProductUpdate" alt="preview">
        </div>
        <div class="preview" v-else-if="EditProductData.image!=null">
          <img :src="'/storage/images/'+EditProductData.image" alt="">
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <a href="#" v-on:click.prevent="submitUpdate()" class="modal-action modal-close waves-effect waves-light btn-flat ">Update</a>
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
        v-model="showForProduct"
        langType="En"
        :width="300"
        :height="300"
        :params="params"
        :headers="headers"
        img-format="png">
    </my-upload>
    <my-upload field="img"
        @crop-success="cropSuccessProductUpdate"
        @crop-upload-success="cropUploadSuccessProductUpdate"
        @crop-upload-fail="cropUploadFailProductUpdate"
        v-model="showForUpdate"
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
         showForUpdate:false,
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
         imgDataUrlProductUpdate:'',
         AboutCompany:[],
         FoodName:'',
         FoodDescription:'',
         CompanyProduct:[],
         SelectedSize:[],
         CompanySession:[],
         paginationProduct:[],
         offsetFood:4,
         offsetPackage:4,
         SortType:0,
         productSearch:'',
         Packages:[],
         paginationPackage:[],
         EditProductData:[],
         editName:'',
         editDesc:'',
         price:'',
         editPrice:'',
         foodsavedTotalPrice:0,
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
        this.paginationProduct.current_page = next;
        this.getCompanyProducts(next);
      },
      changepagePackage(next){
        this.paginationProduct.current_page = next;
        this.showpackages(next);
      },
      addToSessionList(FoodData)
      {
        var vm=this;
        axios.post('/mylist-session/'+this.company.id,{
          FoodId:FoodData.id,
          FoodName:FoodData.name,
          FoodImage:FoodData.image,
          FoodPrice:FoodData.price
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
      formatPrice(value) {
          let val = (value/1).toFixed(2).replace('.', ',')
          return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
      },
      showAddedSession()
      {
        var vm=this;
        axios.get('/mylist-session-show/'+this.company.id).then(function(response)
        {
          console.log(response);
          vm.CompanySession=response.data.foodsaved;
          vm.foodsavedTotalPrice = response.data.total;
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
          price:this.price,
          description:this.FoodDescription,
          companyid:this.AboutCompany.id,
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
            vm.price = '';
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
      toggleShowForUpdate() {
                this.showForUpdate = !this.show;
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
                vm.paginationProduct=response.data;
                swal.close();
              });
            },
            deleteProduct(productId)
            {
              var vm=this;
              if (confirm('Are you sure to delete this product?'))
              {
                axios.delete(`/delete-product/`+productId).then(function(response)
                {
                  console.log(response);
                  vm.getCompanyProducts(vm.paginationProduct.current_page);
                }).catch(function(error)
                {
                  console.log(error);
                })
              }
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
            fetchEditProduct(id)
            {
              var vm=this;
              axios.get(`/fetch-edit-detail/`+id).then(function(response)
              {
                console.log(response);
                vm.EditProductData=response.data[0];
                $('#EdittypeSelect').val(response.data[0].Type);
                $("#EdittypeSelect").material_select();
              })
            },
            submitUpdate()
            {
              var vm=this;
              if (confirm('Confirm update?'))
              {
                axios.put(`/update-product/`+this.EditProductData.id,{
                  name:this.editName,
                  description:this.editDesc,
                  type:$('#EdittypeSelect').val(),
                  price:this.editPrice,
                  image:this.imgDataUrlProductUpdate
                }).then(function(response)
                {
                  console.log(response);
                  swal({
                      position: 'top-right',
                      type: 'success',
                      title: 'Success',
                      text:'Updated successfully',
                      showConfirmButton: false,
                      timer: 1500
                    });
                  vm.imgDataUrlProductUpdate='';
                  vm.editName='';
                  vm.editDesc='';
                  vm.getCompanyProducts(vm.paginationProduct.current_page);
                }).catch(function(error)
                {
                  console.log(error);
                  swal({
                      position: 'top-right',
                      type: 'error',
                      title: 'Ooops',
                      text:error.response.data.message,
                      showConfirmButton: false,
                      timer: 1500
                    });
                })
              }
            },
            toggleProduct(id)
            {
              var vm=this;
              axios.put(`/toggle-availability/`+id).then(function(response)
              {
                console.log(response);
                swal({
                    position: 'center',
                    type: 'success',
                    title: 'Success',
                    text:'Updated successfully',
                    showConfirmButton: false,
                    timer: 1500
                  });
                vm.getCompanyProducts(vm.paginationProduct.current_page);
              }).then(function(error)
              {
                console.log(error);
              })
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

            //product

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

            /**
             * crop success
             *
             * [param] imgDataUrl
             * [param] field
             */
            cropSuccessProductUpdate(imgDataUrl, field){
                console.log('-------- crop success --------');
                this.imgDataUrlProductUpdate = imgDataUrl;
            },
            /**
             * upload success
             *
             * [param] jsonData  server api return data, already json encode
             * [param] field
             */
            cropUploadSuccessProductUpdate(jsonData, field){
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
            cropUploadFailProductUpdate(status, field){
                console.log('-------- upload fail --------');
                console.log(status);
                console.log('field: ' + field);
            },
    },
    computed:{
      isActiveFood:function(){
        return this.paginationProduct.current_page;
      },
      pagesNumberFood:function(){
        if (!this.paginationProduct.to) {
           return [];
        }
        var from = this.paginationProduct.current_page - this.offsetFood;
        if (from < 1) {
            from = 1;
        }
        var to = from + (this.offsetFood * 2);
        if (to >= this.paginationProduct.last_page) {
            to = this.paginationProduct.last_page;
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
