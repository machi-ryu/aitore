<template>
<div>

    <form class="row my-2" method="GET" :action="routeIndex">
        <input type="hidden" name="_token" :value="csrf">

        <div class="col-sm-3">
            <select class="form-select" name="stations[]" placeholder="駅" size="3" multiple>
                <option v-for="station in stations" :value="station.id" :key="station.id">{{ station.station_name }}</option>
            </select>
            <!-- <v-select
              :items="stations"
              label="Select"
              multiple
            ></v-select> -->
        </div>
        <div class="col-sm-7">
            <div class="row gy-1">
                <div class="col-sm-6">
                    <Datepicker
                        v-model="startDate"
                        locale="ja"
                        :format="'yyyy/MM/dd'"
                        :enable-time-picker="false"
                        placeholder="To日付"
                        name="start_date"
                    />
                </div>
                <div class="col-sm-6">
                    <Datepicker
                        v-model="endDate"
                        locale="ja"
                        :format="'yyyy/MM/dd'"
                        :enable-time-picker="false"
                        placeholder="From日付"
                        name="end_date"
                    />
                </div>
                <div class="col-sm-3">
                    <select class="form-control" name="menu_category" placeholder="メニュー">
                        <option disabled value="0" selected>メニュー</option>
                        <option v-for="(item, key) in menuCategorys" :value="key" :key="key">{{ item }}</option>
                    </select>
                </div>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="keyword" placeholder="キーワード (タイトル、駅、投稿者)">
                </div>
            </div>
        </div>
        <div class="col-sm-2">
            <button type="submit" class="btn btn-primary w-75">検索</button>
            <a class="btn btn-secondary w-75 mt-1" :href="routeIndex">リセット</a>
        </div>
    </form>

</div>
</template>

<script>
import { ref } from 'vue';
import moment from "moment"
export default {
    props: ['routeIndex', 'stations', 'menuCategorys'],
    data() {
        return {
            startDate: '',
            endDate: '',
        }
    },
    mounted() {
        this.startDate = ref();
        this.endDate = ref();
    },
}
</script>
