<template>
<section class="upcoming-events">
      <div class="container-2">
         <h3>
            Lastest Events

         </h3>
         <div class="events-wrapper">
                <listItem v-for="(item, index) in items" :key="index" :item="item"  @itemChanged="$emit('reloadlist')" />
         </div>
         <button class="add-event-button" @click="isVisible=true">
            <span class="add-event-button__title">Add Event</span>

            <span class="add-event-button__icon">
               <i class="ion ion-ios-star-outline"></i>
            </span> 


         </button>
      </div>
   </section>
</template>

<script>
import listItem from './listItem.vue'
    export default {
        props: ['items'],
        components: {
            listItem
        }
    }
</script>

<style scoped>
.item {
    background: #e6e6e6;
    padding: 5px;
    margin-top: 5px;
}
</style>
