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
                plugins: [dayGridPlugin, interactionPlugin],
                initialView: 'dayGridMonth',
                dateClick: this.handleMonthChange,
                events: null,
                dayHeaderContent: (args) => {
                    return moment(args.date).format('dd')
                },
            },
        }
    },
    mounted() {
        this.getEvents()
        $('.fc-button-group').on('click', function () {
            $('.fc-daygrid-day:has(.fc-event-main)').addClass('rocket-bg');
        });
    },
    methods: {
        getEvents: function () {
            axios.get(route('user.exams.api'))
                .then(response => {
                    console.log('Events ni kat ma posht:')
                    console.log(response.data)
                    this.calendarOptions.events = response.data
                }).finally(() => {
                $('.fc-daygrid-day:has(.fc-event-main)').addClass('rocket-bg');
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
