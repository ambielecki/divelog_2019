<template>
    <form v-on:submit.prevent="onSubmit">
        <div class="row">
            <div class="col s12 m6 l4">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title blue-text">General Info</span>
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="dive_number" name="dive_number" type="text" v-model="dive_log.dive_number">
                                <label for="dive_number">Dive Number: </label>
                            </div>

                            <div class="input-field col s6">
                                <input id="location" name="location" type="text" v-model="dive_log.location">
                                <label for="location">Location: </label>
                            </div>

                            <div class="input-field col s6">
                                <input id="dive_site" name="dive_site" type="text" v-model="dive_log.dive_site">
                                <label for="dive_site">Dive Site: </label>
                            </div>

                            <div class="input-field col s6">
                                <input id="date" name="date" type="text" class="datepicker" v-model="dive_log.date" @change="updatePicker($event, 'date')">
                                <label for="date">Date: </label>
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
            </div> <!-- End Standard Info -->

            <div class="col s12 m6 l4">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title blue-text">Calculations</span>
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="previous_pg" name="dive_details[starting_pg]" type="text" v-model="dive_log.dive_details.previous_pg">
                                <label for="previous_pg">Previous PG: </label>
                            </div>

                            <div class="input-field col s6">
                                <input id="surface_interval" name="dive_details[surface_interval]" type="text" v-model="dive_log.dive_details.surface_interval">
                                <label for="surface_interval">Surface Interval: </label>
                            </div>

                            <div class="input-field col s6">
                                <input id="post_si_pg" name="dive_details[post_si_pg]" type="text" v-model="dive_log.dive_details.post_si_pg">
                                <label for="post_si_pg">Post SI PG: </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s6">
                                <input id="dive_details_time_in" name="dive_details[time_in]" type="text" class="timepicker" v-model="dive_log.dive_details.time_in" @change="updatePicker($event, 'time_in')">
                                <label for="dive_details_time_in">Time In: </label>
                            </div>

                            <div class="input-field col s6">
                                <input id="dive_details_time_out" name="dive_details[time_out]" type="text" class="timepicker" v-model="dive_log.dive_details.time_out" @change="updatePicker($event, 'time_out')">
                                <label for="dive_details_time_out">Time Out: </label>
                            </div>

                            <div class="col s6">
                                <label>
                                    <input type="checkbox" v-model="compute_bottom_time">
                                    <span>Compute Bottom Time?</span>
                                </label>
                            </div>

                            <div class="input-field col s6">
                                <input id="bottom_time" name="dive_details[bottom_time]" type="text" v-model="dive_log.dive_details.bottom_time" :readonly="compute_bottom_time">
                                <label for="bottom_time">Bottom Time (min): </label>
                            </div>

                            <div class="input-field col s6">
                                <input id="max_depth" name="dive_details[max_depth]" type="text" v-model="dive_log.dive_details.max_depth">
                                <label for="max_depth">Max Depth (ft): </label>
                            </div>

                            <div class="input-field col s6">
                                <input id="pressure_group" name="dive_details[pressure_group]" type="text" v-model="dive_log.dive_details.pressure_group">
                                <label for="pressure_group">End Pressure Group: </label>
                            </div>

                            <div class="input-field col s6">
                                <button id="calculate_btn" class="btn" @click="calculateDive($event)">Calculate</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- End Calculations -->

            <div class="col s12 m6 l4">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title blue-text">Tank Info</span>
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="equipment_tank_type" name="equipment_details[tank][type]" type="text" v-model="dive_log.equipment_details.tank.type">
                                <label for="equipment_tank_type">Tank Type: </label>
                            </div>

                            <div class="input-field col s6">
                                <input id="equipment_tank_size" name="equipment_details[tank][size]" type="text" v-model="dive_log.equipment_details.tank.size">
                                <label for="equipment_tank_size">Tank Size: </label>
                            </div>

                            <div class="input-field col s6">
                                <input id="equipment_tank_start" name="equipment_details[tank][start_pressure]" type="text" v-model="dive_log.equipment_details.tank.start_pressure">
                                <label for="equipment_tank_start">Start Pressure: </label>
                            </div>

                            <div class="input-field col s6">
                                <input id="equipment_tank_end" name="equipment_details[tank][end_pressure]" type="text" v-model="dive_log.equipment_details.tank.end_pressure">
                                <label for="equipment_tank_end">End Pressure: </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- End Tank Info -->
        </div>
    </form>
</template>

<script>
    export default {
        data() {
            return {
                user: {},
                compute_bottom_time: true,
                show_post: false,
                update_text: false,
                dive_log: {
                    date: '',
                    description: '',
                    dive_number: '',
                    dive_site: '',
                    location: '',
                    notes: '',
                    dive_details: {
                        previous_pg: '',
                        surface_interval: '',
                        bottom_time: '',
                        max_depth: '',
                        time_in: '',
                        time_out: '',
                        pressure_group: '',
                        post_si_pg: '',
                    },
                    equipment_details: {
                        tank: {
                            type: '',
                            size: '',
                            start_pressure: '',
                            end_pressure: '',
                        },
                    },
                },
            }
        },
        methods: {
            getNextDiveNumber() {
                let log = this;
                Axios.post('/api/dive-log/next-dive-info', {
                    user: log.user.id ? log.user.id : null,
                }).then(function (response) {
                    log.dive_log.dive_number = response.data.dive_number;
                    log.update_text = true;
                }).catch(function (error) {
                    console.log(error);
                });
            },

            checkUser() {
                let log = this;
                Axios.post('/api/dive-log/user', {

                }).then(function (response) {
                    log.user = response.data.user;
                    if (log.$router.currentRoute.path === '/dive-log/create') {
                        log.getNextDiveNumber();
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            },

            updatePicker(event, target) {
                let value = event.target.value;
                switch (target) {
                    case 'date':
                        this.dive_log.date = value;
                        break;
                    case 'time_in':
                        this.dive_log.dive_details.time_in = value;
                        break;
                    case 'time_out':
                        this.dive_log.dive_details.time_out = value;
                        break;
                }
            },

            calculateBottomTime() {
                if (this.computed_time_in && this.computed_time_out) {
                    this.update_text = true;
                    let time_in = Moment(this.computed_time_in, 'HH:mm A');
                    let time_out = Moment(this.computed_time_out, 'HH:mm A');
                    this.dive_log.dive_details.bottom_time = time_out.diff(time_in) / (60 * 1000).toString();
                }
            },

            calculateDive(event) {
                let app = this;
                let log = app.dive_log;
                Axios.get('/api/calculator', {
                    params: {
                        dive_1_depth: log.dive_details.previous_pg ? '' : log.dive_details.max_depth,
                        dive_1_time: log.dive_details.previous_pg ? '' : log.dive_details.bottom_time,
                        surface_interval: log.dive_details.surface_interval,
                        previous_pg: log.dive_details.previous_pg,
                        dive_2_depth: log.dive_details.previous_pg ? log.dive_details.max_depth : '',
                        dive_2_time: log.dive_details.previous_pg ? log.dive_details.bottom_time : '',
                    },
                })
                    .then(function (response) {
                        app.update_text = true;
                        log.dive_details.pressure_group = response.data.dive_2_pg || response.data.dive_1_pg;
                        log.dive_details.post_si_pg = response.data.post_si_pg;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                event.preventDefault();
            },
        },

        updated() {
            if (this.update_text) {
                Materialize.updateTextFields();
                this.update_text = false;
            }
        },
        mounted() {
            this.checkUser();
            let datepickers = Materialize.Datepicker.init(document.querySelectorAll('.datepicker'), {
                format: 'yyyy-mm-dd'
            });

            let timepickers = Materialize.Timepicker.init(document.querySelectorAll('.timepicker'), {});

            Materialize.updateTextFields();
            Materialize.textareaAutoResize(document.querySelector('#notes'));
        },
        computed: {
            computed_time_in() {
                return this.dive_log.dive_details.time_in;
            },
            computed_time_out() {
                return this.dive_log.dive_details.time_out;
            },
        },
        watch: {
            computed_time_in() {
                if (this.compute_bottom_time) {
                    this.calculateBottomTime();
                }
            },

            computed_time_out() {
                if (this.compute_bottom_time) {
                    this.calculateBottomTime();
                }
            }
        }
    }
</script>
