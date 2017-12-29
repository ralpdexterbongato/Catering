<template lang="html">
  <div class="accept-decline-container">
    <div class="request-container">
      <div class="request-left">
        <ul class="collection">
          <li class="collection-item avatar" v-for="masterdata in requestMasters" v-on:click.prevent="fetchDataofRequest(masterdata.id)">
            <img class="circle" :src="'/storage/images/'+masterdata.user.avatar" alt="avatar">
            <span class="title">{{masterdata.user.name}}</span>
            <p>{{masterdata.client_contact}} <br>{{masterdata.created_at}}</p>
            <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
          </li>
        </ul>
      </div>
      <div class="req-data-container" v-if="requestDetail!=null">
        <table class="responsive-table">
          <thead>
            <tr>
              <th>Request data</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Event</td>
              <td>{{requestDetail.event_name}}</td>
            </tr>
            <tr>
              <td>Expected visitors</td>
              <td>{{requestDetail.expectedVisitors}}</td>
            </tr>
            <tr>
              <td>Message</td>
              <td><p>{{requestDetail.message}}</p></td>
            </tr>
            <tr>
              <td>Date Start</td>
              <td>{{requestDetail.date_start}}</td>
            </tr>
            <tr>
              <td>Time Start</td>
              <td>{{requestDetail.time_start}}</td>
            </tr>
            <tr>
              <td>Location</td>
              <td>map here</td>
            </tr>
          </tbody>
        </table>
        <div class="request-buttons">
          <a href="#" class="btn blue">Accept</a>
          <a href="#" class="btn white red-text">Decline</a>
        </div>
      </div>
    </div>
    <div class="scheduled-calendar-container">

    </div>
  </div>
</template>

<script>
import axios from 'axios';
  export default {
    data () {
      return {
        requestMasters:[],
        requestDetail:[],
        colorDetail:[],
        foodsDetail:[]
      }
    },
    // props: [],
    created()
    {
      this.fetchRequest();
    },
    methods:
    {
      fetchRequest()
      {
        var vm=this;
        axios.get(`/show-cater-request-users`).then(function(response)
        {
          console.log(response);
          vm.requestMasters=response.data.data;
        }).catch(function(error)
        {
          console.log(error);
        })
      },
      fetchDataofRequest(id)
      {
        var vm=this;
        axios.get(`/show-cater-request-data/`+id).then(function(response)
        {
          console.log(response);
          vm.requestDetail=response.data[0];
          vm.colorDetail= response.data.colors;
          vm.foodsDetail= response.data.foods;
        }).catch(function(error)
        {
          console.log(error);
        })
      }
    },
  }
</script>
