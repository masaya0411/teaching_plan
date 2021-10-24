<script>
import { Pie, mixins } from 'vue-chartjs'
const { reactiveProp } = mixins

export default {
    extends: Pie,
    mixins: [reactiveProp],
    data () {
        return {
            options: {
                responsive: true,
                legend: {
                    labels: {
                        fontSize :28,
                    }
                }
            }
        }
    },
    mounted() {
        this.renderChart(this.chartData, this.options)
    }
}
</script>
