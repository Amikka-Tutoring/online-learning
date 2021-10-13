<script>
import '@fullcalendar/core/vdom' // solves problem with Vite
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'

export default {
    components: {
        FullCalendar
    },
    props: ['exams', 'lessons'],
    data() {
        return {
            calendarOptions: {
                plugins: [dayGridPlugin, interactionPlugin],
                initialView: 'dayGridMonth',
                dayHeaderContent: (args) => {
                    return moment(args.date).format('dd')
                },
                events: this.lessons.concat(this.exams),
            },
        }
    },
    mounted() {
        $('.fc-daygrid-day:has(.fc-daygrid-event-harness)').addClass('rocket-bg');
        $('.fc-daygrid-day:has(.fc-daygrid-dot-event)').addClass('time-bg');
        $('.fc-button-group').on('click', function () {
            $('.fc-daygrid-day:has(.fc-daygrid-dot-event)').addClass('time-bg');
            $('.fc-daygrid-day:has(.fc-daygrid-event-harness)').addClass('rocket-bg');
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
                $('.fc-daygrid-day:has(.fc-daygrid-dot-event)').addClass('time-bg');
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
