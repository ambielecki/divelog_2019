<template>
    <div class="card col s12">
        <div class="card-content">
            <span class="card-title"><a :href="'/blog/' + post.slug">{{ post.title }}</a></span>
            <div v-html="post.content.first_paragraph"></div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['post'],
    }
</script>
