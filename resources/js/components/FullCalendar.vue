<script>
import '@fullcalendar/core/vdom' // solves problem with Vite
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'

export default {
    components: {
        FullCalendar
    },
    data() {
        return {
            calendarOptions: {
                header: {
                    today: false,
                    left: 'title',
                    center: '',
                    right: 'prev,next'
                },
                plugins: [dayGridPlugin, interactionPlugin],
                initialView: 'dayGridMonth',
                dateClick: this.handleMonthChange,
                dayHeaderContent: (args) => {
                    return moment(args.date).format('dd')
                },
            },
        }
    },
    mounted() {
        this.getLessons();
        this.getExams();
        $('.fc-button-group').on('click', function () {

        });
    },
    methods: {
        getExams: function () {
            axios.get(route('user.exams.api'))
                .then(response => {
                    this.calendarOptions.events = response.data
                }).finally(() => {
                $('.fc-daygrid-day:has(.fc-daygrid-event-harness)').addClass('rocket-bg');
            })
        },
        getLessons: function () {
            axios.get(route('user.lessons.api'))
                .then(response => {
                    this.calendarOptions.events = response.data
                }).finally(() => {
                $('.fc-daygrid-day:has(.fc-daygrid-event-harness)').addClass('time-bg');
            })
        }
    }
}
</script>
<template>
    <div>
        <FullCalendar :options="calendarOptions"/>
    </div>
</template>
