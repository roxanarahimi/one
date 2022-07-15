<template>
    <div class="row justify-content-between mb-3">
        <div v-for="(item,index) in all" :key="index" class="col-12 col-md-6 col-lg-6 col-xl-3 col-xxl-3 mb-3">
            <div class="card text-black-50">
                <div class="card-body rounded ">
                    <div class="row justify-content-center">
                        <div class="col-10 col-xxl-8">
                            <chart :labels="item.labels" :data="item.data" :dalaLabel="item.dataLabel" :color="item.color"/>
                        </div>
                        <div class="col-12">
                            <small class="float-start">{{  item.dataLabel }}</small>
                            <small class="float-end">{{  item.all }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import Chart from "../../components/Chart";

export default {
    name: "DayReportCards",
    components: {Chart},
    data() {
        return {
          all: [

              {  labels: ["شنبه", "یکشنبه", "دوشنبه", "سه شنبه", "چهارشنبه", "پنجشنبه", "امروز"],
                  data: [70, 70, 72, 72, 72, 72, 75],
                  dataLabel: "محصول",
                  color: "white",
                  all:12365
              },
              {  labels: ["شنبه", "یکشنبه", "دوشنبه", "سه شنبه", "چهارشنبه", "پنجشنبه", "امروز"],
                  data: [70, 25, 110, 90, 5, 50, 70],
                  dataLabel: "فروش",
                  color: "white",
                  all:12365
              },
              {  labels: ["شنبه", "یکشنبه", "دوشنبه", "سه شنبه", "چهارشنبه", "پنجشنبه", "امروز"],
                  data: [1200, 1750, 1900, 2000, 2050, 2100, 2145],
                  dataLabel: "بازدید",
                  color: "white",
                  all:12365
              },
              {  labels: ["شنبه", "یکشنبه", "دوشنبه", "سه شنبه", "چهارشنبه", "پنجشنبه", "امروز"],
                  data: [345, 458, 847, 987, 990, 1000, 1500],
                  dataLabel: "کاربر",
                  color: "white",
                  all:12365
              },
          ]
        }
    }
}
</script>

<style scoped>
.card-body, h4 {
    background-color: black !important;
    color: white !important;
}
</style>
