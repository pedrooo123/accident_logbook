<template>
    <div>
        <h3 class="text-center">Edit Log</h3>
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <form @submit.prevent="updateLog">
                    <div class="form-group">
                        <label>Type</label>
                        <input type="text" class="form-control" v-model="log.type">
                    </div>
                    <div class="form-group">
                        <label>Location</label>
                        <input type="text" class="form-control" v-model="log.location">
                    </div>
                    <div class="form-group">
                        <label>Licence plate</label>
                        <input type="text" class="form-control" v-model="log.licence_plate">
                    </div>
                    <div class="form-group">
                        <label>Flight number</label>
                        <input type="text" class="form-control" v-model="log.flight_number">
                    </div>
                    <div class="form-group">
                        <label>Injured people</label>
                        <input type="text" class="form-control" v-model="log.injured_people">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" v-model="log.description">
                    </div>
                    <div class="form-group">
                        <label>Date</label>
                        <input type="text" class="form-control" v-model="log.date">
                    </div>
                    <button type="submit" class="btn btn-primary">Edit Log</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                log: {}
            }
        },
        created() {
            this.axios
                .get(`/api/log/edit/${this.$route.params.id}`)
                .then((response) => {
                    this.log = response.data;
                    // console.log(response.data);
                });
        },
        methods: {
            updateLog() {
                this.axios
                    .post(`/api/log/update/${this.$route.params.id}`, this.log)
                    .then((response) => {
                        this.$router.push({name: 'home'});
                    });
            }
        }
    }
</script>
