<template lang="html">
  <div class="package-show-container">
    <div id="product-choice-modal" class="modal modal-fixed-footer">
      <div class="modal-content">
        <h4><input type="text" placeholder="Search"  v-on:keyup.enter="fetchProductChoices(1)" v-model="ProductSearch"></h4>
        <div class="all-products-choices">
          <div class="product-box z-depth-2 white" v-on:click.prevent="AddProductToPack(product.id)" v-for="(product,count) in Products">
            <img :src="'/storage/images/'+product.image" alt="productpic">
            <p class="bold">{{product.name}}</p>
          </div>
        </div>
        <ul class="pagination">
            <li class="waves-effect" v-if="pagination.current_page > 1"><a href="#" @click.prevent="changepage(pagination.current_page - 1)"><i class="material-icons">chevron_left</i></a></li>
            <li v-for="page in pagesNumber" v-bind:class="[ page == isActive ? 'active indigo':'']"><a href="" @click.prevent="changepage(page)">{{page}}</a></li>
            <li class="waves-effect" v-if="pagination.current_page < pagination.last_page"><a href="" @click.prevent="changepage(pagination.current_page + 1)"><i class="material-icons">chevron_right</i></a></li>
        </ul>
      </div>
      <div class="modal-footer">
        <a href="" class="modal-action modal-close waves-effect waves-green btn-flat ">Close</a>
      </div>
    </div>
    <table class="striped">
      <thead>
        <tr>
          <th>{{companyName}}'s package</th>
          <td><a v-on:click.prevent="deletePackage()" v-if="user!=null && ownerid[0].user_id == user.id" href="#" class="btn right btn-floating"><i class="material-icons">delete</i></a></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th>Package</th>
          <td>
            <div v-if="packageNameIsActive==false" class="edit-pack-container">
              <p>{{PackageName}}</p>
              <a href="#" v-if="user!=null && ownerid[0].user_id == user.id" class="btn btn-floating"><i class="material-icons" v-on:click.prevent="packageNameIsActive=true">edit</i></a>
            </div>
            <div v-else-if="user!=null && ownerid[0].user_id == user.id" class="edit-pack-container">
              <input type="text" v-model="NewName =PackageName" value="">
              <span>
                <i class="material-icons indigo-text" v-on:click.prevent="updateName()">loop</i>
                <i class="material-icons red-text" v-on:click.prevent="packageNameIsActive=false,getDataName()">close</i>
              </span>
            </div>
          </td>
        </tr>
        <tr>
          <th>Description</th>
          <td>
            <div v-if="packageDescIsActive==false" class="edit-pack-container">
              <p>{{PackageDesc}}</p>
              <a href="#" class="btn btn-floating" v-if="user!=null && ownerid[0].user_id == user.id"><i class="material-icons" v-on:click.prevent="packageDescIsActive=true">edit</i></a>
            </div>
            <div v-else-if="user!=null && ownerid[0].user_id == user.id" class="edit-pack-container">
              <input type="text" v-model="NewDesc = PackageDesc" value="">
              <span>
                <i class="material-icons indigo-text" v-on:click.prevent="updateDesc()">loop</i>
                <i class="material-icons red-text" v-on:click.prevent="packageDescIsActive=false,getDataDesc()">close</i>
              </span>
            </div>
          </td>
        </tr>
        <tr>
          <th>Price per-head</th>
          <td>
            <span v-if="packagePriceIsActive==false" class="edit-pack-container">
              <p>P {{PackagePrice}}</p>
              <a href="#" class="btn btn-floating" v-if="user!=null && ownerid[0].user_id == user.id"><i class="material-icons" v-on:click.prevent="packagePriceIsActive=true">edit</i></a>
            </span>
            <span v-else-if="user!=null && ownerid[0].user_id == user.id" class="edit-pack-container">
              <input type="text" v-model="NewPrice = PackagePrice">
              <span>
                <i class="material-icons indigo-text" v-on:click.prevent="updatePrice()">loop</i>
                <i class="material-icons red-text" v-on:click.prevent="packagePriceIsActive=false,getDataPrice()">close</i>
              </span>
            </span>
          </td>
        </tr>
        <tr>
          <th><a href="#" onclick="$('#product-choice-modal').modal('open')" v-on:click.prevent="[Products[0]==null?fetchProductChoices(1):'']" v-if="user!=null && ownerid[0].user_id == user.id" class="btn btn-floating"><i class="material-icons">add</i></a></th>
        </tr>
        <tr>
          <th>Foods</th>
          <td class="table-package-product-container">
            <div v-if="product.Type == 0" class="product-box-bigger z-depth-2 white" v-for="product in PackageProducts">
              <i v-if="user!=null && ownerid[0].user_id == user.id" class="material-icons close-btn-preview" v-on:click.prevent="removeProduct(product.id)">close</i>
              <img :src="'/storage/images/'+product.image" alt="productpic">
              <p class="bold">{{product.name}}</p>
            </div>
          </td>
        </tr>
        <tr>
          <th>Drinks</th>
          <td class="table-package-product-container">
            <div v-if="product.Type == 1" class="product-box-bigger z-depth-2 white" v-for="product in PackageProducts">
              <i v-if="user!=null && ownerid[0].user_id == user.id" class="material-icons close-btn-preview" v-on:click.prevent="removeProduct(product.id)">close</i>
              <img :src="'/storage/images/'+product.image" alt="productpic">
              <p class="bold">{{product.name}}</p>
            </div>
          </td>
        </tr>
        <tr>
          <th>Sweets</th>
          <td class="table-package-product-container">
            <div v-if="product.Type == 2" class="product-box-bigger z-depth-2 white" v-for="product in PackageProducts">
              <i v-if="user!=null && ownerid[0].user_id == user.id" class="material-icons close-btn-preview" v-on:click.prevent="removeProduct(product.id)">close</i>
              <img :src="'/storage/images/'+product.image" alt="productpic">
              <p class="bold">{{product.name}}</p>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="i-want-container" v-if="user!=null && user.role==0">
      <a href="#" v-on:click.prevent="proceed()" class="btn">Proceed now <i class="material-icons">arrow_forward</i></a>
    </div>
    <div v-else-if="user==null" class="i-want-container">
      <p>Please <span class="bold indigo-text" id="login-opener-3">Login</span> | <span><a href="/register" class="bold indigo-text">Register</a></span> to proceed.</p>
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
        Products:[],
        ProductSearch:'',
        pagination:[],
        offset:4
      }
    },
    props: ['packageid','user','ownerid'],
    methods: {
      changepage(next){
        this.pagination.current_page = next;
        this.fetchProductChoices(next);
      },
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
      },
      fetchProductChoices(page)
      {
        var vm=this;
        axios.get(`/package-all-product?search=`+this.ProductSearch+`&page=`+page).then(function(response)
        {
          console.log(response);
          vm.Products=response.data.data;
          vm.pagination= response.data;
        }).catch(function(error)
        {
          console.log(error);
        });
      },
      AddProductToPack(id)
      {
        var vm=this;
        axios.post(`/add-package-product/`+this.packageid.id,{
          productId:id
        }).then(function(response)
        {
          console.log(response);
          if (response.data.error!=null)
          {
            swal({
                position: 'top-right',
                type: 'error',
                title: 'Oops',
                text:response.data.error,
                showConfirmButton: false,
                timer: 1500
            });
          }else
          {
            swal({
                position: 'top-right',
                type: 'success',
                title: 'Success',
                text:'Added successfully',
                showConfirmButton: false,
                timer: 1500
            });
            vm.showProduct();
          }
        }).catch(function(error)
        {
          console.log(error);
          swal({
              position: 'top-right',
              type: 'error',
              title: 'Oops',
              text:error.response.data.message,
              showConfirmButton: false,
              timer: 1500
          });
        })
      },
      deletePackage()
      {
        if (confirm("Are you sure?"))
        {
          var vm=this;
          axios.delete(`/package-delete/`+this.packageid.id).then(function(response)
          {
            console.log(response);
            swal({
                position: 'top-right',
                type: 'success',
                title: 'Success',
                text:'Deleted successfully',
                showConfirmButton: false,
                timer: 1500
            });
            window.location = response.data.redirect+'/'+vm.companyId;
          }).then(function(error)
          {
            console.log(error);
          });
        }
      }
    },
    computed:{
      isActive:function(){
        return this.pagination.current_page;
      },
      pagesNumber:function(){
        if (!this.pagination.to) {
           return [];
        }
        var from = this.pagination.current_page - this.offset;
        if (from < 1) {
            from = 1;
        }
        var to = from + (this.offset * 2);
        if (to >= this.pagination.last_page) {
            to = this.pagination.last_page;
        }
        var pagesArray = [];
        while (from <= to) {
            pagesArray.push(from);
            from++;
        }
        return pagesArray;
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
