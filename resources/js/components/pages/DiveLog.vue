<template>
    <form v-on:submit.prevent="onSubmit">
        <div class="row">
            <div class="col s12 m6 l4">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title blue-text">General Info</span>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="location" name="location" type="text" v-model="dive_log.location">
                                <label for="location">Location: </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <input id="dive_site" name="dive_site" type="text" v-model="dive_log.dive_site">
                                <label for="dive_site">Dive Site: </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <input id="description" name="description" type="text" v-model="dive_log.description">
                                <label for="description">Description: </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
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
                dive_log: {
                    dive_number: '',
                    location: '',
                    dive_site: '',
                    date: '',
                    description: '',
                    notes: '',
                    dive_details: {

                    },
                    equipment_details: {

                    }
                },
            }
        },
        methods: {

        },
        updated() {

        },
        mounted() {

        }
    }
</script>
