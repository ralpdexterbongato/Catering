<template lang="html">
  <div class="calendar-shed-container">
    <vue-event-calendar  :events="MonthEvents" @month-changed="handleMonthChanged" @day-changed="handleDayChanged">
      <template slot-scope="props">
        <div v-for="(event, index) in MonthEvents">
          <!-- In here do whatever you want, make you owner event template -->
          <div v-if="DayClicked == event.date" class="event-item">
            <div class="event-top-container">
              <p class="chip">
                <img :src="'/storage/images/'+event.user.avatar" alt="Contact Person">
                {{event.user.name}}
              </p>
              <p class="grey-text text-darken-2">{{event.time_start}}</p>
            </div>
            <div class="divider">
            </div>
            <div class="event-bot-container">
              <div class="bot-event-left">
                <i class="material-icons indigo-text">cake</i><p class="bold grey-text text-darken-2"> {{event.title}}</p>
              </div>
              <div class="bot-event-right">
                <a href="#" class="grey-text" v-on:click="fetchDataOfSelected(event)" onclick="$('#detail-event-modal').modal('open');"><i class="material-icons">remove_red_eye</i></a>
              </div>
            </div>
          </div>
          <div v-if="DayClicked==''" class="event-item">
            <div class="event-top-container">
              <p class="chip">
                <img :src="'/storage/images/'+event.user.avatar" alt="Contact Person">
                {{event.user.name}}
              </p>
              <p class="grey-text text-darken-2">{{event.time_start}}</p>
            </div>
            <div class="divider">
            </div>
            <div class="event-bot-container">
              <div class="bot-event-left">
                <i class="material-icons indigo-text">cake</i><p class="bold grey-text text-darken-2"> {{event.title}}</p>
              </div>
              <div class="bot-event-right">
                <a class="grey-text" v-on:click="fetchDataOfSelected(event)" onclick="$('#detail-event-modal').modal('open');"><i class="material-icons">remove_red_eye</i></a>
              </div>
            </div>
          </div>
        </div>
      </template>
    </vue-event-calendar>
    <div id="detail-event-modal" class="modal modal-fixed-footer">
       <div class="modal-content">
         <h5>{{DataPreview.title}}</h5>
         <table>
           <thead>
             <tr>
               <th>{{DataPreview.date}}</th>
               <th>{{DataPreview.time_start}}</th>
             </tr>
           </thead>
           <tbody>
             <tr>
               <th><i class="material-icons">person</i></th>
               <td>{{DataPreview.expectedVisitors}}</td>
             </tr>
             <tr>
               <th><i class="material-icons">phone</i></th>
               <td>
                 {{DataPreview.client_contact}}
               </td>
             </tr>
             <tr>
               <th><i class="material-icons">mail</i></th>
               <td>{{DataPreview.message}}</td>
             </tr>
             <tr>
               <th><i class="material-icons">color_lens</i></th>
               <td>
                 <p class="color-preview z-depth-1" :style="'background-color:'+color.hex" v-for="color in DataPreview.colors">
                 </p>
               </td>
             </tr>
             <tr>
               <th><i class="material-icons">restaurant</i></th>
               <td>
                 <div class="small-product-previewer">
                   <div class="small-product-box z-depth-2" v-for="food in DataPreview.foods">
                     <img :src="'/storage/images/'+food.image" alt="productpic">
                     <p class="bold">{{food.name}}</p>
                   </div>
                 </div>
               </td>
             </tr>
             <tr>
               <th><i class="material-icons">local_drink</i></th>
               <td>
                 <div class="small-product-previewer">
                   <div class="small-product-box z-depth-2" v-for="drink in DataPreview.drinks">
                     <img :src="'/storage/images/'+drink.image" alt="productpic">
                     <p class="bold">{{drink.name}}</p>
                   </div>
                 </div>
               </td>
             </tr>
             <tr>
               <th><i class="material-icons">location_on</i></th>
               <td>
                 <div id="location-small-prev">

                 </div>
               </td>
             </tr>
           </tbody>
         </table>
       </div>
       <div class="modal-footer">
         <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Close</a>
       </div>
     </div>
  </div>
</template>

<script>
import 'vue-event-calendar/dist/style.css' //^1.1.10, CSS has been extracted as one file, so you can easily update it.
import vueEventCalendar from 'vue-event-calendar'
import axios from 'axios'
Vue.use(vueEventCalendar, {locale: 'en',color: '#3f51b5'})
  export default {
    data () { return {
      MonthEvents:[],
      DayClicked:'',
      DataPreview:[]
      }
    },
    created()
    {
      this.getEventByMonth();
    },
    props: [],
    methods: {
      handleDayChanged (data) {
      console.log('date-changed', data)
        if (data.events[0]!=null)
        {
          this.DayClicked=data.events[0].date;
        }
      },
      handleMonthChanged (data) {
        var vm=this;
        axios.get(`/calendar-show-monthly-changed?month=`+data).then(function(response)
        {
          console.log(response);
          vm.MonthEvents = response.data;
          vm.DayClicked='';
        });
      },
      getEventByMonth()
      {
        var vm=this;
        axios.get(`/calendar-show-monthly`).then(function(response)
        {
          console.log(response);
          vm.MonthEvents = response.data;
        })
      },
      fetchDataOfSelected(data)
      {
        this.DataPreview = data;
        var mymap = new GMaps({
           el: '#location-small-prev',
           lat: data.address_lat,
           lng: data.address_lng,
           zoom:15
         });
         mymap.addMarker({
           lat: data.address_lat,
           lng: data.address_lng,
           title: 'Will be held here'
          });
      }

    },
  }
</script>
