<template lang="html">
  <div class="request-form-container">
    <div class="session-product-table">
      <table class="responsive-table" v-if="custompack!=null">
        <thead>
          <tr>
            <th>Selected products</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="food in custompack">
            <td><img :src="'/storage/images/'+food.foodImage" alt="foodimage"></td>
            <td>{{food.foodName}}</td>
            <td>₱{{food.foodPrice}}</td>
          </tr>
          <tr>
            <td><span class="bold">Total perhead: ₱{{total.total}}</span> </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="package-table-proceed" v-if="packagedata!=null">
      <table>
        <thead>
          <tr>
            <th>PACKAGE SELECTED</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{packagedata.name}}</td>
          </tr>
          <tr>
            <td>{{packagedata.description}}</td>
          </tr>
          <tr>
            <td>{{packagedata.price}} per head</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="proceed-forms">
      <div class="proceed-form-left">
        <i class="material-icons" style="font-size:30px;">transfer_within_a_station</i>
          <form action="#" class="dine-options">
            <p>
              <input name="group1" type="radio" v-model="dineSelected" value="0" checked id="test1" />
              <label for="test1">Dine in</label>
            </p>
            <p>
              <input name="group1" type="radio" v-model="dineSelected" value="1" id="test2" />
              <label for="test2">Outside</label>
            </p>
          </form>
        <div class="input-field col s6">
            <i class="material-icons prefix">people</i>
            <input id="icon_prefix" placeholder="visitor" v-model="VisitorForm" type="number" step="1" :max="rules[0].maximum" :min="rules[0].minimum" class="validate">
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
            <label>Event</label>
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
        <form action="#" class="confirm-submit-container">
          <input id="confirm-submit" v-model="confirm" type="checkbox"/>
          <label for="confirm-submit"><p> I have reviewed already my inputs before submition & it looks good.</p></label>
        </form>
      </div>
      <div class="proceed-form-right" :class="[dineSelected==1?'active':'']">
        <div class="held-place-note">
          <i class="material-icons blue-text">info</i>
          <p>Please drag the marker where do you want the catering to be held. it was marked on our restaurant by default</p>
        </div>
        <div id="customer-location">
        </div>
      </div>
    </div>
    <div class="submit-btn-container">
      <a href="#" class="btn red" :class="[confirm?'':'disabled']" v-on:click.prevent="sendRequest()">Send request <i class="material-icons">send</i></a>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
  export default {
    data () { return {
      VisitorForm:0,
      EventForm:'',
      ContactForm:'',
      colorSelected:[],
      messageForm:'',
      confirm:false,
      dineSelected:0,
      }
    },
    props: ['total','custompack','packagedata','colors','company','rules'],
    methods: {
      sendRequest()
      {
        swal({
            text: "Please wait.",
            showConfirmButton: false
        });
        var vm=this;
        axios.post(`/request-proceed-send/`+this.company.id,{
          visitor:this.VisitorForm,
          eventName:this.EventForm,
          contact:this.ContactForm,
          minimum:this.rules[0].minimum,
          maximum:this.rules[0].maximum,
          lat:$('#addressHeldLat').val(),
          lng:$('#addressHeldLng').val(),
          colors:this.colorSelected,
          message:this.messageForm,
          dateStart:$('#dateStart').val(),
          timeStart:$('#timeStart').val(),
          dine:this.dineSelected
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
          swal.close();
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
