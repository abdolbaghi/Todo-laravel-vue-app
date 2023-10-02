<template>
    <div class="item" :style="{'background-color':crergb(item.category.color)}">
        <input type="checkbox" @change="updateCheck()" v-model="item.completed" ref="inputRef" />
        <img :src = "item.category.icon" class="icon-cat"/>
        <span :class="[item.completed ? 'completed' : '', 'itemText']">{{
            item.name
        }} ({{ item.point }})</span>
        <span>{{ item.due_date }}</span>
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
