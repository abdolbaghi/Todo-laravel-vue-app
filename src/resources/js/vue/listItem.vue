<template>
    <div class="event" :style="{'background-color':crergb(item.category.color),'background-image':'url('+item.category.icon+')'}">
        <input type="checkbox" @change="updateCheck()" v-model="item.completed" ref="inputRef" />

        <i class="ion ion-ios-flame hot" :class="[item.completed ? 'done' : '']" ></i>
        <h4 class="event__point">{{item.name}}</h4>
        <span class="event__duration" v-if="item.due_date != null && timeFromDatetime(item.due_date).length > 0">({{ timeFromDatetime(item.due_date) }})</span>


        <button @click="removeItem()" class="trashcan">
            <font-awesome-icon icon="trash" />
        </button>
    </div>
</template>

<script>
export default {
    props: ["item"],
    methods: {
        updateCheck() {
            axios
                .put("api/item/" + this.item.id, {
                    item: this.item,
                })
                .then((response) => {
                    if (response == 200) {
                        this.$emit('itemChanged');
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        removeItem() {
            axios
                .delete("api/item/" + this.item.id)
                .then((response) => {
                    if (response.status == 200) {
                        this.$emit("itemChanged");
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        crergb(color){
            return "rgba("+color[0]+","+color[1]+","+color[2]+",0.5)"
        },
        timeFromDatetime(date_time){
            let time_arr= date_time.split(" ")[1].split(":")
            if (time_arr[0] == "00" && time_arr[1] == "00")
            {
                return ""
            }
            return time_arr[0]+":"+time_arr[1]
        }
    },

    mounted() {
        this.item.completed ? this.$refs.inputRef.checked = true : '';
    }

};
</script>

<style scoped>
.event{
    background-size: 50% 100%;
    background-repeat: no-repeat;
    background-position: left;
    border-radius: 25px;
}
.completed {
    text-decoration: line-through;
    color: #999;
}

.itemText {
    width: 100%;
    margin-left: 20px;
}

.item {
    display: flex;
    justify-content: center;
    align-items: center;
}

.trashcan {
    border: none;
    color: #6657db;
    outline: none;
    cursor: pointer;
    float: inline-end;
}
.icon-cat {
    max-width:20px
}
</style>
