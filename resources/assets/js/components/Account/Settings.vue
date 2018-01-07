<template lang="html">
  <div class="account-settings-container">
    <h5>Your account info</h5>
    <div class="account-box-current z-depth-1">
      <div class="account-data-box white">
        <div class="account-header">Name</div>
        <div class="grey-text text-darken-1 account-content">{{user.name}}</div>
        <div><i class="material-icons grey-text text-darken-1">edit</i></div>
      </div>
      <div class="divider">
      </div>
      <div class="account-data-box white">
        <div class="account-header">Email</div>
        <div class="grey-text text-darken-1 account-content">{{user.email}}</div>
        <div><i class="material-icons grey-text text-darken-1">edit</i></div>
      </div>
      <div class="divider">
      </div>
      <div class="account-data-box white">
        <div class="account-header">Username</div>
        <div class="grey-text text-darken-1 account-content">{{user.username}}</div>
        <div><i class="material-icons grey-text text-darken-1">edit</i></div>
      </div>
      <div class="divider">
      </div>
      <div class="account-data-box white">
        <div class="account-header">Password</div>
        <div class="grey-text text-darken-1 account-content"><i class="material-icons">lens</i><i class="material-icons">lens</i><i class="material-icons">lens</i><i class="material-icons">lens</i><i class="material-icons">lens</i><i class="material-icons">lens</i><i class="material-icons">lens</i></div>
        <div><i class="material-icons grey-text text-darken-1">edit</i></div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    // data () { return {} },
    props: ['user'],
    // methods: {},
  }
</script>
