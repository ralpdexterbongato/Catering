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
          <td>{{PackageDetail.name}}</td>
        </tr>
        <tr>
          <th>Description</th>
          <td>{{PackageDetail.description}}</td>
        </tr>
        <tr>
          <th>Price</th>
          <td>P{{PackageDetail.price}} per head</td>
        </tr>
        <tr>
          <th>Foods</th>
          <td class="table-package-product-container">
            <div v-if="product.Type == 0" class="product-box-bigger z-depth-2 white" v-for="product in PackageDetail.products">
              <img :src="'/storage/images/'+product.image" alt="productpic">
              <p class="bold">{{product.name}}</p>
            </div>
          </td>
        </tr>
        <tr>
          <th>Drinks</th>
          <td class="table-package-product-container">
            <div v-if="product.Type == 1" class="product-box-bigger z-depth-2 white" v-for="product in PackageDetail.products">
              <img :src="'/storage/images/'+product.image" alt="productpic">
              <p class="bold">{{product.name}}</p>
            </div>
          </td>
        </tr>
        <tr>
          <th>Sweets</th>
          <td class="table-package-product-container">
            <div v-if="product.Type == 2" class="product-box-bigger z-depth-2 white" v-for="product in PackageDetail.products">
              <img :src="'/storage/images/'+product.image" alt="productpic">
              <p class="bold">{{product.name}}</p>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="i-want-container">
      <a href="#" class="btn">Proceed now <i class="material-icons">arrow_forward</i></a>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
  export default {
    data () {
      return {
        PackageDetail:[],
        companyName:'',
      }
    },
    props: ['packageid'],
    methods: {
      getData()
      {
        var vm=this;
        axios.get(`/package-show-data/`+this.packageid.id).then(function(response)
        {
          console.log(response);
          vm.PackageDetail = response.data[0];
          vm.companyName= response.data[0].company.name;
        }).catch(function(error)
        {
          console.log(error);
        })
      }
    },
    mounted () {
      this.getData();
    },
  }
</script>
