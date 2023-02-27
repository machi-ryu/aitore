<template>
  <div class="content">
    <div style="display:flex">
      <h2>{{ displayMonth }}</h2>
      <div class="button-area">
        <button @click="prevMonth">前の月</button>
        <button @click="nextMonth">次の月</button>
      </div>
    </div>
    <div class="calendar">
      <div class="calendar-weekly">
        <div class="calendar-youbi" v-for="n in 7" :key="n">
          {{ youbi(n-1) }}
        </div>
      </div>
      <div
        class="calendar-weekly"
        v-for="(week, index) in calendars"
        :key="index"
      >
          <div
            class="calendar-daily"
            :class="{outside: currentMonth !== day.month}"
            v-for="(day, index) in week"
            :key="index"
          >
            <div class="calendar-day">
              {{ day.date }}
            </div>
            <div v-for="dayEvent in day.dayEvents" :key="dayEvent.id">
              <div
                class="calendar-event"
                :style="`width:97%;background-color:${dayEvent.color}`"
              >
                <a :href="`/show/${dayEvent.jisyutore_post_id}`">
                  <div class="hidden">
                    {{ dayEvent.start_time }}
                    {{ dayEvent.title }}
                  </div>
                </a>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</template>

<script>
import moment from "moment"
export default {
  data() {
    return {
      currentDate: moment(),
      events:[
        // { id: 1, name: "ミーティング", start: "2023-02-01 19:00", end:"2023-02-01", color:"blue"},
        // { id: 2, name: "イベント", start: "2023-02-02", end:"2023-02-03", color:"limegreen"},
        // { id: 3, name: "会議", start: "2023-02-06", end:"2023-02-06", color:"deepskyblue"},
      ],
    };
  },

  methods: {
    getStartDate() {
      let date = moment(this.currentDate);
      date.startOf("month")
      const youbiNum = date.day();
      return date.subtract(youbiNum, "days");
    },
    getEndDate() {
      let date = moment(this.currentDate);
      date.endOf("month")
      const youbiNum = date.day();
      return date.add(6 - youbiNum, "days");
    },
    getCalendar() {
      const startDate = this.getStartDate();
      const endDate = this.getEndDate();
      const weekNumber = Math.ceil(endDate.diff(startDate, "days") / 7)

      let calendars = [];
      let calendarDate = this.getStartDate();
      for (let week = 0; week < weekNumber; week++) {
        let weekRow = [];
        for (let day = 0; day < 7; day++) {
          let dayEvents = this.getDayEvents(calendarDate);
          weekRow.push({
            date: calendarDate.get("date"),
            month: calendarDate.format("YYYY-MM"),
            dayEvents
          });
          calendarDate.add(1, "days");
        }
        calendars.push(weekRow);
      }
      return calendars;
    },
    nextMonth() {
      this.currentDate = moment(this.currentDate).add(1, "month");
    },
    prevMonth() {
      this.currentDate = moment(this.currentDate).subtract(1, "month");
    },
    youbi(dayIndex) {
      const week = ["日", "月", "火", "水", "木", "金", "土"];
      return week[dayIndex];
    },
    getDayEvents(date) {
      // return this.events.filter(event => {
      let dayEvents = [];
      this.events.forEach(event => {
        // let startDate = moment(event.start).format('YYYY-MM-DD')
        // let endDate = moment(event.end).format('YYYY-MM-DD')
        let startDate = moment(event.start_datetime).format('YYYY-MM-DD')
        // let endDate = moment(event.end_datetime).format('YYYY-MM-DD')
        let Date = date.format('YYYY-MM-DD')
        // if(startDate <= Date && endDate >= Date) return true;
        if(startDate == Date) {
          let color = this.getColor(event.menu_category)
          let start_time = moment(event.start_datetime).format('HH:mm')
          dayEvents.push({...event, color, start_time})
        }
     });
     return dayEvents;
    },
    getEventsDB() {
      axios.get("/mypage/calendar").then((response) => (this.events = response.data));
    },
    getColor(menu_category) {
      let color = '';
      switch(menu_category) {
        case '01': //ラン
          color = 'green';
          break;
        case '02': //ステップ
          color = 'blue';
          break;
        case '03': //ボール
          color = 'red';
          break;
        default:
          color = 'gray';
      }
      return color;
    }
  },

  mounted(){
    // console.log(weekNumber);
    console.log(this.getCalendar());
    this.getEventsDB();
  },

  computed: {
    calendars() {
      return this.getCalendar();
    },
    displayMonth() {
      return this.currentDate.format('YYYY[年]M[月]');
    },
    currentMonth() {
      return this.currentDate.format('YYYY-MM');
    },
    getEvents() {
      return this.getEventsDB();
    },
  },
}
</script>

<style scoped>
.content{
  margin:2em auto;
  width:900px;
}
.button-area{
  margin:0.5em 0;
}
.button{
  padding:4px 8px;
  margin-right:8px;
}
.calendar{
  max-width:900px;
  border-top:1px solid #E0E0E0;
  font-size:0.8em;
}
.calendar-weekly{
  display:flex;
  border-left:1px solid #E0E0E0;
  /* background-color: black; */
}
.calendar-daily{
  flex:1;
  min-height:125px;
  border-right:1px solid #E0E0E0;
  border-bottom:1px solid #E0E0E0;
  margin-right:-1px;
}
.calendar-day{
  text-align: center;
}
.calendar-youbi{
  flex: 1;
  border-right: 1px solid #E0E0E0;
  margin-right: -1px;
  text-align: center;
}
.outside{
  background-color: #f7f7f7;
}
.calendar-event{
  margin-bottom:1px;
  border-radius: 4px;
}
.calendar-event a{
  color:white;
  /* margin-bottom:1px; */
  height:25px;
  line-height:25px;
  text-decoration: none;
  overflow: hidden;
}
.hidden {
  height: 25px;
  overflow: hidden;
}

</style>
