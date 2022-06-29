<template>
    <div>
        <header>
            <h1 class="text-3xl font-bold">
                Расписание звонков
            </h1>
        </header>

        <div class="mt-4">
            <button v-on:click="openSelectModal" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-800 hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-900 transition">
                Изменить расписания звонков
            </button>
        </div>

        <div class="mt-4">
            <v-date-picker v-model="date" :attributes="attrs" @dayclick="onDayClick" is-expanded />
        </div>

        <ring-schedule-select-modal ref="selectModal" ></ring-schedule-select-modal>
        <ring-schedule-events-modal ref="eventsModal" @update="updateEvents"></ring-schedule-events-modal>
    </div>
</template>

<script>

import DatePicker from "v-calendar/lib/components/date-picker.umd";
import Calendar from "v-calendar/lib/components/calendar.umd";
import moment from "moment/moment";
import RingScheduleSelectModal from "./RingScheduleSelectModal";
import RingScheduleEventsModal from "./RingScheduleEventsModal";


export default {
    components: {
        Calendar,
        DatePicker,
        RingScheduleSelectModal,
        RingScheduleEventsModal,
    },

    data () {
        return {
            date: new Date(),
            events: null,

            attrs: [
            ]
        }
    },

    methods: {
        onDayClick: function (day) {
            this.$refs.eventsModal.date = day.id;
            this.$refs.eventsModal.getData();
            this.$refs.eventsModal.open = true;
        },

        getEvents: async function () {
            this.events = (await axios.get('/ring/event')).data;


            let d = [];

            this.events.forEach(function (value, i) {

                if (d.includes(value.date)) return;

                d.push(value.date);

                this.attrs.push({
                    key: i,
                    dot: true,
                    dates: moment(value.date).format(),
                })

            }.bind(this))
        },

        updateEvents: function () {
            this.events = null
            this.attrs = [];
            this.getEvents();
        },

        openSelectModal: function (e) {
            this.$refs.selectModal.open = true;
            this.$refs.selectModal.getData();
        }
    },

    mounted() {
        this.getEvents();
    }
}
</script>

<style scoped>

</style>
