<template>
<section>
  <div class="city-bg">
      <app-header></app-header>
      <section class="city-box ">
          <div class="px-4">
            <div class="row justify-content-between">
                <div class="col-lg-6 col-md-6 text-center">
                    <h3 class="font-odachi city-name typing-anim" v-if="selectedCity">{{ selectedCity.name }}</h3>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="white-card">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-lg-3 col-md-3 col-sm-6 weather-box" v-if="weather">
                                <h2>{{ weather.clouds.all }}%</h2>
                                <i class="fa fa-cloud"></i>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 weather-box" v-if="weather">
                                <h2>{{ weather.main.temp }} C</h2>
                                <i class="fa fa-temperature-low"></i>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 weather-box" v-if="weather">
                                <h2>{{ weather.main.feels_like }} &deg;C</h2>
                                <i class="fa fa-male"></i>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 weather-box" v-if="weather">
                                <h2>{{ weather.main.humidity }}%</h2>
                                <i class="fa fa-tint"></i>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 weather-box" v-if="weather">
                                <h2>{{ weather.wind.speed }} m/s</h2>
                                <i class="fa fa-wind"></i>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 weather-box" v-if="weather && weather.main.grnd_level">
                                <h2>{{ weather.main.grnd_level }} hPa</h2>
                                <i class="fa fa-wind"></i>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 weather-box" v-if="weather && weather.main.sea_level">
                                <h2>{{ weather.main.sea_level }} hPa</h2>
                                <i class="fa fa-wind"></i>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
          <hr>

          <!-- Places -->
          <div class="d-flex places-container">
              <div class="col-lg-5 col-md-6 col-12" v-for="(place,index) in places" :key="index">
                  <div class="white-card mb-4" :id="place.fsq_id">
                      <h3 class="place-name">{{ place.name }}</h3>
                  </div>
              </div>
          </div>
      </section>
  </div>
</section>
</template>

<script>
import citiesJson from '../cities.json';
export default {
    props:['city'],
    data(){
        return{
            cities:citiesJson,
            selectedCity:{
                name:'',
                image:'',
                geolocation:[]
            },
            places:[],
            weather:''
        }
    },
    created(){
        this.selectedCity = this.cities.find(c=>c.name.toLowerCase() == this.city.city);
        if(!this.selectedCity){
            window.location.href="/"
        }
        console.log(this.selectedCity)
    },
    mounted(){
        $(".city-bg").css({
            backgroundImage: 'url('+this.selectedCity.image+')'
        });
        $(".city-name").css({
            animationIterationCount: 'steps('+this.selectedCity.name.length+')'
        })
        this.getPlaces();
        this.getWeather();
    },
    methods:{
        async getPlaces(){
            let response = await axios.get('/places/list', { 
                params:{ 
                    keywords:this.selectedCity.name.toLowerCase(),
                    geolocation: this.selectedCity.geolocation.join(',')
                } 
            })

            
            if(response.data.results.length > 0)
            {
                this.places = response.data.results;
                console.log(this.places);
                for(let place of this.places)
                {
                    // let details = await axios.get('/place/'+place.fsq_id);
                    // place.details = details.data;

                    let photos = await axios.get('/place/photos/'+place.fsq_id);
                    place.photo = photos.data[0];
                    $("#"+place.fsq_id).css({
                        backgroundImage: 'url("'+place.photo.prefix+'original'+place.photo.suffix+'")',
                        backgroundPosition: '50% 50%',
                        backgroundSize: 'cover',
                    })
                }
            }
        },
        async getWeather(){
            let response = await axios.get('/weather', { 
                params:{ 
                   lat:this.selectedCity.geolocation[0],
                   lng:this.selectedCity.geolocation[1]
                } 
            })
            this.weather = response.data;

        }
    }
}
</script>

<style lang="scss" scoped>
    .city-bg{
        background-size: cover;
        background-position: 50% 50%;
        background-image: url("/imgs/backgrounds/japan.jpg");
    }

    .city-box{
        height: calc(100vh - 82px);
        padding-top: 5vh;
        padding-bottom: 5vh;
    }

    .city-name{
        font-size: 12rem;
        color:#fff;
        letter-spacing: 10px;
        font-weight: 800;
        white-space: nowrap;
        text-shadow: 0px 3px rgba(0,0,0,0.3);

    }
    .typing-anim{
        animation: typing 2s steps(22), blink .5s step-end infinite;
    }

    @keyframes blink {
        50% {
            border-color: transparent
        }
    }

    @keyframes typing {
        from {
            width: 0
        }
    }
    .white-card{
        width:100%;
        height: 200px;
        padding: 20px;
        background-color: rgba(255,255,255,0.7);
        border-radius: 5px;
        .row{
            height:100%;
        }
        .place-name{
            color:#fff;
            text-shadow: 0px 3px 3px rgba(0,0,0,0.8);
        }
        .weather-box{
            display:flex;
            align-items: center;
            justify-content: center;
            flex-direction: row-reverse;
            h2{
                font-family: 'Montserrat';
                font-weight: bold;
                font-size: 1.3rem;
                margin-bottom:0;
                margin-left: 5px;
            }
            i{
                font-size: 1.7rem;
            }
        }
    }
    .places-container{
        overflow-x: auto;
        scrollbar-color: #d8350e #e0e0e0;
       
        .white-card{
            height: calc(100vh - 500px);
            padding:30px 20px;
        }
    }

    @media (max-width: 750px) {
        .city-name{
            font-size: 4rem;
        }

        .weather-box h2, .weather-box i{
            font-size:1.2rem !important;
        }
    }
</style>