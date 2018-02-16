<template lang="html">
  <div class="account-settings-container">
    <h5>Your account info</h5>
    <div class="account-box-current z-depth-1">
      <div class="account-data-box white">
        <div class="account-header">Picture</div>
        <div class="grey-text text-darken-1 account-content"><img :src="'/storage/images/'+currentUserData.avatar" alt="avatar" v-if="currentUserData.avatar!=null"></div>
        <div onclick="$('#editmodalform').modal('open')" v-on:click.prevent="ImageIsActive=true,EmailIsActive=false,PasswordIsActive=false,NameIsActive=false,UserNameIsActive=false" ><i class="material-icons grey-text text-darken-1">edit</i></div>
      </div>
      <div class="divider">
      </div>
      <div class="account-data-box white">
        <div class="account-header">Name</div>
        <div class="grey-text text-darken-1 account-content">{{currentUserData.name}}</div>
        <div onclick="$('#editmodalform').modal('open')" v-on:click.prevent="ImageIsActive=false,EmailIsActive=false,PasswordIsActive=false,NameIsActive=true,UserNameIsActive=false"><i class="material-icons grey-text text-darken-1">edit</i></div>
      </div>
      <div class="divider">
      </div>
      <div class="account-data-box white">
        <div class="account-header">Email</div>
        <div class="grey-text text-darken-1 account-content">{{currentUserData.email}}</div>
        <div onclick="$('#editmodalform').modal('open')"v-on:click.prevent="ImageIsActive=false,EmailIsActive=true,PasswordIsActive=false,UserNameIsActive=false,NameIsActive=false"><i class="material-icons grey-text text-darken-1">edit</i></div>
      </div>
      <div class="divider">
      </div>
      <div class="account-data-box white">
        <div class="account-header">Username</div>
        <div class="grey-text text-darken-1 account-content">{{currentUserData.username}}</div>
        <div onclick="$('#editmodalform').modal('open')" v-on:click.prevent="ImageIsActive=false,EmailIsActive=false,PasswordIsActive=false,UserNameIsActive=true,NameIsActive=false"><i class="material-icons grey-text text-darken-1">edit</i></div>
      </div>
      <div class="divider">
      </div>
      <div class="account-data-box white">
        <div class="account-header">Password</div>
        <div class="grey-text text-darken-1 account-content"><i class="material-icons">lens</i><i class="material-icons">lens</i><i class="material-icons">lens</i><i class="material-icons">lens</i><i class="material-icons">lens</i><i class="material-icons">lens</i><i class="material-icons">lens</i></div>
        <div onclick="$('#editmodalform').modal('open')" v-on:click.prevent="ImageIsActive=false,EmailIsActive=false,PasswordIsActive=true,UserNameIsActive=false,NameIsActive=false"><i class="material-icons grey-text text-darken-1">edit</i></div>
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
    <div class="avatar-update-modal" v-if="ImageIsActive==true">
    <img :src="'/storage/images/'+currentUserData.avatar" v-if="imgDataUrl==''">
    <img :src="imgDataUrl" v-else>
    <button type="button"@click="toggleShow" class="find-image-btn" name="button">choose</button>
    <my-upload field="img"
        @crop-success="cropSuccess"
        @crop-upload-success="cropUploadSuccess"
        @crop-upload-fail="cropUploadFail"
        v-model="show"
        langType="En"
        :width="300"
        :height="300"
        :params="params"
        :headers="headers"
        :noCircle="true"
        :noSquare="true"
        img-format="png">
    </my-upload>
    </div>
     </div>
     <div class="modal-footer">
       <a v-if="NameIsActive==true" href="#" class="modal-action  waves-effect waves-green btn-flat " v-on:click.prevent="updateName()">Update</a>
       <a v-if="UserNameIsActive==true" href="#" class="modal-action  waves-effect waves-green btn-flat " v-on:click.prevent="updateUserName()">Update</a>
       <a v-if="PasswordIsActive==true" href="#" class="modal-action  waves-effect waves-green btn-flat " v-on:click.prevent="updateUserPass()">Update</a>
       <a v-if="EmailIsActive==true" href="#" class="modal-action  waves-effect waves-green btn-flat " v-on:click.prevent="updateEmail()">Update</a>
       <a v-if="ImageIsActive==true" href="#" class="modal-action  waves-effect waves-green btn-flat " v-on:click.prevent="updateImage()">Update</a>
     </div>
   </div>
  </div>
</template>

<script>
import myUpload from 'vue-image-crop-upload';
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
        ImageIsActive:false,
        show: false,
              params: {
                  token: '123456798',
                  name: 'avatar'
              },
              headers: {
                  smail: '*_~'
              },
              imgDataUrl: '',
      }
    },
    components: {
              'my-upload': myUpload
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
      updateImage()
      {
        var vm = this;
        axios.put(`/update-avatar`,{
          avatar:this.imgDataUrl
        }).then(function(response)
        {
          console.log(response);
          vm.currentUser();
          Materialize.toast('Avatar updated',4000);
          vm.imgDataUrl='';
        }).catch(function(error)
        {
          console.log(error);
          Materialize.toast(error.response.data.errors.avatar[0],4000);
        });
      },
      updateName()
      {
        var vm=this;
        axios.put(`/update-name`,{
          newName:this.NewName
        }).then(function(response)
        {
          console.log(response);
          vm.currentUser();
          Materialize.toast('Updated successfully', 4000)
        }).catch(function(error)
        {
          console.log(error);
          Materialize.toast(error.response.data.errors.newName[0], 4000)
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
        Materialize.toast('Username updated', 4000)
        vm.currentUser();
        }).catch(function(error)
        {
          console.log(error);
          Materialize.toast(error.response.data.errors.username[0], 4000)
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
            Materialize.toast(response.data.error, 4000)
          }else
          {
            console.log(response);
            vm.currentUser();
            Materialize.toast('Email updated');
            window.location.href = window.location.href;
          }
        }).catch(function(error)
        {
          console.log(error);
          if (error.response.data.errors.email!=null)
          {
            Materialize.toast(error.response.data.errors.email[0], 4000);
          }
          if (error.response.data.errors.emailConfirm!=null)
          {
            Materialize.toast(error.response.data.errors.emailConfirm[0], 4000);
          }

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
            Materialize.toast(response.data.error, 4000);
          }else
          {
            vm.currentUser();
            Materialize.toast("Password updated", 4000);
          }
        }).catch(function(error)
        {
          console.log(error);
          if (error.response.data.errors.password!=null)
          {
            Materialize.toast(error.response.data.errors.password[0], 4000);
          }
          if (error.response.data.errors.current!=null)
          {
            Materialize.toast(error.response.data.errors.current[0], 4000);
          }

        });
      },
      toggleShow() {
                this.show = !this.show;
            },
            /**
             * crop success
             *
             * [param] imgDataUrl
             * [param] field
             */
            cropSuccess(imgDataUrl, field){
                console.log('-------- crop success --------');
                this.imgDataUrl = imgDataUrl;
            },
            /**
             * upload success
             *
             * [param] jsonData  server api return data, already json encode
             * [param] field
             */
            cropUploadSuccess(jsonData, field){
                console.log('-------- upload success --------');
                console.log(jsonData);
                console.log('field: ' + field);
            },
            /**
             * upload fail
             *
             * [param] status    server api return error status, like 500
             * [param] field
             */
            cropUploadFail(status, field){
                console.log('-------- upload fail --------');
                console.log(status);
                console.log('field: ' + field);
            }
    },
  }
</script>
