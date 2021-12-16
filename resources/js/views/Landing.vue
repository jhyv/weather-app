<template>
<div class="landing">
  <Header />
  <section class="hero">
    <div class="row mx-0 justify-content-center">
      <div class="col-lg-4 col-md-6">
        <h1 id="title">JAPAN</h1>
        <h3 class="text-white">Land of The Rising Sun</h3>
      </div>
      <div class="col-lg-4">
        <h3 class="text-white">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras mattis urna et odio facilisis, sit amet suscipit elit ornare. 
          Integer sed scelerisque ante. Ut maximus augue quis turpis dignissim pellentesque. 
          In et erat et orci efficitur pharetra. Mauris nec nibh urna. Etiam a quam sed libero vestibulum rhoncus. Sed maximus.</h3>
      </div>
    </div>
  </section>
</div>  
</template>

<script>
import Header from '../components/Header.vue';

export default {
  components:{
    Header
  },
  data(){
    return{
      places:''
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
    }
  }
}
</script>

<style lang="scss" scoped>
</style>