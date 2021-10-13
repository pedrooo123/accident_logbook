<template>
    <div>
        <h3 class="text-center">All Logs</h3><br/>

        <router-link to="/create" class="btn btn-success py-2 px-3 my-3">Create Log</router-link>


        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>Location</th>
                <th>Licence Plate</th>
                <th>Flight Number</th>
                <th>Injured People</th>
                <th>Description</th>
                <th>Date</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="log in logs" :key="log.id">
                <td>{{ log.id }}</td>
                <td>{{ log.type }}</td>
                <td>{{ log.location }}</td>
                <td>{{ log.licence_plate }}</td>
                <td>{{ log.flight_number }}</td>
                <td>{{ log.injured_people }}</td>
                <td>{{ log.description }}</td>
                <td>{{ log.date }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'edit', params: { id: log.id }}" class="btn btn-primary">Edit
                        </router-link>
                        <button class="btn btn-danger" @click="deleteLog(log.id)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                logs: []
            }
        },
        created() {
            this.axios
                .get('/api/logs')
                .then(response => {
                    this.logs = response.data;
                });
        },
        methods: {
            deleteLog(id) {
                this.axios
                    .delete(`/api/log/destroy/${id}`)
                    .then(response => {
                        let i = this.logs.map(item => item.id).indexOf(id); // find index of your object
                        this.logs.splice(i, 1)
                    });
            }
        }
    }
</script>
