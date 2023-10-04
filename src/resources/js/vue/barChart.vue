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
    console.log(JSON.stringify(props.collection))
  },
  data() {
    return {
      chartData: {
        labels: [ 'January', 'February', 'March' ],
        datasets: [ { data: [40, 20, 12] } ]
      },
      chartOptions: {
        responsive: true
      },
      groupeddata:this.collection
    }
  },
   methods: {
    create_bar_data(){
        let done=[] 
        let not_done=[]
        console.log("sadasd",JSON.stringify(this.groupeddata))
        for(const date in this.groupeddata){
            for(const item in this.groupeddata[date]){
                if(item.completed){
                    if(item.cat_id in done){
                        done[item.cat_id].count += 1;
                    }
                    else{
                        done[item.cat_id] = item.category
                        done[item.cat_id]['count']=1
                    }
                }
                else{
                    if(item.cat_id in done){
                        not_done[item.cat_id].count += 1;
                    }
                    else{
                        not_done[item.cat_id] = item.category
                        not_done[item.cat_id]['count']=1
                }
            }

            }
        }
        console.log(JSON.stringify(done),JSON.stringify(not_done))

        return {
            labels: [  ],
            datasets: [ { data: [] } ]
        
        }
    }
  },
  mounted() {
    this.create_bar_data()
  }
}
</script>