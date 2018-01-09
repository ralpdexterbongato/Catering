<template lang="html">
<div class="new-password-recover-container">
  <div class="new-pass-recovered-box z-depth-1">
    <div class="input-field col s6">
      <input id="NewPass" v-model="password" type="password">
      <label for="NewPass">New password</label>
    </div>
    <div class="input-field col s6">
      <input id="ConfirmNew" v-model="password_confirmation" type="password">
      <label for="ConfirmNew">Confirm new password</label>
    </div>
    <a href="#" class="btn save-new-recovered" v-on:click.prevent="saveNewPass()">Save</a>
  </div>
</div>
</template>
<script>
  export default {
    data () { return {
      password:'',
      password_confirmation:''
      }
    },
    props: ['matchuser'],
    methods: {
      saveNewPass()
      {
        axios.put(`/update-password-recovered/`+this.matchuser[0].id,{
          password:this.password,
          password_confirmation:this.password_confirmation,
          code:this.matchuser[0].confirmation_code
        }).then(function(response)
        {
          console.log(response);
          if (response.data.error!=null)
          {
            swal({
                position: 'center',
                type: 'error',
                title: 'Sorry',
                text:response.data.error,
                showConfirmButton: false,
                timer: 1500
              });
          }else
          {
            swal({
                position: 'center',
                type: 'success',
                title: 'Success',
                text:'Successfully updated!',
                showConfirmButton: false,
                timer: 1500
              });
          }
        }).catch(function(error)
        {
          console.log(error);
          swal({
              position: 'center',
              type: 'error',
              title: 'Opps',
              text:error.response.data.message,
              showConfirmButton: false,
              timer: 1500
            });
        })
      }
    },
  }
</script>
