<template lang="html">
  <div class="request-form-container">
    <div class="session-food-table">
      <table class="striped responsive-table">
        <thead>
          <th>Selected foods</th>
        </thead>
        <tbody>
          <tr v-for="food in customfoods">
            <td><img :src="'/storage/images/'+food.foodImage" alt="image"></td>
            <td>{{food.foodName}}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="proceed-forms">
      <div class="proceed-form-left">
        <div class="input-field col s6">
            <i class="material-icons prefix">people</i>
            <input id="icon_prefix" placeholder="visitor" v-model="VisitorForm" type="number" step="1" min="1" class="validate">
            <label for="icon_prefix">Expected number of visitors</label>
        </div>
        <div class="input-field col s6">
            <i class="material-icons prefix">date_range</i>
            <input type="text" placeholder="date" id="dateStart" class="datepicker">
            <label>Eating date</label>
        </div>
        <div class="input-field col s6">
            <i class="material-icons prefix">access_time</i>
            <input type="text" placeholder="time" id="timeStart" class="timepicker">
            <label>Eating time</label>
        </div>
        <div class="input-field col s6">
            <i class="material-icons prefix">event</i>
            <input type="text" v-model="EventForm" placeholder="event">
            <label>What?</label>
        </div>
        <div class="input-field col s6">
            <i class="material-icons prefix">contact_phone</i>
            <input type="text" v-model="ContactForm" placeholder="number">
            <label>Contact</label>
        </div>
        <div class="input-field col s6">
          <i class="material-icons prefix">mode_edit</i>
          <textarea id="icon_prefix2" v-model="messageForm" class="materialize-textarea" data-length="191"></textarea>
          <label for="icon_prefix2">Any message?</label>
        </div>
        <span class="hide">
          <input type="text" id="addressHeldLat" value="">
          <input type="text" id="addressHeldLng" value="">
        </span>
        <p class="theme-pick-label">Please pick your theme color</p>
        <form action="#" class="color-menu-container">
          <div class="color z-depth-2" v-for="(color,index) in colors">
            <input type="checkbox" v-model="colorSelected" :value="color.id" :id="'color'+color.id"/>
            <label :for="'color'+color.id"></label>
            <h6 :style="'background-color:'+color.hex"></h6>
          </div>
        </form>
      </div>
      <div class="proceed-form-right">
        <div class="held-place-note">
          <i class="material-icons blue-text">info</i>
          <p>Please drag the marker where do you want the catering to be held. it was marked on our restaurant by default</p>
        </div>
        <div id="customer-location">
        </div>
      </div>
    </div>
    <div class="submit-btn-container">
      <a href="#" class="btn red" v-on:click.prevent="sendRequest()">Send request <i class="material-icons">send</i></a>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
  export default {
    data () { return {
      VisitorForm:1,
      EventForm:'',
      ContactForm:'',
      colorSelected:[],
      messageForm:''
      }
    },
    props: ['customfoods','colors','company'],
    methods: {
      sendRequest()
      {
        var vm=this;
        axios.post(`/request-proceed-send/`+this.company.id,{
          visitor:this.VisitorForm,
          eventName:this.EventForm,
          contact:this.ContactForm,
          lat:$('#addressHeldLat').val(),
          lng:$('#addressHeldLng').val(),
          colors:this.colorSelected,
          message:this.messageForm,
          dateStart:$('#dateStart').val(),
          timeStart:$('#timeStart').val()
        }).then(function(response)
        {
          console.log(response);
          swal({
              position: 'top-right',
              type: 'success',
              title: 'Request sent!',
              showConfirmButton:true
            });
          window.location.href = response.data.redirect;
        }).catch(function(error)
        {
          swal({
              position: 'top-right',
              type: 'error',
              title: error.response.data.message,
              showConfirmButton:true
            });
          console.log(error);
        });
      }
    }
  }
</script>
