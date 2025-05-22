<template>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-4">
                <router-link :to="{ name: 'agendaCreate' }" class="btn btn-success"><i class="fas fa-plus-circle"></i> New</router-link>
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
                                    <router-link :to="{ name: 'agendaEdit', params: { id: agenda.idAgenda } }" class="btn btn-info"><i class="fas fa-edit"></i> Edit</router-link>
                                    <button @click="agendaDelete(agenda.idAgenda)" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button>
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
    name: "agendaHome",
    data() {
        return {
            agendas: []
        }
    },
    mounted() {
        this.agendaIndex();
    },
    methods: {
        agendaIndex() {
            const url = 'http://127.0.0.1:8000/api/agenda-index';
            axios.get(url)
                .then(response => {
                    this.agendas = response.data.agendas;
                    console.log('Succes index:', response.data.agendas);
                })
                .catch(error => {
                    console.log("Error api: ", error);
                });
        },
        agendaDelete(idAgenda) {
            const url = `http://127.0.0.1:8000/api/agenda-delete/${idAgenda}`;
            axios.delete(url)
                .then(response => {
                    this.agendas = this.agendas.filter(agenda => agenda.idAgenda !== idAgenda);
                    console.log('Success delete:', response);
                })
                .catch(error => {
                    console.log("Error delete: ", error);
                });
        }
    }
}
</script>
