<template lang="html">
  <div class="CompanyProfileContainer">
      <div id="modal1" class="modal modal-fixed-footer">
       <div class="modal-content">
         <h5>Add food menu</h5>

        <div class="food-form-container">
          <div class="input-field col s6">
            <input id="icon_prefix" type="text" data-length="20">
            <label for="icon_prefix">Name</label>
          </div>
          <div class="input-field col s12">
            <textarea id="textarea1" class="materialize-textarea" data-length="100"></textarea>
            <label for="textarea1">Description</label>
          </div>
          <div class="input-field col s12">
            <select multiple>
              <option value="" disabled selected>Choose</option>
              <option value="1">Option 1</option>
              <option value="2">Option 2</option>
              <option value="3">Option 3</option>
            </select>
            <label>Category</label>
          </div>
          <div class="input-field col s6">
            <input id="icon_prefix" type="number">
            <label for="icon_prefix">Small size price</label>
          </div>
          <div class="input-field col s6">
            <input id="icon_prefix" type="number">
            <label for="icon_prefix">Medium size price</label>
          </div>
          <div class="input-field col s6">
            <input id="icon_prefix" type="number">
            <label for="icon_prefix">Large size price</label>
          </div>
        </div>
       </div>
       <div class="modal-footer">
         <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Cancel</a>
         <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Save</a>
       </div>
      </div>
    <div class="admin-options">
      <div class="fixed-action-btn toolbar">
         <a class="btn-floating btn-large blue">
           <i class="large material-icons">mode_edit</i>
         </a>
         <ul>
           <li class="waves-effect waves-light"><a  href="#modal1"><i class="material-icons">add</i></a></li>
           <li class="waves-effect waves-light"><a href="#!"><i class="material-icons">delete</i></a></li>
           <li class="waves-effect waves-light"><a href="#!"><i class="material-icons">attach_money</i></a></li>
           <li class="waves-effect waves-light"><a href="#!"><i class="material-icons">photo_size_select_actual</i></a></li>
         </ul>
       </div>
    </div>
    <div class="company-cover-hero" style="background-image:linear-gradient(rgba(0, 0, 0, 0.3),rgba(0, 0, 0, 0.4)),url('/DesignPic/food3.jpg')">
      <div class="company-logo">
        <img :src="'/storage/images/'+company[0].logo" alt="logo">
      </div>
      <h2 class="company-name">{{company[0].name}}</h2>
    </div>
    <div class="menu-showcase">
      <div class="showcase-box">
        <div class="card">
           <div class="card-image waves-effect waves-block waves-light">
             <img class="activator" src="/DesignPic/1.jpg">
           </div>
           <div class="card-content">
             <span class="card-title activator grey-text text-darken-4">Card Title<i class="material-icons right">more_vert</i></span>
             <p><a href="#">This is a link</a></p>
           </div>
           <div class="card-reveal">
             <span class="card-title grey-text text-darken-4">Card Title<i class="material-icons right">close</i></span>
             <p>Here is some more information about this product that is only revealed once clicked on.</p>
           </div>
         </div>
      </div>
      <div class="showcase-box">
        <div class="card">
           <div class="card-image waves-effect waves-block waves-light">
             <img class="activator" src="/DesignPic/1.jpg">
           </div>
           <div class="card-content">
             <span class="card-title activator grey-text text-darken-4">Card Title<i class="material-icons right">more_vert</i></span>
             <p><a href="#">This is a link</a></p>
           </div>
           <div class="card-reveal">
             <span class="card-title grey-text text-darken-4">Card Title<i class="material-icons right">close</i></span>
             <p>Here is some more information about this product that is only revealed once clicked on.</p>
           </div>
         </div>
      </div>
      <div class="showcase-box">
        <div class="card">
           <div class="card-image waves-effect waves-block waves-light">
             <img class="activator" src="/DesignPic/1.jpg">
           </div>
           <div class="card-content">
             <span class="card-title activator grey-text text-darken-4">Card Title<i class="material-icons right">more_vert</i></span>
             <p><a href="#">This is a link</a></p>
           </div>
           <div class="card-reveal">
             <span class="card-title grey-text text-darken-4">Card Title<i class="material-icons right">close</i></span>
             <p>Here is some more information about this product that is only revealed once clicked on.</p>
           </div>
         </div>
      </div>
      <div class="showcase-box">
        <div class="card">
           <div class="card-image waves-effect waves-block waves-light">
             <img class="activator" src="/DesignPic/1.jpg">
           </div>
           <div class="card-content">
             <span class="card-title activator grey-text text-darken-4">Card Title<i class="material-icons right">more_vert</i></span>
             <p><a href="#">This is a link</a></p>
           </div>
           <div class="card-reveal">
             <span class="card-title grey-text text-darken-4">Card Title<i class="material-icons right">close</i></span>
             <p>Here is some more information about this product that is only revealed once clicked on.</p>
           </div>
         </div>
      </div>
      <div class="showcase-box">
        <div class="card">
           <div class="card-image waves-effect waves-block waves-light">
             <img class="activator" src="/DesignPic/1.jpg">
           </div>
           <div class="card-content">
             <span class="card-title activator grey-text text-darken-4">Card Title<i class="material-icons right">more_vert</i></span>
             <p><a href="#">This is a link</a></p>
           </div>
           <div class="card-reveal">
             <span class="card-title grey-text text-darken-4">Card Title<i class="material-icons right">close</i></span>
             <p>Here is some more information about this product that is only revealed once clicked on.</p>
           </div>
         </div>
      </div>
      <div class="showcase-box">
        <div class="card">
           <div class="card-image waves-effect waves-block waves-light">
             <img class="activator" src="/DesignPic/1.jpg">
           </div>
           <div class="card-content">
             <span class="card-title activator grey-text text-darken-4">Card Title<i class="material-icons right">more_vert</i></span>
             <p><a href="#">This is a link</a></p>
           </div>
           <div class="card-reveal">
             <span class="card-title grey-text text-darken-4">Card Title<i class="material-icons right">close</i></span>
             <p>Here is some more information about this product that is only revealed once clicked on.</p>
           </div>
         </div>
      </div>
    </div>
    <div class="bottom-company-details">
      <div class="left-bottom-company">
        <div class="card">
          <div class="card-content">
            <p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>
          </div>
          <div class="card-tabs">
            <ul class="tabs tabs-fixed-width">
              <li class="tab"><a href="#test4">Email</a></li>
              <li class="tab"><a class="active" href="#test5">Telephone</a></li>
              <li class="tab"><a href="#test6">Social media</a></li>
            </ul>
          </div>
          <div class="card-content grey lighten-4">
            <div id="test4">Mycompany@gmail.com</div>
            <div id="test5"># 09105959449</div>
            <div id="test6">www.facebook.com</div>
          </div>
        </div>
      </div>
      <div class="right-bottom-company">

      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data () {
       return {

      }
    },
    props: ['company','user'],
    methods: {},
  }
</script>

<style lang="css">
</style>
