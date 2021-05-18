<template>
    <div>
        <canvas style="width:100%" height="400" ref="payment"></canvas>
    </div>
</template>

<script>
    import Chart from 'chart.js';

    export default {
        props : ['labels' , 'values'],
        name : 'visits',
        mounted() {

            var ctx = this.$refs.payment.getContext("2d");
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: this.labels,
                    datasets: [{
                        label: 'بازدید',
                        data: this.values.visits,
                        backgroundColor: 'rgba(52, 152, 219,0.5)',
                        borderColor: 'rgba(41, 128, 185,1.0)',
                        borderWidth: 1
                    },{
                        label: 'بازدیدکننده',
                        data: this.values.visitors,
                        backgroundColor: 'rgba(231, 76, 60,.5)',
                        borderColor: 'rgba(192, 57, 43,1.0)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
        }
    }
</script>
