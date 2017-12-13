<template lang="html">
  <div class="CompanyProfileContainer">
    <div id="listmodal" class="modal modal-fixed-footer">
       <div class="modal-content">
         <h4>List of order</h4>
         <p><i class="material-icons blue-text">info</i> Be sure to click send when done, so we can receive your reservation. Thank you</p>
         <div class="added-session-table">
           <table>
             <tr v-for="(session,loopkey) in CompanySession">
               <td><img :src="'/storage/images/'+session.foodImage"></td>
               <td>{{session.foodName}}</td>
               <td>P {{session.foodPrice}}</td>
               <td>{{session.Qty}} <span v-if="session.Qty==1">pc.</span><span v-else>pcs.</span></td>
               <td v-on:click="RemoveFromList(session.foodId)"><i class="material-icons grey-text">close</i></td>
             </tr>
           </table>
         </div>
       </div>
       <div class="modal-footer">
         <a class="total-session">Total:P {{ListTotal}}</a>
         <a v-if="user!=null" href="#!" class="modal-action modal-close waves-effect waves-light btn-flat blue-text">Send</a>
        <span>
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
          <a class="btn food-image-finder" @click="toggleShow" v-on:click="FoodImageActive=true">food image</a>
          <div class="preview">
            <img :src="imgDataUrl" alt="preview">
          </div>
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
      <div class="showcase-box" v-for="(product,productKey) in CompanyProduct">
        <div class="card">
           <div class="card-image waves-effect waves-block waves-light">
             <img class="activator" :src="'/storage/images/'+product.image">
           </div>
           <div class="card-content">
             <span class="card-title activator grey-text text-darken-4">{{product.name}}<i class="material-icons right">more_vert</i></span>
             <p class="bold" v-if="SelectedSize[productKey]==0 || SelectedSize[productKey]==null ">
               P {{product.prices[0].Amount}} Normal size
             </p>
             <p class="bold" v-if="SelectedSize[productKey]==1">
               P {{product.prices[1].Amount}} Medium size
             </p>
             <p class="bold" v-if="SelectedSize[productKey]==2">
               P {{product.prices[2].Amount}} Large size
             </p>
             <div class="menu-options">
               <div class="quantity-input">
                 <input type="number" min="1" v-model="QtyWant[productKey]" placeholder="1" v-if="(((user!=null) && (AboutCompany.user_id!=user.id))||(user==null))">
               </div>
               <div class="menu-option-btn">
                 <i class="material-icons add-btn" v-if="(((user!=null) && (AboutCompany.user_id!=user.id))||(user==null))" v-on:click="addToSessionList(product,productKey)">add</i>
                 <i class="material-icons view-btn">remove_red_eye</i>
                 <i class="material-icons fav-btn">favorite</i>
               </div>
             </div>
           </div>
           <div class="card-reveal">
             <span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i></span>
             <p>{{product.description}}</p>
             <div class="size-price">
               <table>
                 <tr>
                   <th>Price</th>
                   <th>Size</th>
                   <th><i class="material-icons">people</i></th>
                   <th></th>
                 </tr>
                 <tr v-for="(price,key) in product.prices">
                   <td>P {{price.Amount}}</td>
                   <td>{{price.Size}}</td>
                   <td>{{price.goodfor}}</td>
                   <td v-if="(((user!=null) && (AboutCompany.user_id!=user.id))||(user==null)) ">
                     <p>
                      <input type="radio" v-model="SelectedSize[productKey]" checked :value="key"   :name="productKey" :id="product.id+'choose'+key" />
                      <label :for="product.id+'choose'+key">choose</label>
                    </p>
                   </td>
                 </tr>
               </table>
             </div>
           </div>
         </div>
      </div>
    </div>
    <div class="fixed-action-btn" v-if="((user!=null)&&(user.id==AboutCompany.user_id))">
       <a href="#addproductmodal" class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">add</i></a>
    </div>
    <div class="fixed-action-btn" v-else>
      <a href="#listmodal" class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">format_list_numbered</i></a>
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
          :width="900"
          :height="900"
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
         FoodImageActive:false,
         CompanyProduct:[],
         SelectedSize:[],
         CompanySession:[],
         QtyWant:[],
         ListTotal:'0',
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
      addToSessionList(FoodData,key)
      {
        if (this.SelectedSize[key]==null)
        {
          this.SelectedSize[key]=0;
        }
        if (this.QtyWant[key]==null)
        {
          this.QtyWant[key]=1;
        }
        var vm=this;
        axios.post('/mylist-session/'+this.company.id,{
          FoodId:FoodData.id,
          FoodName:FoodData.name,
          Size:this.SelectedSize[key],
          FoodImage:FoodData.image,
          Price:FoodData.prices[this.SelectedSize[key]].Amount,
          Qty:this.QtyWant[key]
        }).then(function(response)
        {
          console.log(response);
          vm.showAddedSession();
          vm.$swal({
              position: 'top-right',
              type: 'success',
              title: '1 item added to your list',
              showConfirmButton:true
            });
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
              showConfirmButton:true
            });
          vm.getCompanyProducts();
        },function(error)
        {
          console.log(error);
        });
      },
      RemoveFromList(foodid)
      {
        var vm=this;
        axios.delete(`/mylist-session-delete/`+this.company.id+`/`+foodid).then(function(response)
        {
          console.log(response);
          vm.showAddedSession();
          vm.$swal({
              position: 'top-right',
              type: 'success',
              title: '1 item removed from your list',
              showConfirmButton:true
            });
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
                    showConfirmButton: true
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
                    showConfirmButton: true

                  });
                  vm.imgDataUrl='';
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
