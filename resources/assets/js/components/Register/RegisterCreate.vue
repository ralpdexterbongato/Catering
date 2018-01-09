<template lang="html">
<div class="register-vue-container">
  <div class="register-form" id="app" v-if="user==null">
    <div class="choices">
      <a class="btn-floating btn-large waves-effect waves-light red" v-on:click="customerform=true"><i class="material-icons">person</i></a>
      <a class="btn-floating btn-large waves-effect waves-light red" v-on:click="customerform=false"><i class="material-icons">store</i></a>
    </div>
    <registercustomer v-if="customerform"></registercustomer>
    <Loginform v-else></Loginform>
  </div>
  <div class="register-form" v-else>
    <h6><i class="material-icons">business</i> Company registration</h6>
    <registercompany></registercompany>
  </div>
  <div class="register-logo">
    <h1><embed src="/DesignPic/mylogo.svg"></h1>
    <h5>Give your business a website</h5>
    <h4>It's for free! <p class="withfont red-text" v-on:click="customerform=false">Join</p> now.</h4>
  </div>
</div>
</template>
<script>
  Vue.component('registercustomer', require('./RegisterCustomer.vue'));
  Vue.component('registercompany', require('./RegisterCompany.vue'));
  Vue.component('Loginform', require('../Login/UserLogin.vue'));
  export default({
    data () {
      return {
        customerform:true,
      }
    },
    props: ['user'],
    methods: {

    },
  })
</script>
