<template>
    <div class="modal fade" id="cupModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="row justify-content-center">
                                <img src="/images/cup.png" alt="" height="200">
                            </div>
                        </div>
                        <div class="row justify-content-center green-content">
                            <div class="col-md-8">
                                <h3 class="my-4">Congratulations!</h3>
                                <p>Your hard work and progress has been noticed. You may now proceed to the next
                                    level.</p>
                                <button class="my-4" data-dismiss="modal">Next Level</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Cup",
    mounted() {
        $('#cupModal').modal('show');
    }
}
</script>

<style scoped>
img {
    margin: 40px 0;
}

.green-content {
    background: rgba(129, 164, 24, 0.8);
    border-radius: 10px;
    color: white;
    text-align: center;
    margin: 0 15px !important;
}

.green-content button {
    background: white;
    color: rgba(107, 200, 64, 0.8);
    padding: 5px 40px;
    border-radius: 5px;
    border: none;
    font-weight: bold;
}

.modal-content {
    border: none !important;
    border-radius: 12px;
}

.modal-dialog {
    max-width: 400px !important;
}
</style>
