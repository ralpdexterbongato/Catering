<template lang="html">
  <div class="package-show-container">
    <table>
      <thead>
        <tr>
          <th>{{companyName}}</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th>Package</th>
          <td>
            <div v-if="packageNameIsActive==false" class="edit-pack-container">
              <p>{{PackageName}}</p>
              <i v-if="ownerid[0].user_id == user.id" class="material-icons indigo-text" v-on:click="packageNameIsActive=true">edit</i>
            </div>
            <div v-else-if="ownerid[0].user_id == user.id" class="edit-pack-container">
              <input type="text" v-model="NewName =PackageName" value="">
              <span>
                <i class="material-icons indigo-text" v-on:click="updateName()">loop</i>
                <i class="material-icons red-text" v-on:click="packageNameIsActive=false,getDataName()">close</i>
              </span>
            </div>
          </td>
        </tr>
        <tr>
          <th>Description</th>
          <td>
            <div v-if="packageDescIsActive==false" class="edit-pack-container">
              <p>{{PackageDesc}}</p>
              <i v-if="ownerid[0].user_id == user.id" class="material-icons indigo-text" v-on:click="packageDescIsActive=true">edit</i>
            </div>
            <div v-else-if="ownerid[0].user_id == user.id" class="edit-pack-container">
              <input type="text" v-model="NewDesc = PackageDesc" value="">
              <span>
                <i class="material-icons indigo-text" v-on:click="updateDesc()">loop</i>
                <i class="material-icons red-text" v-on:click="packageDescIsActive=false,getDataDesc()">close</i>
              </span>
            </div>
          </td>
        </tr>
        <tr>
          <th>Price per-head</th>
          <td>
            <span v-if="packagePriceIsActive==false" class="edit-pack-container">
              <p>P {{PackagePrice}}</p>
              <i v-if="ownerid[0].user_id == user.id" class="material-icons indigo-text" v-on:click="packagePriceIsActive=true">edit</i>
            </span>
            <span v-else-if="ownerid[0].user_id == user.id" class="edit-pack-container">
              <input type="text" v-model="NewPrice = PackagePrice">
              <span>
                <i class="material-icons indigo-text" v-on:click="updatePrice()">loop</i>
                <i class="material-icons red-text" v-on:click="packagePriceIsActive=false,getDataPrice()">close</i>
              </span>
            </span>
          </td>
        </tr>
        <tr>
          <th><a href="#" v-if="ownerid[0].user_id == user.id" class="btn btn-floating"><i class="material-icons">add</i></a></th>
        </tr>
        <tr>
          <th>Foods</th>
          <td class="table-package-product-container">
            <div v-if="product.Type == 0" class="product-box-bigger z-depth-2 white" v-for="product in PackageProducts">
              <i v-if="ownerid[0].user_id == user.id" class="material-icons close-btn-preview" v-on:click="removeProduct(product.id)">close</i>
              <img :src="'/storage/images/'+product.image" alt="productpic">
              <p class="bold">{{product.name}}</p>
            </div>
          </td>
        </tr>
        <tr>
          <th>Drinks</th>
          <td class="table-package-product-container">
            <div v-if="product.Type == 1" class="product-box-bigger z-depth-2 white" v-for="product in PackageProducts">
              <i v-if="ownerid[0].user_id == user.id" class="material-icons close-btn-preview" v-on:click="removeProduct(product.id)">close</i>
              <img :src="'/storage/images/'+product.image" alt="productpic">
              <p class="bold">{{product.name}}</p>
            </div>
          </td>
        </tr>
        <tr>
          <th>Sweets</th>
          <td class="table-package-product-container">
            <div v-if="product.Type == 2" class="product-box-bigger z-depth-2 white" v-for="product in PackageProducts">
              <i v-if="ownerid[0].user_id == user.id" class="material-icons close-btn-preview" v-on:click="removeProduct(product.id)">close</i>
              <img :src="'/storage/images/'+product.image" alt="productpic">
              <p class="bold">{{product.name}}</p>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="i-want-container" v-if="user.role==0">
      <a href="#" v-on:click.prevent="proceed()" class="btn">Proceed now <i class="material-icons">arrow_forward</i></a>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
  export default {
    data () {
      return {
        PackageName:'',
        companyName:'',
        PackageDesc:'',
        PackagePrice:'',
        PackageProducts:'',
        packageNameIsActive:false,
        packageDescIsActive:false,
        packagePriceIsActive:false,
        NewName:'',
        NewDesc:'',
        NewPrice:'',
        companyId:'',
        packageId:'',
      }
    },
    props: ['packageid','user','ownerid'],
    methods: {
      getDataName()
      {
        var vm=this;
        axios.get(`/package-show-data-name/`+this.packageid.id).then(function(response)
        {
          console.log(response);
          vm.PackageName = response.data[0].name;
          vm.companyName= response.data[0].company.name;
          vm.companyId= response.data[0].company_id;
          vm.packageId=response.data[0].id;
        }).catch(function(error)
        {
          console.log(error);
        })
      },
      getDataDesc()
      {
        var vm=this;
        axios.get(`/package-show-data-description/`+this.packageid.id).then(function(response)
        {
          console.log(response);
          vm.PackageDesc = response.data[0].description;
        }).catch(function(error)
        {
          console.log(error);
        })
      },
      getDataPrice()
      {
        var vm=this;
        axios.get(`/package-show-data-price/`+this.packageid.id).then(function(response)
        {
          console.log(response);
          vm.PackagePrice = response.data[0].price;
        }).catch(function(error)
        {
          console.log(error);
        })
      },
      proceed()
      {
        var vm=this;
        axios.post(`/package-proceed`,{
          id:this.packageId,
          name:this.PackageName,
          description:this.PackageDesc,
          price:this.PackagePrice,
          companyid:this.companyId
        }).then(function(response)
        {
          console.log(response);
          window.location = response.data.redirect;
        }).catch(function(error)
        {
          console.log(error);
        })
      },
      updateName()
      {
        var vm=this;
        axios.put(`/package-update-name/`+this.packageid.id,{
          name:this.NewName
        }).then(function(response)
        {
          console.log(response);
          vm.packageNameIsActive=false;
          vm.PackageName = response.data;
          swal({
              position: 'top-right',
              type: 'success',
              title: 'Success',
              text:'Updated successfully',
              showConfirmButton: false,
              timer: 1500
            });
        }).catch(function(error)
        {
          console.log(error);
          swal({
              position: 'top-right',
              type: 'error',
              title: 'Opps',
              text:error.response.data.message,
              showConfirmButton: false,
              timer: 1500
            });
        })
      },
      updateDesc()
      {
        var vm=this;
        axios.put(`/package-update-desc/`+this.packageid.id,{
          description:this.NewDesc
        }).then(function(response)
        {
          console.log(response);
          vm.packageDescIsActive=false;
          vm.PackageDesc = response.data;
          swal({
              position: 'top-right',
              type: 'success',
              title: 'Success',
              text:'Updated successfully',
              showConfirmButton: false,
              timer: 1500
            });
        }).catch(function(error)
        {
          console.log(error);
          swal({
              position: 'top-right',
              type: 'error',
              title: 'Opps',
              text:error.response.data.message,
              showConfirmButton: false,
              timer: 1500
            });
        })
      },
      updatePrice()
      {
        var vm=this;
        axios.put(`/package-update-price/`+this.packageid.id,{
          price:this.NewPrice
        }).then(function(response)
        {
          console.log(response);
          vm.packagePriceIsActive=false;
          vm.PackagePrice = response.data;
          swal({
              position: 'top-right',
              type: 'success',
              title: 'Success',
              text:'Updated successfully',
              showConfirmButton: false,
              timer: 1500
            });
        }).catch(function(error)
        {
          console.log(error);
          swal({
              position: 'top-right',
              type: 'error',
              title: 'Opps',
              text:error.response.data.message,
              showConfirmButton: false,
              timer: 1500
            });
        })
      },
      showProduct()
      {
        var vm=this;
        axios.get(`/package-show-data-products/`+this.packageid.id).then(function(response)
        {
          console.log(response);
          vm.PackageProducts=response.data[0].products;
        }).catch(function(error)
        {
          console.log(error);
        });
      },
      removeProduct(ProductId)
      {
        var vm=this;
        axios.delete(`/remove-package-product/`+this.packageid.id+`/`+ProductId).then(function(response)
        {
          console.log(response);
          swal({
              position: 'top-right',
              type: 'success',
              title: 'Success',
              text:'Removed successfully',
              showConfirmButton: false,
              timer: 1500
          });
          vm.showProduct();
        }).catch(function(error)
        {
          console.log(error);
          swal({
              position: 'top-right',
              type: 'error',
              title: 'Opps',
              text:error.response.data.message,
              showConfirmButton: false,
              timer: 1500
            });
        })
      }
    },
    mounted () {
      this.getDataName();
      this.getDataDesc();
      this.getDataPrice();
      this.showProduct();
    },
  }
</script>
