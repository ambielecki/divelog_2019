<template>
    <ul class="pagination">
        <template>
            <li class="waves-effect"><a @click="getPage($event)" data-page="1"><i class="material-icons">first_page</i></a></li>
            <li
                v-for="i in 9"
                v-bind:class="{ active: (page + i - 5 === page), 'waves-effect': (page + i - 5 !== page) }"
                v-if="(page + i - 5) > 0 && (page + i - 5) <= pages"
            >
                <a @click="getPage($event)" :data-page="(page + i - 5)">{{ page + i - 5 }}</a>
            </li>
            <li class="waves-effect"><a @click="getPage($event)" :data-page="pages"><i class="material-icons">last_page</i></a></li>
        </template>
    </ul>
</template>

<script>
    export default {
        props: ['page', 'pages'],
        methods: {
            getPage(event) {
                this.$emit('page_clicked', event.currentTarget.dataset.page);
            },
        },
    }
</script>
