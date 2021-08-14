<template>
    <app-layout>
        <col-3>
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" :src="'/images/banner.png'"  alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </col-3>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'

export default {
    components: {
        AppLayout,
    },
}
</script>
