<template>
  <div class="place-card">
      <img :src="_city.image" alt="">
      <h5 class="place-name">{{ _city.name }}</h5>
  </div>
</template>

<script>
export default {
    props:['_city'],
}
</script>

<style lang="scss" scoped>
  .place-card{
    width: 100%;
    height: 300px;
    position: relative;
    overflow: hidden;
    border-radius: 5px;
    display:flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 2rem;
    img{
      width:100%;
      height: 100%;
      object-fit: cover;
      transition: 0.3s ease-in-out;
      filter:brightness(70%);
    }
    .place-name{
      position:absolute;
      top: 40%;
      color:#fff;
      font-size: 3.3rem;
      font-family: 'Odachi';
      letter-spacing: 2px;
      transition: 0.3s linear;
      font-weight: normal;
      text-shadow: 0px 3px rgba(0,0,0,0.1);
    }
  }

  .place-card:hover{
    img{
      filter: brightness(100%)
    }
    .place-name{
      top: 20px;
      transform: scale(1.1);
      letter-spacing: 8px;
      font-weight: 800;
      text-shadow: 3px 3px rgba(0,0,0,0.3);
    }
  }
</style>
