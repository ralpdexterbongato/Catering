<template lang="html">
<div class="forgot-pass-container">
  <div class="forgot-pass-box z-depth-1">
    <h5>Password recovery</h5>
    <div class="input-field col s6">
     <input id="Search" type="text" v-model="Search" placeholder="Your email or username" v-on:keyup.enter="searchAcc()">
    </div>
    <div class="result-viewer-container">
      <ul class="collection" v-if="Result[0]!=null">
       <li class="collection-item avatar">
         <img :src="'/storage/images/'+Result[0].avatar" alt="" class="circle">
         <span class="title">{{Result[0].name}}</span>
         <p>{{Result[0].email}}<br>
         </p>
         <a href="" v-on:click.prevent="sendMail()" class="secondary-content"><i class="material-icons">send</i></a>
       </li>
     </ul>
    </div>
    <a href="#" class="btn seach-my-email" v-on:click="searchAcc()"><i class="material-icons">search</i> Search</a>
    <div class="progress forgot-preload" v-if="Loading==true">
      <div class="indeterminate" style="width: 70%"></div>
    </div>
  </div>
</div>
</template>

<script>
  export default {
    data () { return {
        Search:'',
        Result:[],
        Loading:false,
      }
    },
    // props: [],
    methods: {
      searchAcc()
      {
        this.Loading=true;
        var vm=this;
        axios.get(`/search-my-forgotten-account?search=`+this.Search).then(function(response)
        {
          console.log(response);
          vm.Result=response.data;
          vm.Loading=false;
        }).catch(function(error)
        {
          console.log(error);
        })
      },
      sendMail()
      {
        this.Loading=true;
        var vm=this;
        axios.post(`/forgot-password-send-mail`,{
          email:this.Result[0].email,
          confirmation:this.Result[0].confirmation_code,
        }).then(function(response)
        {
          console.log(response);
          vm.Loading=false;
        }).catch(function(error)
        {
          console.log(error);
          vm.Loading=false;
        });
      }
    },
  }
</script>
