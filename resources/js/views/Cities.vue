<template>
  <div class="full-page">
      <app-header></app-header>
      <section class="hero flex-column">
          <h1 class="text-center text-white font-gloria">Visit different places</h1>
          <hr class="bg-white mt-3">
          <div class="row">
              <div class="col-lg-4 col-md-6 col-sm-12" v-for="(city,index) in cities" @click="setActive(city,index)" :key="index">
                  <CityCard v-bind="{_city:city}" />
              </div>
          </div>
      </section>
  </div>
</template>

<script>
import CityCard from '../components/CityCard.vue';
import citiesJson from '../cities.json';

export default {
    components:{
        CityCard
    },
    data(){
        return{
            places:[],
            cities:citiesJson
        }
    },
    mounted(){
    },
    methods:{
        setActive(city,index){
            window.location.href="/places/view?city="+city.name.toLowerCase();
        },
    }
}
</script>

<style>

</style>