<template lang="html">
  <div class="accept-decline-container">
    <div class="request-container">
      <div class="request-left">
        <ul class="collection" v-if="requestMasters[0]!=null">
          <li class="collection-item avatar" :class="[masterdata.id == requestDetail.id?'active':'']" v-for="(masterdata,index) in requestMasters" v-on:click.prevent="fetchDataofRequest(masterdata.id),CurrentIndex=index">
            <img class="circle" :src="'/storage/images/'+masterdata.user.avatar" alt="avatar">
            <span class="title">{{masterdata.user.name}}</span>
            <p>{{masterdata.client_contact}}<br>{{masterdata.created_at}}</p>
          </li>
          <li class="collection-item avatar" v-on:click="fetchRequest()" v-if="Pagination.current_page!=Pagination.last_page">
            <p><i class="material-icons">arrow_downward</i> Load more...</p>
          </li>
        </ul>
        <div v-else class="no-request-note">
          <p class="grey-text">No request found</p>
        </div>
      </div>
      <div class="req-data-container" v-if="requestDetail!=null">
        <div class="req-data-table" v-if="requestMasters[0]!=null" >
          <table>
            <thead>
              <tr>
                <th>Request data</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th>Event</th>
                <td>{{requestDetail.event_name}}</td>
              </tr>
              <tr>
                <th>Expected visitors</th>
                <td>{{requestDetail.expectedVisitors}}</td>
              </tr>
              <tr>
                <th>Message</th>
                <td><p>{{requestDetail.message}}</p></td>
              </tr>
              <tr>
                <th>Date Start</th>
                <td>{{requestDetail.date_start}}</td>
              </tr>
              <tr>
                <th>Time Start</th>
                <td>{{requestDetail.time_start}}</td>
              </tr>
              <tr>
                <th>Color theme</th>
                <td>
                  <div class="color-preview" v-for="color in colorDetail" :style="'background-color:'+color.hex">
                  </div>
                </td>
              </tr>
              <tr v-if="PackagePrev!=null">
                <th>Package</th>
                <td>{{PackagePrev.name}}</td>
              </tr>
              <tr v-if="PackagePrev!=null">
                <th>Package foods</th>
                <td class="submited-preview-container">
                  <div class="request-preview-box z-depth-1"v-if="product.Type==0" v-for="product in PackageProduct">
                    <img :src="'/storage/images/'+product.image" alt="product">
                    <p>{{product.name}}</p>
                  </div>
                </td>
              </tr>
              <tr v-if="PackagePrev!=null">
                <th>Package drinks</th>
                <td class="submited-preview-container">
                  <div class="request-preview-box z-depth-1"v-if="product.Type==1" v-for="product in PackageProduct">
                    <img :src="'/storage/images/'+product.image" alt="product">
                    <p>{{product.name}}</p>
                  </div>
                </td>
              </tr>
              <tr v-if="PackagePrev!=null">
                <th>Package sweets</th>
                <td class="submited-preview-container">
                  <div class="request-preview-box z-depth-1"v-if="product.Type==2" v-for="product in PackageProduct">
                    <img :src="'/storage/images/'+product.image" alt="product">
                    <p>{{product.name}}</p>
                  </div>
                </td>
              </tr>
              <tr v-if="ProductDetail[0]!=null">
                <th>Foods</th>
                <td class="submited-preview-container">
                  <div class="request-preview-box z-depth-1"v-if="product.Type==0" v-for="product in ProductDetail">
                    <img :src="'/storage/images/'+product.image" alt="product">
                    <p>{{product.name}}</p>
                  </div>
                </td>
              </tr>
              <tr v-if="ProductDetail[0]!=null">
                <th>Drinks</th>
                <td class="submited-preview-container">
                  <div class="request-preview-box z-depth-1"v-if="product.Type==1" v-for="product in ProductDetail">
                    <img :src="'/storage/images/'+product.image" alt="product">
                    <p>{{product.name}}</p>
                  </div>
                </td>
              </tr>
              <tr v-if="ProductDetail[0]!=null">
                <th>Sweets</th>
                <td class="submited-preview-container">
                  <div class="request-preview-box z-depth-1"v-if="product.Type==2" v-for="product in ProductDetail">
                    <img :src="'/storage/images/'+product.image" alt="product">
                    <p>{{product.name}}</p>
                  </div>
                </td>
              </tr>
              <tr>
                <th>Location</th>
                <td>
                  <div id="location-show">
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="no-request-table" v-else>
          <p class="grey-text"><i class="material-icons">info</i> Dont worry! we will notify you once someone sent a request through email</p>
        </div>
        <div class="divider">
        </div>
        <p class="ExistingSchedTitle">Scheduled cater on the same date</p>
        <ul class="collapsible" data-collapsible="accordion">
          <li v-for="order in  SameDayOrders">
            <div class="collapsible-header event-and-time" v-on:click="displayExistingMap(order.address_lat,order.address_lng)">
              <p class="grey-text text-darken-2">
                <i class="material-icons grey-text text-darken-2">restaurant</i>
                {{order.event_name}}
              </p>
              <p class="grey-text text-darken-2">
                <i class="material-icons grey-text text-darken-2">access_time</i>
                {{order.time_start}}
              </p>
              <p class="grey-text text-darken-2">
                <i class="material-icons grey-text text-darken-2">person</i>
                {{order.user.name}}
              </p>
              <p class="grey-text text-darken-2">
                <i class="material-icons grey-text text-darken-2">location_on</i>
                <span onclick="$('#MapModal').modal('open');" v-on:click="displayExistingMap(order.address_lat,order.address_lng)">Location</span>
              </p>
            </div>
            <div class="collapsible-body">
              <p class="grey-text text-darken-2 message-prev-exist">{{order.message}}</p>
            </div>
            <li v-if="SameDayOrders[0]==null" class="no-existing-cater-info grey-text text-darken-2">No catering request on thesame date</li>
          </li>
        </ul>
        <div class="request-buttons" v-if="requestMasters[0]!=null">
          <a href="#" class="btn indigo" v-on:click.prevent="accept()">Accept</a>
          <a href="#" class="btn white red-text" v-on:click.prevent="decline()">Decline</a>
        </div>
      </div>
    </div>
    <div class="scheduled-calendar-container">
    </div>
    <div id="MapModal" class="modal modal-fixed-footer">
      <div class="modal-content">
        <h4>Map location</h4>
        <div id="existing-order-location">

        </div>
      </div>
      <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">OK</a>
      </div>
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
        ProductDetail:[],
        CurrentIndex:0,
        SameDayOrders:[],
        PackagePrev:[],
        PackageProduct:[],
        currentPage:1,
        Pagination:[]
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
        if (this.requestMasters[0]!=null)
        {
          this.currentPage =this.currentPage+1;
        }
        var vm=this;
        axios.get(`/show-cater-request-users?page=`+this.currentPage).then(function(response)
        {
          console.log(response);
          vm.Pagination = response.data;
          if (vm.requestMasters[0]==null)
          {
            vm.requestMasters=response.data.data;
            vm.fetchDataofRequest(vm.requestMasters[0].id);
          }else
          {
            var total=response.data.data.length;
            for (var x = 0; x < total; x++)
            {
              vm.requestMasters.push(response.data.data[x]);
            }

          }
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
          vm.requestDetail=response.data.OrderData[0];
          vm.colorDetail= response.data.OrderData[0].colors;
          vm.ProductDetail= response.data.OrderData[0].products;
          vm.SameDayOrders= response.data.existing;
          vm.PackagePrev=response.data.PackageData[0];
          vm.PackageProduct=response.data.PackageData[0].products;
          var mymap = new GMaps({
             el: '#location-show',
             lat: vm.requestDetail.address_lat,
             lng: vm.requestDetail.address_lng,
             zoom:15
           });
           mymap.addMarker({
             lat: vm.requestDetail.address_lat,
             lng: vm.requestDetail.address_lng,
             title: 'I want it here'
            });
        }).catch(function(error)
        {
          console.log(error);
        });
      },
      displayExistingMap(adlat,adlng)
      {
        var mymap = new GMaps({
           el: '#existing-order-location',
           lat: adlat,
           lng: adlng,
           zoom:15
         });
         mymap.addMarker({
           lat:adlat,
           lng:adlng,
           title: 'Will be held here'
          });
      },
      accept()
      {
        var vm=this;
        axios.post(`/accept-request/`+this.requestDetail.id).then(function(response)
        {
          console.log(response);
          swal({
              position: 'top-right',
              type: 'success',
              title: 'Request accepted!',
              showConfirmButton:true
            });
          vm.requestMasters.splice(vm.CurrentIndex, 1);
          if (vm.requestMasters[0]!=null)
          {
            vm.fetchDataofRequest(vm.requestMasters[0].id);
          }else
          {
            vm.SameDayOrders=[];
          }
        }).catch(function(error)
        {
          console.log(error);
          swal({
              position: 'top-right',
              type: 'error',
              title: error.response.data.message,
              showConfirmButton:true
            });
        });
      },
      decline()
      {
        var vm=this;
        axios.post(`/decline-request/`+this.requestDetail.id).then(function(response)
        {
          console.log(response);
          swal({
              position: 'top-right',
              type: 'success',
              title: 'Request declined',
              showConfirmButton:true
            });
          vm.requestMasters.splice(vm.CurrentIndex,1);
          if (vm.requestMasters[0]!=null)
          {
            vm.fetchDataofRequest(vm.requestMasters[0].id);
          }else
          {
            vm.SameDayOrders=[];
          }
        }).catch(function(error)
        {
          console.log(error);
          swal({
              position: 'top-right',
              type: 'error',
              title:error.response.data.message,
              showConfirmButton:true
            });
        });
      }
    },
  }
</script>
