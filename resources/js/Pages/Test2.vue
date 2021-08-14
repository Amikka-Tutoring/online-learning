<template>
    <app-layout>
        <div class="col-6">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" :src="'https://images.theconversation.com/files/195198/original/file-20171117-7588-1rai1rs.jpg?ixlib=rb-1.1.0&q=45&auto=format&w=926&fit=clip'"  alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>

        <div class="col-6">
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" :src="'https://images.theconversation.com/files/195198/original/file-20171117-7588-1rai1rs.jpg?ixlib=rb-1.1.0&q=45&auto=format&w=926&fit=clip'"  alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
        </div>

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
