<template>
    <nav class="d-flex justify-items-center justify-content-between">
        <div class="d-flex justify-content-between flex-fill d-sm-none">
            <ul class="pagination">
                <!-- Previous Page Link -->
                <li class="page-item disabled" v-if="meta.current_page == 1" aria-disabled="true">
                    <span class="page-link">&laquo; Previous</span>
                </li>
                <li class="page-item">
                    <a class="page-link" rel="prev" v-if="meta.current_page != 1"
                        @click.prevent="handleClick(meta.current_page - 1)">&laquo; Previous</a>
                </li>

                <!-- Next Page Link -->
                <li class="page-item">
                    <a class="page-link" rel="next" v-if="meta.current_page != meta.last_page"
                        @click.prevent="handleClick(meta.current_page + 1)">Next &raquo;</a>
                </li>
                <li class="page-item disabled" aria-disabled="true" v-if="meta.current_page == meta.last_page">
                    <span class="page-link">Next &raquo;</span>
                </li>
            </ul>
        </div>
        <div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between">
            <!-- show in to -->
            <div>
                <ul class="pagination">

                    <!-- Previous Page Link -->
                    <li v-if="meta.current_page == 1" class="page-item disabled" aria-disabled="true"
                        aria-label="@lang('pagination.previousText')">
                        <span class="page-link" href="1">First</span>
                    </li>
                    <li v-if="meta.current_page == 1" class="page-item disabled" aria-disabled="true"
                        aria-label="@lang('pagination.previous')">
                        <span class="page-link" aria-hidden="true">&laquo; Previous</span>
                    </li>
                    <li class="page-item" v-if="meta.current_page != 1">
                        <a class="page-link" href="" rel="prev" @click.prevent="handleClick(1)"
                            aria-label="&laquo; Previous">
                            First
                        </a>
                    </li>
                    <li class="page-item" v-if="meta.current_page != 1">
                        <a class="page-link" href="" rel="prev" @click.prevent="handleClick(meta.current_page - 1)"
                            aria-label="&laquo; Previous">
                            &laquo; Previous
                        </a>
                    </li>
                    <!-- Pagination Elements -->
                    <li v-for="link in getinks" v-if="link.url != null" class="page-item" :class="{ active: link.active }"
                        aria-current="page">
                        <a class="page-link" href="" @click.prevent="handleClick(Number(link.label))">{{ link.label }}</a>
                    </li>
                    <!-- Next Page Link -->
                    <li v-if="meta.current_page == meta.last_page" class="page-item disabled" aria-disabled="true"
                        aria-label="@lang('pagination.previousText')">
                        <span class="page-link" href="1">Next &raquo</span>
                    </li>
                    <li v-if="meta.current_page == meta.last_page" class="page-item disabled" aria-disabled="true"
                        aria-label="@lang('pagination.previous')">
                        <span class="page-link" aria-hidden="true">Last</span>
                    </li>
                    <li class="page-item" v-if="meta.current_page != meta.last_page"
                        @click.prevent="handleClick(meta.current_page + 1)">
                        <a class="page-link" href="1">Next &raquo;</a>
                    </li>
                    <li class="page-item" v-if="meta.current_page != meta.last_page"
                        @click.prevent="handleClick(meta.last_page)">
                        <a class="page-link" href="1" rel="prev" aria-label="Last">Last</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>

export default {
    props: {
        meta: {
            type: Object,
            required: true,
        },
        path: {
            type: String,
            required: true,
        },
    },
    data() {
        return {
        };
    },
    mounted() {
    },
    computed: {
        getinks() {
            return this.meta.links.filter((item, index) => {
                return index != 0 && index != this.meta.last_page + 1;
            });
        }
    },
    methods: {
        handleClick(page) {
            this.$emit('page-change', page);
        }
    },
};
</script>

<style scoped></style>
