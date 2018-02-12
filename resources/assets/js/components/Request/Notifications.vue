<template lang="html">
  <li class="notif-parent noselect" :class="{'clicked':isActive}" v-on:click="notifsNumber=null,isActive=!isActive,[Loaded==false?fetchNotif():'']">
    <i class="material-icons">notifications</i>
    <div class="notif-count-circle" v-if="notifsNumber!=null && notifsNumber!=0">
      {{notifsNumber}}
    </div>
    <div v-on:click="isActive=!isActive" class="dropdown-notif z-depth-3" :class="{'active':isActive}">
      <p class="bold grey-text text-darken-2">Notifications</p>
      <div class="notification-content">
        <div class="divider">
        </div>
        <div class="notification-content-container">
          <span v-for="data in NotifData" v-if="user.role==0">
            <a href="/calendar-show">
              <div class="notification-box" :class="[data.Notification_Read==null?'unread':'']">
                <img :src="'/storage/images/'+data.company.logo" class="circle" alt="">
                <div class="notfication-box-data">
                  <p class="grey-text text-darken-2"><span class="bold">{{data.company.name}}</span>
                    <span v-if="data.status == 0">
                      Accepted
                    </span>
                    <span v-else-if="data.status == 1">
                      Declined
                    </span>
                    your catering request</p>
                  <p class="grey-text text-darken-1">
                    <span v-if="data.status == 0">
                    <i class="material-icons green-text">check_circle</i>
                    </span>
                    <span v-else-if="data.status == 1">
                    <i class="material-icons red-text">cancel</i>
                    </span>
                    {{data.notification_time}}</p>
                </div>
              </div>
              <div class="divider">
              </div>
            </a>
          </span>
          <span v-for="data in NotifData" v-if="user.role==1">
            <a href="/show-cater-request">
              <div class="notification-box">
                <img :src="'/storage/images/'+data.user.avatar" class="circle" alt="">
                <div class="notfication-box-data">
                  <p class="grey-text text-darken-2"><span class="bold">{{data.user.name}}</span>
                    Sent you a catering request</p>
                  <p class="grey-text text-darken-1">
                  <i class="material-icons indigo-text">message</i>
                    {{data.created_at}}</p>
                </div>
              </div>
            </a>
            <div class="divider">
            </div>
          </span>
          <div v-on:click="fetchNotif()" class="notification-box" v-if="NotifPaginate.current_page!=NotifPaginate.last_page">
            <div class="load-more-notif">
              <i class="material-icons grey-text text-darken-2">arrow_downward</i> <p class="grey-text text-darken-2">Load more</p>
            </div>
          </div>
          <div v-else-if="NotifData[0]==null" class="grey-text text-darken-2 empty-notifs">
            <p>No notifications found</p>
          </div>
        </div>
        <div class="see-all-notif"></div>
      </div>
    </div>
  </li>
</template>
<script>
import axios from 'axios';
  export default {
    data () { return {
        isActive:false,
        NotifData:[],
        NotifPaginate:[],
        notifsNumber:null,
        currentPage:1,
        Loaded:false
      }
    },
    props: ['user'],
    methods: {
      fetchNotif()
      {
        if (this.Loaded==true)
        {
          this.currentPage =this.currentPage+1;
        }
        var vm=this;
        axios.get(`/notification?page=`+this.currentPage).then(function(response)
        {
          console.log(response);
          vm.NotifPaginate=response.data;
          vm.Loaded = true;
          if (vm.NotifData==null)
          {
            vm.NotifData=response.data.data;
          }else
          {
            var total=response.data.data.length;
            for (var x = 0; x < total; x++)
            {
              vm.NotifData.push(response.data.data[x]);
            }
          }
        }).catch(function(error)
        {
          console.log(error);
        });
      },
      notifCount()
      {
        var vm=this;
        axios.get(`/notification-count`).then(function(response)
        {
          console.log(response);
          vm.notifsNumber=response.data;
        }).catch(function(error)
        {
          console.log(error);
        });
      }
    },
    created () {
      this.notifCount();
    },
  }
</script>
