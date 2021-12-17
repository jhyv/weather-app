<template>
<div class="landing">
  <app-header></app-header>
  <section class="hero">
    <div class="row mx-0 justify-content-start w-100">
      <div class="col-lg-6 col-md-6 front-text">
        <h1 id="title">JAPAN</h1>
        <h1 class="text-white sub-title">Land of The Rising Sun</h1>
        <a class="btn-explore mt-4" href="/places">
          Explore
        </a>
      </div>
    </div>
      
    <div class="circle-container" v-for="(i,index) in particleCnt" :key="index">
      <div class="circle"></div>
    </div>
  </section>
</div>  
</template>

<script>

export default {
  data(){
    return{
      particleCnt:30,
    }
  },
}
</script>
