<template>
    <div class="event">
        <input type="checkbox" @change="updateCheck()" v-model="item.completed" ref="inputRef" />

        <i class="ion ion-ios-flame hot" :class="[item.completed ? 'done' : '']" :style="{'background-color':crergb(item.category.color)}"></i>
        <img :src = "item.category.icon" class="icon-cat"/>
        <h4 class="event__point">{{item.name}}</h4>
        <span class="event__duration">{{ item.point }}</span>
        <p class="event__description">
            {{ item.due_date }}
        </p>

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
            return "rgb("+color[0]+","+color[1]+","+color[2]+")"
        }
    },

    mounted() {
        this.item.completed ? this.$refs.inputRef.checked = true : '';
    }

};
</script>

<style scoped>
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
    background: #e6e6e6;
    border: none;
    color: #ff0000;
    outline: none;
    cursor: pointer;
}
.icon-cat {
    max-width:20px
}
</style>
