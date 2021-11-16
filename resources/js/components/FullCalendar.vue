<script>
import '@fullcalendar/core/vdom' // solves problem with Vite
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'

export default {
    components: {
        FullCalendar
    },
    props: ['exams', 'lessons', 'editable'],
    data() {
        return {
            calendarOptions: {
                plugins: [dayGridPlugin, interactionPlugin],
                initialView: 'dayGridMonth',
                dayHeaderContent: (args) => {
                    return moment(args.date).format('dd')
                },
                dateClick: this.handleDateClick,
                events: this.lessons.concat(this.exams),
            },
            form: {
                time: null,
                type: null,
                exam: null
            },
            exams: null
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
        axios.get(route('exams.api')).then(response => {
            this.exams = response.data
        })
    },
    methods: {
        submit: function (form) {
            axios.post(route('set.date'), form).then(response => {
                this.toast.success(response.data.message);
                window.location.reload()
            }).catch(error => {
                    Object.values(error.response.data.errors).flat().forEach(element => this.toast.error(element))
                }
            );
        },
        handleDateClick: function (arg) {
            this.form.time = arg.dateStr + 'T00:00'
        },
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
        <div v-if="editable" class="row justify-content-center my-2">
            <div class="d-flex flex-mobile">
                <input type="datetime-local" v-model="form.time" class="form-control">
                <select name="" v-model="form.type" class="form-control mx-2">
                    <option value="exam">🚀</option>
                    <option value="lesson">⌛</option>
                </select>
                <select name="" v-model="form.exam" v-if="form.type=='exam'" class="form-control mr-2">
                    <option v-for="exam in exams" :value="exam.id">{{ exam.title }}</option>
                </select>
                <button v-on:click="submit(form)" class="btn btn-primary"><i class="bi bi-check2-circle"></i></button>
            </div>
        </div>
    </div>
</template>
