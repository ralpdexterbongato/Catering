<template lang="html">
  <div class="vue-company-index-container">
    <div class="index-company-container">
      <div class="company-box" v-for="company in IndexData">
        <div class="card">
         <div class="card-image waves-effect waves-block waves-light">
           <img class="activator" :src="'/storage/images/'+company.logo">
         </div>
         <div class="card-content">
           <span class="card-title activator grey-text text-darken-4">{{company.name}}<i class="material-icons right">more_vert</i></span>
           <p><a  class="indigo-text":href="'/company-show/'+company.id"><i class="material-icons">radio_button_unchecked</i> Menu</a></p>
         </div>
         <div class="card-reveal">
           <span class="card-title grey-text text-darken-4">{{company.name}}<i class="material-icons right">close</i></span>
           <p>{{company.description}}</p>
         </div>
       </div>
      </div>
    </div>
    <ul class="pagination">
        <li class="waves-effect" v-if="pagination.current_page > 1"><a href="#" @click.prevent="changepage(pagination.current_page - 1)"><i class="material-icons">chevron_left</i></a></li>
        <li v-for="page in pagesNumber" v-bind:class="[ page == isActive ? 'active indigo':'']"><a href="#!" @click.prevent="changepage(page)">{{page}}</a></li>
        <li class="waves-effect" v-if="pagination.current_page < pagination.last_page"><a href="#!" @click.prevent="changepage(pagination.current_page + 1)"><i class="material-icons">chevron_right</i></a></li>
    </ul>
  </div>
</template>
<script>
  import axios from 'axios';
  export default {
    data () {
      return {
        IndexData:[],
        pagination:[],
        offset:4
      }
    },
    created()
    {
      this.getIndexData();
    },
    methods: {
      changepage(next){
        this.pagination.current_page = next;
        this.getIndexData(next);
      },
      getIndexData(page)
      {
        this.$swal({
            text: "Please wait.",
            showConfirmButton: false
        });
        var vm=this;
        axios.get(`/company-index-data?page=`+page).then(function(response)
        {
          console.log(response);
          vm.IndexData=response.data.data;
          vm.pagination=response.data;
          vm.$swal.close();
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
  }
</script>
