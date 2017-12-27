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
            <input type="text" placeholder="date" v-model="DateForm" class="datepicker">
            <label>Eating date</label>
        </div>
        <div class="input-field col s6">
            <i class="material-icons prefix">access_time</i>
            <input type="text" placeholder="time" v-model="TimeForm" class="timepicker">
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
        <span class="hide">
          <input type="text" v-model="LatForm" id="addressHeldLat" value="">
          <input type="text" v-model="LngForm" id="addressHeldLng" value="">
        </span>
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
      <a href="#" class="btn red">Send request <i class="material-icons">send</i></a>
    </div>
  </div>
</template>

<script>
  export default {
    data () { return {
      VisitorForm:0,
      DateForm:'',
      TimeForm:'',
      EventForm:'',
      ContactForm:'',
      LatForm:'',
      LngForm:''
      }
    },
    props: ['customfoods'],
    methods: {

    }
  }
</script>
