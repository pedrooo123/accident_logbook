<template>
    <div>
        <h3 class="text-center">Edit Log</h3>
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <form @submit.prevent="updateLog">
                    <div class="form-group">
                        <label>Type</label>
                        <select class="form-control" :class="{ 'is-invalid': errors.get('type') }" v-model="log.type">
                            <option>Air accident</option>
                            <option>Train crash</option>
                            <option>Road crash</option>
                        </select>
                        <span v-text="errors.get('type')" class="invalid-feedback d-block"></span> <!-- Handling validation messages -->
                    </div>
                    <div class="form-group">
                        <label>Location</label>
                        <input type="text" class="form-control" :class="{ 'is-invalid': errors.get('location') }" v-model="log.location">
                        <span v-text="errors.get('location')" class="invalid-feedback d-block"></span>
                    </div>
                    <div class="form-group">
                        <label>Licence plate</label>
                        <input type="text" class="form-control" :class="{ 'is-invalid': errors.get('licence_plate') }" v-model="log.licence_plate">
                        <span v-text="errors.get('licence_plate')" class="invalid-feedback d-block"></span>
                    </div>
                    <div class="form-group">
                        <label>Flight number</label>
                        <input type="text" class="form-control" :class="{ 'is-invalid': errors.get('flight_number') }" v-model="log.flight_number">
                        <span v-text="errors.get('flight_number')" class="invalid-feedback d-block"></span>
                    </div>
                    <div class="form-group">
                        <label>Injured people</label>
                        <input type="text" class="form-control" :class="{ 'is-invalid': errors.get('injured_people') }" v-model="log.injured_people">
                        <span v-text="errors.get('injured_people')" class="invalid-feedback d-block"></span>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" :class="{ 'is-invalid': errors.get('description') }" v-model="log.description">
                        <span v-text="errors.get('description')" class="invalid-feedback d-block"></span>
                    </div>
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" class="form-control" :class="{ 'is-invalid': errors.get('date') }" v-model="log.date" min="1000-01-01" max="9999-12-31">
                        <span v-text="errors.get('date')" class="invalid-feedback d-block"></span>
                    </div>
                    <button type="submit" class="btn btn-primary">Edit Log</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    // Handling validation messages
    class Errors {
        constructor(){
            this.errors = {};
        }
        get(field){
            if (this.errors[field]){
                return this.errors[field][0];
            }
        }
        record(errors){
            this.errors = errors;
        }
    }

    export default {
        data() {
            return {
                log: {},
                errors: new Errors() // Handling validation messages
            }
        },
        created() {
            this.axios
                .get(`/api/log/edit/${this.$route.params.id}`)
                .then((response) => {
                    this.log = response.data;
                });
        },
        methods: {
            updateLog() {
                this.axios
                    .post(`/api/log/update/${this.$route.params.id}`, this.log)
                    .then((response) => {
                        this.$router.push({name: 'home'});
                    })
                    .catch( error => this.errors.record(error.response.data.errors) ); // Handling validation messages
            }
        }
    }
</script>
