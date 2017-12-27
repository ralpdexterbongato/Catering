<template lang="html">
  <div class="categ-setting-container">
    <h4>Food Categories</h4>
    <div class="col s12 categ-input">
     <div class="input-field inline">
       <input id="newCateg" v-model="newName" type="text" class="validate">
       <label for="newCateg">Category</label>
     </div>
     <a href="#" class="btn btn-floating waves-effect waves-blue" v-on:click="Save()"><i class="material-icons">add</i></a>
    </div>
    <div class="divider">
    </div>
    <div class="categories-list">
      <div class="chip category-chip" v-for="category in categories">
       {{category.name}}
       <i class="material-icons" v-on:click="Remove(category.id)">close</i>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
  export default {
    data () { return {
        categories:[],
        newName:'',
      }
    },
    methods: {
      getCategories()
      {
        var vm=this;
        axios.get(`/category-setting-data`).then(function(response)
        {
          console.log(response);
          vm.categories = response.data;
        });
      },
      Save()
      {
        var vm=this;
        axios.post(`/category-store`,{
          name:this.newName
        }).then(function(response)
        {
          console.log(response);
          vm.newName='';
          vm.getCategories();
          swal({
              position: 'top-right',
              type: 'success',
              title: '1 category added',
              showConfirmButton:true
            });
        }).catch(function(error)
        {
          console.log(error);
          swal(
            'Sorry',
            error.response.data.errors.name[0],
            'error'
          )
        })
      },
      Remove(id)
      {
        var vm=this;
      swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
          axios.delete(`/category-delete/`+id).then(function(response)
          {
            vm.getCategories();
            swal(
              'Deleted!',
              'Your file has been deleted.',
              'success'
            )
          }).catch(function(error)
          {
            console.log(error);
          })
        }
      })
      }
    },
    mounted () {
      this.getCategories();
    },
  }
</script>
