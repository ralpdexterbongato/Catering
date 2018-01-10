<template lang="html">
  <div class="account-settings-container">
    <h5>Your account info</h5>
    <div class="account-box-current z-depth-1">
      <div class="account-data-box white">
        <div class="account-header">Name</div>
        <div class="grey-text text-darken-1 account-content">{{currentUserData.name}}</div>
        <div onclick="$('#editmodalform').modal('open')" v-on:click.prevent="EmailIsActive=false,PasswordIsActive=false,NameIsActive=true,UserNameIsActive=false"><i class="material-icons grey-text text-darken-1">edit</i></div>
      </div>
      <div class="divider">
      </div>
      <div class="account-data-box white">
        <div class="account-header">Email</div>
        <div class="grey-text text-darken-1 account-content">{{currentUserData.email}}</div>
        <div onclick="$('#editmodalform').modal('open')"v-on:click.prevent="EmailIsActive=true,PasswordIsActive=false,UserNameIsActive=false,NameIsActive=false"><i class="material-icons grey-text text-darken-1">edit</i></div>
      </div>
      <div class="divider">
      </div>
      <div class="account-data-box white">
        <div class="account-header">Username</div>
        <div class="grey-text text-darken-1 account-content">{{currentUserData.username}}</div>
        <div onclick="$('#editmodalform').modal('open')" v-on:click.prevent="EmailIsActive=false,PasswordIsActive=false,UserNameIsActive=true,NameIsActive=false"><i class="material-icons grey-text text-darken-1">edit</i></div>
      </div>
      <div class="divider">
      </div>
      <div class="account-data-box white">
        <div class="account-header">Password</div>
        <div class="grey-text text-darken-1 account-content"><i class="material-icons">lens</i><i class="material-icons">lens</i><i class="material-icons">lens</i><i class="material-icons">lens</i><i class="material-icons">lens</i><i class="material-icons">lens</i><i class="material-icons">lens</i></div>
        <div onclick="$('#editmodalform').modal('open')" v-on:click.prevent="EmailIsActive=false,PasswordIsActive=true,UserNameIsActive=false,NameIsActive=false"><i class="material-icons grey-text text-darken-1">edit</i></div>
      </div>
    </div>
    <div id="editmodalform" class="modal modal-fixed-footer">
     <div class="modal-content">
       <div class="row" v-if="NameIsActive">
        <div class="input-field col s12">
          <input type="text" v-model="NewName">
          <label class="active">Name</label>
        </div>
      </div>
       <div class="row" v-if="UserNameIsActive">
        <div class="input-field col s12">
          <input type="text" v-model="NewUserName">
          <label class="active">Username</label>
        </div>
      </div>
      <div class="row" v-if="PasswordIsActive">
       <div class="input-field col s12">
         <input type="password" v-model="CurrentPass">
         <label class="active">Current password</label>
       </div>
       <div class="input-field col s12">
         <input type="password" v-model="NewPass">
         <label class="active">New password</label>
       </div>
       <div class="input-field col s12">
         <input type="password" v-model="ConfirmPass">
         <label class="active">Confirm password</label>
       </div>
     </div>
     <div class="row" v-if="EmailIsActive">
      <div class="input-field col s12">
        <input type="email" v-model="NewEmail">
        <label class="active">New email</label>
      </div>
      <div class="input-field col s12">
        <input type="email" v-model="NewEmailConfirm">
        <label class="active">Retype email</label>
      </div>
    </div>
     </div>
     <div class="modal-footer">
       <a v-if="NameIsActive==true" href="" class="modal-action modal-close waves-effect waves-green btn-flat " v-on:click.prevent="updateName()">Update</a>
       <a v-if="UserNameIsActive==true" href="" class="modal-action modal-close waves-effect waves-green btn-flat " v-on:click.prevent="updateUserName()">Update</a>
       <a v-if="PasswordIsActive==true" href="" class="modal-action modal-close waves-effect waves-green btn-flat " v-on:click.prevent="updateUserPass()">Update</a>
       <a v-if="EmailIsActive==true" href="" class="modal-action modal-close waves-effect waves-green btn-flat " v-on:click.prevent="updateEmail()">Update</a>
     </div>
   </div>
  </div>
</template>

<script>
  export default {
    data () { return {
        currentUserData:[],
        NewName:'',
        NewUserName:'',
        NewEmail:'',
        NewEmailConfirm:'',
        CurrentPass:'',
        NewPass:'',
        ConfirmPass:'',
        OldPassword:'',
        NameIsActive:false,
        UserNameIsActive:false,
        EmailIsActive:false,
        PasswordIsActive:false,
      }
    },
    created()
    {
      this.currentUser();
    },
    props: [],
    methods: {
      currentUser()
      {
        var vm=this;
        axios.get(`/current-user`).then(function(response){
          vm.currentUserData = response.data;
        })
      },
      updateName()
      {
        var vm=this;
        axios.put(`/update-name`,{
          newname:this.NewName
        }).then(function(response)
        {
          console.log(response);
          vm.currentUser();
          swal({
              position: 'center',
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
              position: 'center',
              type: 'error',
              title: 'Oops!',
              text:error.response.data.message,
              showConfirmButton: false,
              timer: 1500
            });
        })
      },
      updateUserName()
      {
        var vm=this;
        axios.put(`/update-user-name`,{
          username:this.NewUserName
        }).then(function(response)
        {
          console.log(response);
          vm.currentUser();
          swal({
              position: 'center',
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
              position: 'center',
              type: 'error',
              title: 'Oops!',
              text:error.response.data.message,
              showConfirmButton: false,
              timer: 1500
            });
        })
      },
      updateEmail()
      {
        var vm=this;
        axios.put(`/update-email`,{
          email:this.NewEmail,
          emailConfirm:this.NewEmailConfirm,
        }).then(function(response)
        {
          if (response.data.error!=null)
          {
            swal({
                position: 'center',
                type: 'error',
                title: 'Oops!',
                text:response.data.error,
                showConfirmButton: false,
                timer: 1500
              });
          }else
          {
            console.log(response);
            vm.currentUser();
            swal({
                position: 'center',
                type: 'success',
                title: 'Success',
                text:'Updated successfully',
                showConfirmButton: false,
                timer: 1500
              });
            window.location.href = window.location.href;
          }
        }).catch(function(error)
        {
          console.log(error);
          swal({
              position: 'center',
              type: 'error',
              title: 'Oops!',
              text:error.response.data.message,
              showConfirmButton: false,
              timer: 1500
            });
        })
      },
      updateUserPass()
      {
        var vm=this;
        axios.put(`/update-user-pass`,{
          password:this.NewPass,
          password_confirmation:this.ConfirmPass,
          current:this.CurrentPass,
        }).then(function(response)
        {
          console.log(response);
          if (response.data.error!=null)
          {
            swal({
                position: 'center',
                type: 'error',
                title: 'Oops',
                text:response.data.error,
                showConfirmButton: false,
                timer: 1500
              });
          }else
          {
            vm.currentUser();
            swal({
                position: 'center',
                type: 'success',
                title: 'Success',
                text:'Updated successfully',
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
              title: 'Oops!',
              text:error.response.data.message,
              showConfirmButton: false,
              timer: 1500
            });
        });
      },
    },
  }
</script>
