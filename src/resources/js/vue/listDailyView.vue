<template>
<section class="upcoming-events">
      <div class="container-2">
         <div class="events-wrapper">
                <dailyItem v-for="(item, index) in items" :key="index" :item="item"  @itemChanged="$emit('reloadlist')" />
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
import dailyItem from './dailyItem.vue'
    export default {
        props: ['items'],
        components: {
            dailyItem
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
