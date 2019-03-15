<template>
    <div class="card blog_card col s12">
        <div class="card-content">
            <div class="row">
                <div class="col s12">
                    <span class="card-title">Welcome!</span>
                </div>
            </div>

            <div class="row">
                <div class="col s12">
                    <p>Whoop Whoop</p>
                </div>
            </div>

            <div class="row">
                <div class="col sm12">
                    <p>Good to see you {{ user ? user : 'No User Defined' }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            user: {
                default: null,
            },
        },
        data() {
            return {
                show_post: false,
            }
        },
        methods: {

        },
        updated() {

        }
    }
</script>
