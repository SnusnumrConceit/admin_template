<template>
    <div class="container-fluid p-t-30">
        <div class="row">
            <div class="col-6">
                <div class="au-card m-b-30">
                    <h3 class="title-2 tm-b-5">
                        <!--Всего пользователей-->
                        Total Users
                    </h3>
                    <div class="chart-container">

                    </div>
                    <line-chart :chart-data="users_total.datacollection"
                                :options="users_total.options"
                                v-if="loaded"></line-chart>
                </div>
            </div>
            <div class="col-6">
                <div class="au-card m-b-30">
                    <h3 class="title-2 tm-b-5">
                        <!--Всего пользователей по дням-->
                        Today Users
                    </h3>
                    <div class="chart-container">
                        <line-chart :chart-data="users_today.datacollection"
                                    :options="users_total.options"
                                    v-if="loaded"></line-chart>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="au-card m-b-30">
                    <h3 class="title-2 tm-b-5">
                        <!--Пользователей сейчас-->
                        Now Users
                    </h3>
                    <div class="row no-gutters">
                        <div class="col-6">
                            <div class="chart-note-wrap">
                                <div class="chart-note mr-0 d-block">
                                    <span class="dot dot--blue"></span>
                                    <span>Сейчас</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="percent-chart">
                                <doughnut-chart :chart-data="users_now.datacollection"
                                                :options="users_now.options"
                                                v-if="loaded"></doughnut-chart>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
  import DoughnutChart from '../../templates/charts/DoughnutChart';
  import LineChart from '../../templates/charts/LineChart';

  export default {
    name: "users_statistics",
    components: { DoughnutChart, LineChart },

    data() {
      return {
        users_today: {
          datacollection: {
            labels: [],
            datasets: [
              {
                label: 'За день',
                backgroundColor: '#4f79f8',
                data: []
              }
            ]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false
          },
        },
        users_total: {
          datacollection: {
            labels: [],
            datasets: [
              {
                label: 'Всего',
                backgroundColor: '#f87979',
                data: []
              }
            ]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false
          }
        },
        users_now: {
          datacollection: {
            datasets:[
              {
                label: 'На данный момент',
                backgroundColor: '#4ab2e8',
                data: []
              }
            ]
          }
        },

        loaded: false,
      }
    },
    methods: {
      async loadData() {
        this.loaded = false;
        let response = await axios.get('/statistics/users');
        if (response.status !== 200 || response.data.status === 'error') {
          this.$swal('Error!', response.data.msg, 'error');
          return false;
        } else {
          this.users_total.datacollection.datasets[0].data = response.data.total;
          this.users_total.datacollection.labels = response.data.labels;
          this.users_today.datacollection.datasets[0].data = response.data.today;
          this.users_today.datacollection.labels = response.data.labels;
          this.users_now.datacollection.datasets[0].data = response.data.now;
          this.users_now.datacollection.labels = ['Сейчас'];
          this.loaded = true;
        }
      }
    },

    mounted() {
      this.loadData();
    }
  }
</script>

<style scoped>

</style>