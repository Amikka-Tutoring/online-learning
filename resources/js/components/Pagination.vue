<template>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-end mb-5">
            <li class="page-item" :class="pagination.prevPageUrl ? '':'disabled'"><a class="page-link"
                                                                                     :href="pagination.prevPageUrl">Previous</a>
            </li>
            <li class="page-item" :class="pagination.nextPageUrl ? '':'disabled'"><a class="page-link"
                                                                                     :href="pagination.nextPageUrl"
                                                                                     disabled>Next</a>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    props: {
        pagination: {},
        links: Array
    },
}

</script>
