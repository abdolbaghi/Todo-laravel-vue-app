<template>
    <!-- partial:index.partial.html -->
    <!-- days sourced from: https://nationaldaycalendar.com/february/ -->
    <h1>February 2022</h1>
    <p>Holidays and Daily Observances in the United States</p>
    
    <ul>
        <div class="item" v-for="(items, date) in collection" > 
            <calendarDay :items="items" :date="date"  />
        </div>
    </ul>
        <BarChart :collection="collection" :key="collection"   />
</template>

<script>
import { useRouter, useRoute } from 'vue-router';
import calendarDay from './calendarDay.vue';
import BarChart from './barChart.vue';
import {  ref } from 'vue';
const renderComponent = ref(false);

export default {
    data() {
        return {
            collection: [],
        }
    },
    components: {
        calendarDay,
        BarChart
    },
    methods: {
        getList() {
            axios.get('api/items/grouped').then((response)=> {
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

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;800&display=swap");
body {
  display: flex;
  flex-flow: column;
  align-items: center;
  font-family: "Poppins", serif;
  background: #eeaeca;
  background: radial-gradient(circle, #eeaeca 0%, #94bbe9 100%);
}

h1 {
  font-weight: 800;
  margin: 1rem 0 0;
}

ul {
  display: grid;
  grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr 1fr;
  flex-wrap: wrap;
  list-style: none;
}

</style>
