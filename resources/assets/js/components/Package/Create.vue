<template>
  <div class="Package-Create-Container">
    <div class="fixed-action-btn horizontal">
      <a onclick="$('#product-modal').modal('open')" class="btn-floating btn-large red waves-effect waves-light">
        <i class="large material-icons">add</i>
      </a>
    </div>
    <div id="product-modal" class="modal modal-fixed-footer">
      <div class="modal-content">
        <h5>Product list</h5>
        <div class="search-modal-container">
          <div class="input-field col s12">
          <input id="search" v-on:keyup.enter="getallProduct(1)" v-model="SearchProd" type="text" >
          <label for="search">Search</label>
        </div>
        </div>
        <div class="product-box-modal-container">
          <div class="product-box z-depth-2 white" v-on:click="selectProduct(product)" v-for="(product,count) in ProdData">
            <img :src="'/storage/images/'+product.image" alt="productpic">
            <p class="bold">{{product.name}}</p>
          </div>
        </div>
        <ul class="pagination modal-pagination">
            <li class="waves-effect" v-if="pagination.current_page > 1"><a href="#" @click.prevent="changepage(pagination.current_page - 1)"><i class="material-icons">chevron_left</i></a></li>
            <li v-for="page in pagesNumber" v-bind:class="[ page == isActive ? 'active red':'']"><a href="#" @click.prevent="changepage(page)">{{page}}</a></li>
            <li class="waves-effect" v-if="pagination.current_page < pagination.last_page"><a href="#" @click.prevent="changepage(pagination.current_page + 1)"><i class="material-icons">chevron_right</i></a></li>
        </ul>
      </div>
      <div class="modal-footer">
        <a href="#" v-on:click.prevent class="modal-action modal-close waves-effect waves-green btn-flat ">Close</a>
      </div>
    </div>
    <div class="pack-form-container">
      <div class="pack-form-left">
        <div class="package-forms z-depth-2">
          <div class="input-field col s12">
             <input id="Name" placeholder="`" v-on:keyup="ValidationErrors.name=null" v-model="PackName" :class="[ValidationErrors.name!=null?'invalid':'']" type="text" >
             <label for="Name" :data-error="[ValidationErrors.name!=null?ValidationErrors.name[0]:'']">Package name</label>
          </div>
          <div class="input-field col s12">
             <input id="price" placeholder="`" v-on:keyup="ValidationErrors.price=null" v-model="PackPrice" :class="[ValidationErrors.price!=null?'invalid':'']" type="number" >
             <label for="price" :data-error="[ValidationErrors.price!=null?ValidationErrors.price[0]:'']">Price per head</label>
          </div>
          <div class="input-field col s12">
            <textarea id="Description" placeholder="`" v-model="PackDesc" v-on:keyup="ValidationErrors.descript=null" :class="[ValidationErrors.descript!=null?'invalid':'']" class="materialize-textarea"></textarea>
            <label for="Description" :data-error="[ValidationErrors.descript!=null?ValidationErrors.descript[0]:'']">Description</label>
          </div>
          <a href="#" v-on:click.prevent="submitall()" class="btn">save</a>
        </div>
      </div>
      <div class="pack-form-right">
        <table>
          <tr>
            <th>Foods</th>
          </tr>
          <tr>
            <td class="table-pack-selected">
              <div v-on:click="removeSelected(keycount)" v-if="selected.Type==0" v-for="(selected,keycount) in prodSelected" class="product-box z-depth-2 white">
                <img :src="'/storage/images/'+selected.image" alt="">
                <p class="bold">{{selected.name}}</p>
              </div>
            </td>
          </tr>
          <tr>
            <th>Drinks</th>
          </tr>
          <tr>
            <td class="table-pack-selected">
              <div v-if="selected.Type==1" v-on:click="removeSelected(drinkKey)" v-for="(selected,drinkKey) in prodSelected" class="product-box z-depth-2 white">
                <img :src="'/storage/images/'+selected.image" alt="">
                <p class="bold">{{selected.name}}</p>
              </div>
            </td>
          </tr>
          <tr>
            <th>Sweets</th>
          </tr>
          <tr>
            <td class="table-pack-selected">
              <div v-if="selected.Type==2" v-on:click="removeSelected(sweetKey)" v-for="(selected, sweetKey) in prodSelected" class="product-box z-depth-2 white">
                <img :src="'/storage/images/'+selected.image" alt="">
                <p class="bold">{{selected.name}}</p>
              </div>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</template>
<script>
import axios from 'axios';
  export default {
    data () {
      return {
        ProdData:[],
        pagination:[],
        offset:4,
        SearchProd:'',
        prodSelected:[],
        PackName:'',
        PackDesc:'',
        PackPrice:'',
        ValidationErrors:[]
      }
    },
    props: [],
    methods:
    {
      changepage(next){
        this.pagination.current_page = next;
        this.getallProduct(next);
      },
      getallProduct(page)
      {
        var vm=this;
        axios.get(`/package-all-product?page=`+page+`&search=`+this.SearchProd).then(function(response)
        {
          console.log(response);
          vm.ProdData=response.data.data;
          vm.pagination=response.data;
        })
      },
      selectProduct(data)
      {
        for (var i = 0; i < this.prodSelected.length; i++)
        {
          if (this.prodSelected[i].id==data.id)
          {
            swal({
                position: 'top-right',
                type: 'error',
                title: 'Opps',
                text:'This is already added',
                showConfirmButton: false,
                timer: 1500
              });
              return false;
          }
        }
        this.prodSelected.push(data);
        swal({
            position: 'top-right',
            type: 'success',
            title: 'Success',
            text:'Added successfully',
            showConfirmButton: false,
            timer: 1500
        });
      },
      removeSelected(count)
      {
        this.prodSelected.splice(count,1);
        swal({
            position: 'top-right',
            type: 'success',
            title: 'Succesfully removed',
            text:'removed successfully',
            showConfirmButton: false,
            timer: 1500
        });
      },
      submitall()
      {
        var vm=this;
        axios.post(`/package-store`,{
          name:this.PackName,
          descript:this.PackDesc,
          price:this.PackPrice,
          products:this.prodSelected
        }).then(function(response)
        {
          if (response.data.error!=null)
          {
             Materialize.toast(response.data.error, 4000)
          }else
          {
             Materialize.toast(response.data.success, 4000)
            vm.PackName = '';
            vm.PackDesc = '';
            vm.PackPrice = '';
            vm.prodSelected = [];
          }
        }).catch(function(error)
        {
          console.log(error.response.data.errors);
           Materialize.toast(error.response.data.message, 4000);
           vm.ValidationErrors = error.response.data.errors;
        });
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
    created ()
    {
      this.getallProduct();
    },
  }
</script>
