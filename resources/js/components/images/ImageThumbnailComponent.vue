<template>
    <div :class="column_size">
        <img
            :src="'/' + image.folder + (image.has_sizes ? 'small/' : '') + image.file_name"
            class="responsive-img padded_image"
            v-bind:class="{ 'active_image': image.is_active }"
            :data-id="image.id"
            :alt="image.description"
            :title="image.title"
            @click="imageClick()"
        >
    </div>
</template>

<script>
    export default {
        props: ['image', 'column_size'],
        methods: {
            imageClick() {
                this.$emit('image_clicked', this.image);
            },
        }
    }
</script>
