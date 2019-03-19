<template>
    <form v-on:submit.prevent="onSubmit">
        <div class="row">
            <div class="col s12 m6 l4">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title blue-text">General Info</span>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="dive_number" name="dive_number" type="text" v-model="dive_log.dive_number">
                                <label for="dive_number">Dive Number: </label>
                            </div>

                            <div class="input-field col s12">
                                <input id="location" name="location" type="text" v-model="dive_log.location">
                                <label for="location">Location: </label>
                            </div>

                            <div class="input-field col s12">
                                <input id="date" name="date" type="text" class="datepicker" v-model="dive_log.date">
                                <label for="date">Date: </label>
                            </div>

                            <div class="input-field col s12">
                                <input id="dive_site" name="dive_site" type="text" v-model="dive_log.dive_site">
                                <label for="dive_site">Dive Site: </label>
                            </div>

                            <div class="input-field col s12">
                                <input id="description" name="description" type="text" v-model="dive_log.description">
                                <label for="description">Description: </label>
                            </div>

                            <div class="input-field col s12">
                                <textarea id="notes" name="notes" type="text" class="materialize-textarea" v-model="dive_log.notes"></textarea>
                                <label for="notes">Notes: </label>
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
        data() {
            return {
                user: {},
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
            getCreate() {
                let log = this;
                Axios.get('/api/dive-log/create', {
                    params: {
                        user: log.user.id ? log.user.id : null,
                    },
                }).then(function (response) {
                    log.dive_log.dive_number = response.data.dive_number;
                }).catch(function (error) {
                    console.log(error);
                });
            },
            checkUser() {
                let log = this;
                Axios.post('/api/dive-log/user', {

                }).then(function (response) {
                    log.user = response.data.user;
                    log.getCreate();
                }).catch(function (error) {
                    console.log(error);
                });
            },
        },
        updated() {

        },
        mounted() {
            this.checkUser();
            Materialize.Datepicker.init(document.querySelectorAll('.datepicker'), {
                format: 'yyyy-mm-dd'
            });

            Materialize.updateTextFields();
            Materialize.textareaAutoResize(document.querySelector('#notes'));


            if (this.$router.currentRoute.path === '/dive-log/create') {
                console.log('Yay');
            }
        },
    }
</script>
