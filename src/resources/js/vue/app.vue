<template>
    <div class="todoListContainer">
        <div class="heading">
            <h2 id="title">Todo List</h2>
            <addItemForm :categories="categories" @reloadlist="getList()" />
        </div>
        <listView :items="items" @reloadlist="getList()" />
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

<style scoped>
.todoListContainer {
    width: 350px;
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
