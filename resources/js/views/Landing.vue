<template>
<div class="landing">
  <Header />
  <section class="hero">
    <div class="row mx-0 justify-content-start w-100">
      <div class="col-lg-6 col-md-6 front-text">
        <h1 id="title">JAPAN</h1>
        <h1 class="text-white sub-title">Land of The Rising Sun</h1>
        <button class="btn-explore mt-4">
          Explore
        </button>
      </div>
    </div>
      
    <div class="circle-container" v-for="(i,index) in particleCnt" :key="index">
      <div class="circle"></div>
    </div>
  </section>
</div>  
</template>

<script>
import Header from '../components/Header.vue';

export default {
  components:{
    Header,
  },
  data(){
    return{
      places:'',
      particleCnt:30,
    }
  },
  mounted(){
    this.getPlaces();
  },
  methods:{
    getPlaces(){
      axios.get('/places', { 
        params:{ 
          keywords:'tokyo' 
        } 
      }).then((response)=>{
        if(response.data.status == "OK")
        {
          this.places = response.data.data;
        }
      })
    },
  }
}
</script>

<style lang="scss" scoped>
</style>