<template>
<div class="mobile-wrapper">

   <!--======= Header =======-->

   <header class="header">
      <div class="container">
         <span>Welcome Back!</span>
         <h1>Calendar Plan</h1>
       <span class="breadcrumb">از تاریخ</span>
      <date-picker v-model="this.date_from" @change="getList()"  simple></date-picker>
      <span class="breadcrumb">تا تاریخ</span>
      <date-picker v-model="this.date_to" @change="getList()"  simple></date-picker>


  
      </div>
   </header>
    <!-- partial:index.partial.html -->
    <!-- days sourced from: https://nationaldaycalendar.com/february/ -->
     <section class="chart-box" id="chart-box">
      

      <BarChart :collection="collection" :key="collection"   />
   </section>
    
    
    <ul>
        <div class="item" v-for="(items, date) in collection" > 
            <calendarDay :items="items" :date="date"  />
        </div>
    </ul>
              </div>

</template>

<script>
import { useRouter, useRoute } from 'vue-router';
import calendarDay from './calendarDay.vue';
import BarChart from './barChart.vue';
import DatePicker from 'vue3-persian-datetime-picker';
import {  ref } from 'vue';
const renderComponent = ref(false);

export default {
    data() {
        return {
            collection: [],
            date_from: null,
            date_to:null
        }
    },
    components: {
        calendarDay,
        BarChart
    },
    methods: {
        getList() {
            axios.get('api/items/grouped',{
                params: {
                    from: this.date_from,
                    to: this.date_to,
                }
            }).then((response)=> {
                this.collection = response.data
                this.$forceUpdate(); // add forceUpdate

            }).catch((error) => {
                console.log(error);
            })
            renderComponent.value = true;
        }
    },
    created() {
        this.getList();
    }
}
</script>

<style>
.chart-box {
  background: #eeaeca;
  background: radial-gradient(circle,#eeaeca 0%,#94bbe9 100%);
  
  color: #fff;
  padding: 37px 40px;
  position: relative;
  box-shadow: 0px 0px 40px -9px #485fed;
  margin-bottom: 50px;
}
.chart-box::before {
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
.chart-box .breadcrumb {
  font-weight: 300;
  position: relative;
}
.chart-box .breadcrumb::after {
  content: ">";
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
.chart-box .date-title {
  font-size: 20px;
  margin: 7px 0 0 0;
  letter-spacing: 1px;
  font-weight: 600;
  text-shadow: 0px 0px 5px rgba(0, 0, 0, 0.15);
}
.chart-box .plus-icon {
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
.chart-box .plus-icon:hover {
  transform: translateY(-40%);
}
.chart-box .plus-icon i {
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
.chart-box .plus-icon:active {
  top: 52%;
  transform: translatey(-52%);
  right: 38px;
  box-shadow: 0px 8px 30px -14px #000;
}
body {
  display: flex;
  flex-flow: column;
  align-items: center;
  font-family: "Poppins", serif;
  /*
  background: #eeaeca;
  background: radial-gradient(circle, #eeaeca 0%, #94bbe9 100%);
  */
}

h1 {
  font-weight: 800;
  margin: 1rem 0 0;
}

ul {
  display: grid;
  grid-template-columns: 1fr 1fr;
  flex-wrap: wrap;
  list-style: none;
  padding: 0 20px !important;
}

</style>
