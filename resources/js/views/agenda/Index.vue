<template>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-4">
                <router-link :to="{ name: 'admin.agenda.create' }" class="btn btn-success"><i class="fas fa-plus-circle"></i>
                    Create</router-link>
            </div>
            <div v-if="success" class="alert alert-success">
                {{ success }}
            </div>
            <div v-if="error" class="alert alert-danger">
                {{ error }}
            </div>
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-border">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th># ID</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="agenda in agendas" :key="agenda.idAgenda">
                                <td>{{ agenda.idAgenda }}</td>
                                <td>{{ agenda.name }}</td>
                                <td>{{ agenda.phone }}</td>
                                <td>{{ agenda.date }}</td>
                                <td>
                                    <router-link :to="{ name: 'admin.agenda.edit', params: { id: agenda.idAgenda } }"
                                        class="btn btn-info me-2"><i class="fas fa-edit"></i> Edit</router-link>
                                    <button @click="agendaDelete(agenda.idAgenda)" class="btn btn-danger"><i
                                            class="fas fa-trash"></i> Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    name: "agenda-index",
    data() {
        return {
            agendas: [],
            success: "",
            error: ""
        }
    },
    created() {
        const error = sessionStorage.getItem('postEditError');
        if (error) {
            this.error = error;
            sessionStorage.removeItem('postEditError');
            setTimeout(() => {
                this.error = "";
            }, 4000);
        }
        this.agendaIndex();
    },
    methods: {
        agendaIndex() {
            const url = 'http://127.0.0.1:8000/api/v1/agenda-index';
            axios.get(url)
                .then(response => {
                    if (response.data.statu === '2') {
                        this.agendas = response.data.agendas;
                        this.success = response.data.message;
                        setTimeout(() => {
                            this.success = "";
                        }, 4000);
                        console.log('Exists: Record found', response);
                    }
                })
                .catch(error => {
                    if (error.response.data.statu === '1') {
                        this.error = error.response.data.message;
                        setTimeout(() => {
                            this.error = "";
                        }, 4000);
                        console.log('Error: Data not found', error);
                    }
                });
        },
        agendaDelete(idAgenda) {
            const url = `http://127.0.0.1:8000/api/v1/agenda-delete/${idAgenda}`;
            axios.delete(url)
                .then(response => {
                    if (response.data.statu === '5') {
                        this.agendas = this.agendas.filter(agenda => agenda.idAgenda !== idAgenda);
                        this.error = response.data.message;
                        setTimeout(() => {
                            this.error = "";
                        }, 4000);
                        console.log('Deleted: Record deleted', response);
                    }
                })
                .catch(error => {
                    if (error.response.data.statu === '1') {
                        this.agendas = this.agendas.filter(agenda => agenda.idAgenda !== idAgenda);
                        this.error = error.response.data.message;
                        setTimeout(() => {
                            this.error = "";
                        }, 4000);
                        console.log('Deleted: Record deleted', error);
                    }
                });
        }
    }
}
</script>
