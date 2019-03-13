<template>
    <div>
        <span class="card-title">Previous Versions</span>
        <div v-for="(post, index) in posts">
            <div class="row">
                <div class="col s12">
                    <b>Revision: </b>{{ post.revision }}<br>
                    <b>Created: </b>{{ post.created_at }}<br>
                    <b>Content: </b><br>
                </div>
            </div>

            <div class="row">
                <div class="col s12">
                    <a class="btn" :href="edit_url + post.id">View version {{ post.revision }}</a>
                </div>
            </div>

            <hr v-if="index < posts.length - 1">
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            posts: [],
            edit_url: '',
        },
    }
</script>
