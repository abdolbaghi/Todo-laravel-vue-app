<template>
  <Bar
    id="my-chart-id"
    :options="chartOptions"
    :data="chartData"
  />
</template>

<script>
import { Bar } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

export default {
  name: 'BarChart',
  components: { Bar },
  props: ["collection"],
  setup(props) {
    // setup() receives props as the first argument.
    // console.log(JSON.stringify(props.collection))
  },
  data() {
    return {
      groupeddata:this.collection,
      chartData: this.create_bar_data(),
      chartOptions: {
        responsive: true
      },
    }
  },
   methods: {
    create_bar_data(){
        var done={} 
        var not_done={}
        for(const date in this.collection){
            for(const index in this.collection[date]){
                const item = this.collection[date][index]
                if(item.completed){
                    if(item.category.name in done){
                        done[item.category.name].count += 1;
                    }
                    else{
                        done[item.category.name] = item.category
                        done[item.category.name]['count']=1
                    }
                }
                else{
                    if(item.category.name in not_done){
                        not_done[item.category.name].count += 1;
                    }
                    else{
                        not_done[item.category.name] = item.category
                        not_done[item.category.name]['count']=1
                }
            }

            }
        }
        var keys = Object.keys(done);
        keys = keys.concat(Object.keys(not_done));
        var done_data = []
        var not_done_data = []
        for(const index in keys){
            if (keys[index] in done){
                done_data.push(done[keys[index]]['count'])
            }
            else{
                done_data.push(0)
            }
            if (keys[index] in not_done){
                not_done_data.push(not_done[keys[index]]['count'])
            }
            else{
                not_done_data.push(0)
            }
        }
        console.log("dasdasd",JSON.stringify(keys),JSON.stringify(done_data),JSON.stringify(not_done_data))

        return {
            labels: keys,
            datasets: [ { data: done_data },{ data: not_done_data } ]
        
        }
    }
  },
  mounted() {
    
  }
}
</script>