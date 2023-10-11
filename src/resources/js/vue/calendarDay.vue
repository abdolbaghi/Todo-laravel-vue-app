<template>
    <li>
        <time :datetime="date">{{date}}</time>
        <div class="item" v-for="(item, index) in items" :key="index" :style="{'background-color':crergb(item.category.color)}">
            <img :src = "item.category.icon" class="icon-cat"/>
            <span >{{item.name}} ({{ item.point }})</span>
            <img src="http://localhost:8000/icons/done.svg" v-if="item.completed" class="icon-cat filter-green" data-v-e29b8c21="">
        </div>
	</li>
</template>

<script>
export default {
    props: ["items","date"],
    methods: {
        // updateCheck() {
        //     axios
        //         .put("api/item/" + this.item.id, {
        //             item: this.item,
        //         })
        //         .then((response) => {
        //             if (response == 200) {
        //                 this.$emit('itemChanged');
        //             }
        //         })
        //         .catch((error) => {
        //             console.log(error);
        //         });
        // },
        // removeItem() {
        //     axios
        //         .delete("api/item/" + this.item.id)
        //         .then((response) => {
        //             if (response.status == 200) {
        //                 this.$emit("itemChanged");
        //             }
        //         })
        //         .catch((error) => {
        //             console.log(error);
        //         });
        // },
        crergb(color){
            return "rgb("+color[0]+","+color[1]+","+color[2]+")"
        }
    },

    mounted() {
        // this.item.completed ? this.$refs.inputRef.checked = true : '';
            // console.log(JSON.stringify(this.items))

    }

};
</script>

<style scoped>
.icon-cat {
    max-width:20px
}
.filter-green{
    filter: invert(48%) sepia(79%) saturate(2476%) hue-rotate(86deg) brightness(118%) contrast(119%);
}
ul li {
  display: flex;
  width: 10rem;
  height: fit-content;
  margin: 0.25rem;
  flex-flow: column;
  border-radius: 0.2rem;
  padding: 1rem;
  font-weight: 300;
  font-size: 0.8rem;
  box-sizing: border-box;
  background: rgba(255, 255, 255, 0.25);
  box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
  backdrop-filter: blur(4px);
  -webkit-backdrop-filter: blur(4px);
  border-radius: 10px;
  border: 1px solid rgba(255, 255, 255, 0.18);
}
ul li time {
  font-size: 1.5rem;
  margin: 0 auto;
  font-weight: 500;
}
ul .today {
  background: #ffffff70;
}
ul .today time {
  font-weight: 800;
}
</style>
