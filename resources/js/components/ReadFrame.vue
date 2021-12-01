<template>

    <div class="modal fade" id="readFrame" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Excerpt</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe id="frame" :src="link" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ReadFrame",
    props: ['link'],
    mounted() {
        $('#readFrame').modal('show');
    }
}
</script>

<style scoped>
iframe {
    width: 100%;
    min-height: 400px;
}

.modal-dialog {
    position: absolute;
    left: 0;
    top: 58px;
    width: 500px;
}

.modal-dialog-centered {
    display: block !important;
}

@media (max-width: 767.98px) {
    .modal-dialog {
        width: 100% !important;
    }
}
</style>
