<template lang="html">
<div class="register-vue-container">
  <div class="register-form" id="app">
    <registercustomer></registercustomer>
  </div>
  <div class="register-logo">
    <h1><embed src="/DesignPic/mylogo.svg"></h1>
    <h5>Give your business a website</h5>
    <h4>It's for free! <a href="#" class="withfont">Join</a> now.</h4>
  </div>
</div>
</template>
<script>
  Vue.component('registercustomer', require('./RegisterCustomer.vue'));
  export default({
    data () {
      return {

      }
    },
    props: [],
    methods: {},
  })
</script>
<style lang="css">
.register-vue-container
{
  display: flex;
  height:100vh;
}
.register-form
{
  flex:1;
  border-radius: 4px;
  background: #fff;
}
.register-logo
{
  flex:1;
  background: #fff;
  display: flex;
  flex-direction: column;
  padding:30px;
}
.register-logo h5
{
  font-size: 19px;
  text-align: center;
}
.register-logo h4
{
  text-align: center;
}
.register-logo h1
{
  margin:0 auto;
  max-width:300px;
}
.register-logo h1 embed
{
  width: 100%;
}
</style>
