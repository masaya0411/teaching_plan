<script>
import { Pie, mixins } from 'vue-chartjs'

export default {
    extends: Pie,
    mixins: [mixins.reactiveData],
    props: {
        propData: {
            type: Array,
            default: null
        }
    },
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
        this.render()
    },
    watch: {
        propData () {
            this.render()
        }
    },
    methods: {
        render () {
            this.chartData = {
                labels: ['導入', '展開', 'まとめ'],
                datasets: [
                    {
                        backgroundColor: ["#ffd3d3", "#fff9b4", "#6090EF"],
                        borderColor: 'transparent',
                        label: '授業',
                        data: this.propData
                    },
                ],
            }
        }
    }
}
</script>
