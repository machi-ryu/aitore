<template>
  <div>
    <!-- <div ref="map"></div> -->
    <!-- <div ref="map" style="height:100%; width:100%"></div> -->
    <!-- <div id="map"></div> -->
    <div id="map" style="height:100%; width:100%"></div>
    <!-- <input type="text" v-model="address"> -->
    <!-- <v-text-field
      v-model="address"
    ></v-text-field> -->
    <input v-model="address" class="form-control" type="text" name="address">

    <v-btn size="small" @click="mapDisplay">地図へ反映</v-btn>
    <!-- <button v-on:click="mapDisplay">地図へ反映</button> -->
  </div>
</template>

<script>
export default {
  props: ['address'],
  data() {
    return {
      // uluru: {lat: 35.6811673, lng:139.7670516},
      uluru: {lat: 35.5571547, lng:139.6082375},
      // address: '神奈川県横浜市都筑区東山田町',
      position: {'lat': 0, 'lng': 0},
      test: '',
      map: Object,
      marker: Object,
    }
  },

  methods: {
    mapDisplay() {
      const script = document.createElement('script');
      script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyA4K2jcDjWhtghEupx_sJYOC7oK-fRt11c&callback=initMap&v=weekly'
      // script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyA4K2jcDjWhtghEupx_sJYOC7oK-fRt11c&callback=iniMap'
      script.async = true;
      document.head.appendChild(script);

      window.initMap = () => {
        const geocoder = new google.maps.Geocoder();
        geocoder.geocode( { address: this.address }, function(results, status) {
          if ( status === google.maps.GeocoderStatus.OK) {
            const latlng = {
              lat: results[0].geometry.location.lat(),
              lng: results[0].geometry.location.lng(),
            }
            // const map = new window.google.maps.Map(this.$refs.map, {
            const map = new window.google.maps.Map(document.getElementById('map'), {
              zoom: 15,      //地図の縮尺値
              center: latlng,    //地図の中心座標
              mapTypeId: 'roadmap'   //地図の種類
            });
            const marker = new window.google.maps.Marker({
              position: latlng,
              map: map,
              draggable: true,
            });

            window.google.maps.event.addListener(marker, 'dragend', function(e) {
              this.position = {
                lat: e.latLng.lat(),
                lng: e.latLng.lng(),
              }
              // console.log(this.position);
              var map = new window.google.maps.Map(document.getElementById('map2'), {
                zoom: 15,      //地図の縮尺値
                // center: latlng,    //地図の中心座標
                center: this.position,    //地図の中心座標
                mapTypeId: 'roadmap'   //地図の種類
              });
              marker.setMap(map);
            }.bind(this));

          } else {
            console.error('Geocode was not successful for the following reason: ' + status)
          }
        }.bind(this))

      };
    },

  },

  mounted() {
    this.mapDisplay();
  },

  watch: {
    position: {
      handler() {
        console.log('変更されました');
        console.log(this.position);

        const geocoder = new google.maps.Geocoder();
        geocoder.geocode( { location: this.position }, function(results, status) {
          if ( status === google.maps.GeocoderStatus.OK) {
            let str_address = results[0].formatted_address.split(' ');
            this.address = str_address[1]; // 日本と郵便番号を除いてる「日本、〒224-0024 神奈川県横浜市都筑区東山田町１４１３」
          } else {
            console.error('Geocode was not successful for the following reason: ' + status)
          }
        }.bind(this))

      },
      deep: true,
    }
  }
}
</script>
