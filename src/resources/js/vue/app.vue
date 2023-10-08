<template>
    <div class="mobile-wrapper">

   <!--======= Header =======-->

   <header class="header">
      <div class="container">
         <span>Welcome Back!</span>
         <h1>Calendar Plan</h1>
         <div class="menu-toggle">
            <div>
               <span></span>
               <span></span>
               <span></span>
            </div>
         </div>
      </div>
   </header>
   <!--======= Today =======-->

   <section class="today-box" id="today-box">
      <span class="breadcrumb">امروز</span>
      <h3 class="date-title">{{ new Date().toLocaleDateString('fa-IR') }}</h3>

      <div class="plus-icon" @click="this.isVisible=true">
        <i class="ion ion-ios-add"><font-awesome-icon icon="plus-circle" /></i>
      </div>
   </section>

   <!--======= Upcoming Events =======-->

   <listView :items="items" @reloadlist="getList()" />
    </div>
    <Modal :visible="isVisible">
      <addItemForm :categories="categories" @reloadlist="getList()" />
    </Modal>
        <div class="heading">
            <h2 id="title">Todo List</h2>
            
        </div>
    
</template>

<script>
import addItemForm from './addItemForm.vue';
import listView from './listView.vue';
export default {
    data() {
        return {
            items: [],
            categories:[],
            categories_dict:[],
        }
    },
    components: {
        addItemForm,
        listView
    },
    methods: {
        getList() {
            axios.get('api/items').then((response)=> {
                this.items = response.data
            }).catch((error) => {
                console.log(error);
            })
        },
        getCat() {
            axios.get('/api/categories').then((response)=> {
                this.categories = response.data
                for(var cat in this.categories){
                    this.categories_dict[cat.id]=cat
                }

            }).catch((error) => {
                console.log(error);
            })
        }
    },
    mounted() {
        this.getList();
        this.getCat();
    }
}
</script>
<style >
@charset "UTF-8";
html {
  box-sizing: border-box;
}

*,
*:before,
*:after {
  box-sizing: inherit;
}

* {
  outline: 0;
}

body {
  background: linear-gradient(45deg, #13495f, #764be2, #8373c6, #77d3b9);
  background-attachment: fixed;
  height: 100vh;
  padding: 3rem 0;
  margin: 0;
  color: #555;
  font-family: "Lato", sans-serif;
  font-size: 14px;
}

.container {
  width: 90%;
  margin: auto;
}

.mobile-wrapper {
  background: #fff;
  /* relative with .today-box::before*/
  z-index: 1;
  /*positive*/
  position: relative;
  /*---------*/
  width: 380px;
  min-height: 100%;
  margin: auto;
  padding: 10px 0 20px;
  border-radius: 10px;
  box-shadow: 0px 10px 30px -10px #000;
  overflow: hidden;
}

.header {
  padding-bottom: 15px;
  margin-bottom: 40px;
}
.header .container {
  position: relative;
}
.header .container span {
  color: #444;
  font-family: "Ramabhadra";
  font-size: 21px;
  font-weight: 700;
}
.header .container h1 {
  margin-top: 5px;
  color: #919294;
  font-size: 13px;
  font-weight: 300;
}
.header .container .menu-toggle {
  width: 25px;
  height: 25px;
  background: #fff;
  padding: 24px;
  border-radius: 50%;
  direction: rtl;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0px 10px 30px -14px #000;
  position: absolute;
  top: 0;
  left: 0;
  cursor: pointer;
}
.header .container .menu-toggle span {
  display: block;
  width: 25px;
  height: 2px;
  background: #777;
  border-radius: 2px;
  transition: all 300ms ease;
}
.header .container .menu-toggle span:not(:last-child) {
  margin-bottom: 5px;
}
.header .container .menu-toggle span:first-child {
  width: 20px;
}
.header .container .menu-toggle span:last-child {
  width: 15px;
}
.header .container .menu-toggle:hover span:first-child, .header .container .menu-toggle:hover span:last-child {
  width: 100%;
}
.header .container::before {
  content: "";
  display: block;
  width: 0;
  height: 0;
  border: 6px solid transparent;
  border-left-color: #e8e8e8;
  position: absolute;
  bottom: -13px;
  right: 0px;
}
.header .container::after {
  content: "";
  display: block;
  width: calc(100% - 10px);
  height: 2px;
  background-color: #e8e8e8;
  position: relative;
  top: 8px;
}

.today-box {
  background: linear-gradient(to left, #485fed, rgba(255, 44, 118, 0.25)), #485fed;
  color: #fff;
  padding: 37px 40px;
  position: relative;
  box-shadow: 0px 0px 40px -9px #485fed;
  margin-bottom: 50px;
}
.today-box::before {
  content: "";
  background: linear-gradient(to left, #485fed, rgba(255, 44, 118, 0.25)), #485fed;
  opacity: 0.4;
  z-index: -1;
  display: block;
  width: 100%;
  height: 40px;
  margin: auto;
  position: absolute;
  bottom: -13px;
  right: 50%;
  transform: translatex(-50%);
  border-radius: 50%;
  box-shadow: 0px 0px 40px 0 #485fed;
}
.today-box .breadcrumb {
  font-weight: 300;
  position: relative;
}
.today-box .breadcrumb::after {
  content: "";
  font-family: "Ionicons";
  vertical-align: middle;
  font-size: 12px;
  font-weight: 100;
  display: inline-block;
  color: #fff;
  text-align: center;
  position: absolute;
  right: 45px;
  top: 3px;
}
.today-box .date-title {
  font-size: 20px;
  margin: 7px 0 0 0;
  letter-spacing: 1px;
  font-weight: 600;
  text-shadow: 0px 0px 5px rgba(0, 0, 0, 0.15);
}
.today-box .plus-icon {
  border: 2px solid rgba(255, 255, 255, 0.6);
  border-radius: 50%;
  box-shadow: 0px 10px 30px -14px #000;
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  left: 40px;
  cursor: pointer;
  transition: all 350ms ease;
  transition-timing-function: cubic-bezier(0.05, 1.8, 1, 1.57);
}
.today-box .plus-icon:hover {
  transform: translateY(-40%);
}
.today-box .plus-icon i {
  font-size: 22px;
  font-weight: 700;
  background: #fff;
  color: #485fed;
  width: 45px;
  height: 45px;
  border: 6px solid #485fed;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
}
.today-box .plus-icon:active {
  top: 52%;
  transform: translatey(-52%);
  right: 38px;
  box-shadow: 0px 8px 30px -14px #000;
}

.upcoming-events .container-2 h3 {
  color: #333;
  font-size: 17px;
  margin-bottom: 30px;
  position: relative;
}
.upcoming-events .container-2 h3::before {
  content: "";
  display: block;
  width: 58%;
  height: 2px;
  background-color: #e8e8e8;
  position: absolute;
  top: 60%;
  transform: translatey(-60%);
  left: 0;
}
.upcoming-events .container-2 h3::after {
  content: "\2713";
  font-family: "Ionicons";
  color: rgba(0, 0, 0, 0.1);
  vertical-align: middle;
  font-size: 36px;
  font-weight: 100;
  display: inline-block;
  background: #fff;
  color: #919294;
  width: 38px;
  text-align: center;
  position: absolute;
  left: 60px;
  top: -10px;
}
.upcoming-events .container-2 .events-wrapper {
  margin-bottom: 11px;
}
.upcoming-events .container-2 .events-wrapper .event {
  position: relative;
  margin-bottom: 10px;
  padding-right: 30px;
  cursor: pointer;
}
.upcoming-events .container-2 .events-wrapper .event i {
  font-size: 24px;
  font-weight: 100;
  position: absolute;
  right: 0;
  top: -4px;
}
.upcoming-events .container-2 .events-wrapper .event .event__point {
  margin: 0;
  color: #555;
  font-size: 15px;
  font-weight: 800;
  letter-spacing: 1px;
  display: contents;
}
.upcoming-events .container-2 .events-wrapper .event .event__duration {
  position: absolute;
  top: 5px;
  right: 15px;
  color: #999;
  font-size: 10px;
  font-weight: 800;
  font-style: italic;
}
.upcoming-events .container-2 .events-wrapper .event .event__description {
  margin-top: 10px;
  color: #919294;
  font-size: 13px;
  font-weight: 300;
}
.upcoming-events .container-2 .events-wrapper .event.active {
  background: #e8e8e8;
  padding: 17px 0 5px 60px;
  margin-bottom: 38px;
  border-radius: 5px;
}
.upcoming-events .container-2 .events-wrapper .event.active::after {
  content: "";
  display: block;
  width: 90%;
  height: 10px;
  background: #fff;
  border: 2px solid #ddd;
  border-top: 0;
  border-radius: 0 0 5px 5px;
  position: absolute;
  bottom: -10px;
  right: 50%;
  transform: translatex(-50%);
}
.upcoming-events .container-2 .events-wrapper .event.active i {
  position: absolute;
  right: 25px;
  top: 17px;
}
.upcoming-events .container-2 .events-wrapper .event.active .event__description::before, .upcoming-events .container-2 .events-wrapper .event.active .event__description::after {
  content: "";
  font-family: "Ionicons";
  font-size: 32px;
  display: inline-block;
  color: #919294;
  text-align: center;
  position: absolute;
  right: 30px;
  top: 50%;
  transform: translateY(-50%);
  cursor: pointer;
}
.upcoming-events .container-2 .events-wrapper .event.active .event__description::before {
  right: 45px;
  font-size: 22px;
  transition: all 550ms ease;
  transition-timing-function: cubic-bezier(0.05, 1.8, 1, 1.57);
}
.upcoming-events .container-2 .events-wrapper .event.active:hover .event__description::before {
  transform: translate(15px, -12px);
}

.hot {
  color: #ee6b51;
}

.done {
  color: #999 !important;
}

.icon-in-active-mode {
  color: #43ff28;
  font-size: 20px !important;
}

.upcoming {
  font-weight: bold;
  color: #777;
}

.add-event-button {
  display: flex;
  align-items: center;
  margin-right: auto;
  border: 0;
  padding: 0;
  background: linear-gradient(to left, #485fed, rgba(255, 44, 118, 0.25)), #485fed;
  border-radius: 50px;
  cursor: pointer;
  box-shadow: 0px 0px 40px -9px #485fed;
}
.add-event-button:active {
  position: relative;
  top: 2px;
  right: 2px;
}
.add-event-button .add-event-button__title {
  color: #fff;
  padding: 0 18px 0 23px;
  text-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
  font-family: "Lato";
  font-size: 15px;
  font-weight: 600;
}
.add-event-button .add-event-button__icon {
  display: inline-block;
  background: rgba(255, 255, 255, 0.1);
  padding: 0 17px 0 12px;
  height: 100%;
}
.add-event-button .add-event-button__icon i {
  margin: 0;
  color: #fff;
  font-size: 25px;
  padding: 13px 0;
}
.todoListContainer {
    margin: auto;
}

.heading {
    background: #e6e6e6;
    padding: 10px
}

#title {
    text-align: center;
}
</style>
