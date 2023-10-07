<template>
    <div class="addItem row">
        <input type="text" v-model="item.name" class="col-sm-3">
        <input type="number" v-model="item.point"  class="col-sm-1">
        <select v-model="item.category"  class="col-sm-3">
            <option v-for="(cat, index) in categories" :key="index" :value="cat.id" :style="{'background-color':crergb(cat.color)}">
                <img :src = "cat.icon" alt="My Happy SVG"/>
                {{cat.name}}
            </option>
        </select>
        <date-picker v-model="item.date" simple  class="col-sm-3"></date-picker>
        <font-awesome-icon @click="addItem()" :class="[item.name ? 'active' : 'inactive', 'plus']" icon="plus-square"  class="col-sm-1"/>
    </div>
</template>
<script>
import DatePicker from 'vue3-persian-datetime-picker';
export default {
    name: 'addItemForm',
    data() {
        return {
            item: {
                name: '',
                point: 1,
                category: null,
                date: ''
            }
        }
    },
    components: {
      DatePicker
    },
    props: ["categories"],
    methods: {
        addItem() {
            if (this.item.name == "") {
                return;
            }
            axios
            .post("api/item/store", {
                    item: this.item,
                })
                .then((response) => {
                    if (response.status == 201) {
                        this.item.name = "";
                        this.$emit('reloadlist');
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        crergb(color){
            return "rgb("+color[0]+","+color[1]+","+color[2]+")"
        }
    }
}
</script>

<style scoped>
.addItem {
    display: flex;
    justify-content: center;
    align-items: center;
}

input {
    background: #f7f7f7;
    border: 0;
    outline: none;
    padding: 5px;
    margin-right: 10px;
}

.plus {
    font-size: 20px;
    cursor: pointer;
}

.active {
    color: #00ce25;
}

.inactive {
    color: #999
}
</style>
