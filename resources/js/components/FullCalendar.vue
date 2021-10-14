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
    created() {
        setInterval(() => this.updateCss(), 1000)
    },
    mounted() {
        this.updateCss();
        $('.fc-button-group').on('click', function () {
            $('.fc-daygrid-day:has(.fc-daygrid-block-event)').addClass('rocket-bg');
            $('.fc-daygrid-day:has(.fc-daygrid-dot-event)').addClass('time-bg');
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
        },
        updateCss: function () {
            FullCalendar.render();
            $('.fc-daygrid-day:has(.fc-daygrid-block-event)').addClass('rocket-bg');
            $('.fc-daygrid-day:has(.fc-daygrid-dot-event)').addClass('time-bg');
            $('.fc-daygrid-day:not(:has(.fc-daygrid-block-event))').removeClass('rocket-bg');
            $('.fc-daygrid-day:not(:has(.fc-daygrid-dot-event))').removeClass('time-bg');
        }
    },
    watch: {
        exams: function (val) {
            this.calendarOptions.events = this.lessons.concat(this.exams)
        },
        lessons: function (val) {
            this.calendarOptions.events = this.lessons.concat(this.exams)
        }
    },
}
</script>
<template>
    <div>
        <FullCalendar :options="calendarOptions"/>
    </div>
</template>
