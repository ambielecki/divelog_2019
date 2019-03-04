<template>
    <ul class="pagination">
        <li v-if="(page === 1)" class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
        <li v-else class="waves-effect"><a href="#!"><i class="material-icons">chevron_left</i></a></li>

        <template v-if="pages <= 10">
            <li v-for="i in pages" v-bind:class="{ active: (i === page), 'waves-effect': (i !== page) }"><a href="#!">{{ i }}</a></li>
        </template>

        <li v-if="(page === pages)" class="disabled"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
        <li v-else class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
    </ul>
</template>

<script>
    export default {
        props: ['page', 'pages'],
    }
</script>
