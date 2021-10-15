<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card card-default my-5">
                    <div class="card-header">All Logs</div>
                    <div class="card-body">
                        <router-link to="/create" v-if="isLoggedIn" class="btn btn-success py-2 px-3 my-3">Create Log</router-link>
                        <!-- Datatable -->
                        <table id="datatable" class="display responsive nowrap" style="width: 100%;">
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
                                    <th v-if="isLoggedIn"></th>
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
                                    <td v-if="isLoggedIn">
                                        <div class="btn-group" role="group">
                                            <router-link :to="{name: 'edit', params: { id: log.id }}" class="btn btn-primary mr-1" title="Edit Log"><i class="bi bi-pencil-square"></i>
                                            </router-link>
                                            <button class="btn btn-danger" title="Delete Log" @click="deleteLog(log.id)"><i class="bi bi-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import "datatables.net-bs4/js/dataTables.bootstrap4.js";
import "datatables.net-bs4/css/dataTables.bootstrap4.min.css";

import "datatables.net-responsive-bs4/js/responsive.bootstrap4.js";
import "datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css";

    export default {
        data() {
            return {
                logs: [],
                isLoggedIn: false,
            }
        },
        created() {
            if (window.Laravel.isLoggedin) {
                this.isLoggedIn = true
            }
            this.axios
                .get('/api/logs')
                .then(response => {
                    this.logs = response.data;
                    setTimeout(() => {
                        $("#datatable").DataTable({
                            lengthMenu: [
                            [5,10, 25, 50, -1],
                            [5,10, 25, 50, "All"],
                            ],
                            pageLength: 10,
                            responsive: true,
                            columnDefs: [
                                { responsivePriority: 1, targets: 0 },
                                { responsivePriority: 2, targets: -1 }
                            ]
                        });
                    });
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
