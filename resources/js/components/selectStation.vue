<template>
  <div>
    <label class="form-label" for="date">場所</label>
    <!-- <input class="form-control" type="text" name="address"> -->
    <!-- <select v-on:change="selected" v-model="selectedId" class="form-control" name="address"> -->
    <!-- <select v-on:change="selected" v-model="selected_line" class="form-control" name="address"> -->
    <select v-on:change="selected" v-model="selected_line" class="form-control" name="line_id">
            <option disabled value="0" selected>路線を選択してください</option>
            <option v-for="line in lines" :value="line.id" :key="line.id">{{ line.line_name }}</option>
    </select>
    <!-- <select class="form-control" name="station_id"> -->
    <select v-model="selected_station" class="form-control" name="station_id">
            <option disabled value="0" selected>---</option>
            <option
              v-for="station in stations"
              :value="station.id"
              :key="station.id"
            >{{ station.station_name }}</option>
    </select>
  </div>
</template>

<script>
  export default {
    name: 'selectStation',
    props: ['selected_line', 'selected_station'],
    data() {
      return {
        lines: [],
        stations: [],
        // stations: [
          // { id: '1', line_id: '', station_name: '日吉', created_at: '', updated_at: ''},
          // { id: '2', line_id: '', station_name: '日吉本町', created_at: '', updated_at: ''},
        // ],
        // selectedId: 'selecteIDです',
        // selectedStation: ['初期値です']
        // selectedStation: { id: '2', line_id: '', station_name: '日吉本町', created_at: '', updated_at: ''},
        // selectedStation: { id: '2', station_name: '日吉本町'},
        // selectedStation: '2'
      }
    },
    mounted() {
      axios.get("/line").then((response) => (this.lines = response.data));
      axios.get("/station").then((response) => (this.stations = response.data));
    },
    methods:{
      selected: function(){
        // console.log('selected発動中');
        axios.get("/station/" + this.selected_line).then((response) => (this.stations = response.data));
        // axios.get("/station/" + this.selectedId).then(response => console.log(response));
      }
    }
  }
</script>

<style scoped>
</style>
