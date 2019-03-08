<template>
    <div class="card">
        <div class="card-image">
            <img
                :src="'/' + image.folder + (image.has_sizes ? 'medium/' : '') + image.file_name"
                :data-id="image.id"
                :alt="image.description"
                :title="image.title"
            >
        </div>
        <div class="card-content">
            <b>Title: </b>{{ image.title }}<br>
            <b>Description: </b>{{ image.description }}<br>
            <b>Created: </b> {{ image.created_at | format_date }}<br>
            <template v-if="image.tags">
                <div v-for="tag in image.tags" class="blue lighten-1 white-text chip">
                    {{ tag.name }}
                </div>
            </template>
        </div>

        <div v-if="display_action" class="card-action">
            <a :href="'/admin/images/edit/' + image.id" class="waves-effect waves-light btn">Edit</a>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            image: {},
            display_action: {
                default: true,
            }
        },
    }
</script>
