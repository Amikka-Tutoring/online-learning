<template>
    <div class="row m-0">
        <div v-bind:class="['side-bar-0']">
            <div class="mb-5">
            </div>
        </div>

        <div v-bind:class="['main-content']" class="bg-white p-0 transition">
            <img class="banner-img" :src="'/images/banner.png'" alt=""
                 style="width: 100%; height:140px; margin-bottom: 100px">
            <div class="container-fluid p-0">
                <main class="mb-4">
                    <slot></slot>
                </main>
            </div>
        </div>
    </div>
    <div class="container">
        <div>
            <H1>{{ title }}</H1>
            <div>{{ description }}</div>
        </div>
    </div>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'

export default {
    components: {
        AppLayout
    },
    props: {
        status: Number,
    },
    computed: {
        title() {
            return {
                503: '503: Service Unavailable',
                500: '500: Server Error',
                404: '404: Page Not Found',
                403: '403: Forbidden',
            }[this.status]
        },
        description() {
            return {
                503: 'Sorry, we are doing some maintenance. Please check back soon.',
                500: 'Whoops, something went wrong on our servers.',
                404: 'Sorry, the page you are looking for could not be found.',
                403: 'Sorry, you are forbidden from accessing this page.',
            }[this.status]
        },
    },
}
</script>
