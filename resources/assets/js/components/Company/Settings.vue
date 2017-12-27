<template lang="html">
  <div class="company-settings-container">
    <div class="company-settings-table-container">
      <table class="responsive-table">
        <thead>
          <th><i class="material-icons">settings</i> Company settings</th>
        </thead>
        <tbody>
          <tr>
            <th>Profile photo</th>
            <td>
              <div class="file-field input-field">
                 <div class="btn red">
                   <span>File</span>
                   <input type="file">
                 </div>
               </div>
            </td>
            <td><img v-if="currentLogo != ''" :src="'/storage/images/'+currentLogo.logo" alt=""></td>
            <td>
              <a href="#" class="btn btn-floating white"><i class="material-icons red-text darken-1">loop</i></a>
            </td>
          </tr>
          <tr>
            <th>Cover photo</th>
            <td>
              <div class="file-field input-field">
                 <div class="btn red">
                   <span>File</span>
                   <input type="file">
                 </div>
               </div>
            </td>
            <td><img v-if="currentCover != ''" :src="'/storage/images/'+currentCover.heroPicture" alt=""></td>
            <td>
              <a href="#" class="btn btn-floating white"><i class="material-icons red-text darken-1">loop</i></a>
            </td>
          </tr>
          <tr>
            <th>Minimum visitors</th>
            <td><input type="number" name="" value=""></td>
            <td>100 people</td>
            <td>
              <a href="#" class="btn btn-floating white"><i class="material-icons red-text darken-1">loop</i></a>
            </td>
          </tr>
        </tbody>
      </table>
      <div class="available-colors-container">
        <h6>Available color theme</h6>
        <div class="color-form">
          <input type="color" v-model="selectedColor">
          <i class="material-icons">add</i>
        </div>
        <div class="divider">
        </div>
        <div class="color-added-chips">
          <p class="chip red">theme <i class="material-icons">close</i></p>
          <p class="chip blue">theme <i class="material-icons">close</i></p>
          <p class="chip green">theme <i class="material-icons">close</i></p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
  export default {
    data () { return {
      currentLogo:'',
      currentCover:'',
      selectedColor:'#F44336'
      }
    },
    created()
    {
      this.fetchLogo();
      this.fetchCover();
    },
    props: [],
    methods: {
      fetchLogo()
      {
        var vm=this;
        axios.get(`/comp-settings-profile`).then(function(response)
        {
          vm.currentLogo=response.data[0];
          console.log(response);
        }).catch(function(error)
        {
          console.log(error);
        });
      },
      fetchCover()
      {
        var vm=this;
        axios.get(`/comp-settings-cover`).then(function(response)
        {
          vm.currentCover=response.data[0];
          console.log(response);
        }).catch(function(error)
        {
          console.log(error);
        });
      }
    },
  }
</script>
