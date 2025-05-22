<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Agenda</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="agendaUpdate">
                        <div class="row">
                            <div class="col-6 mb-2">
                                <div class="form-group">
                                    <label>name</label>
                                    <input class="form-control" type="text" minlength="3" maxlength="30" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ. ]+" required v-model="agenda.name" placeholder="Enter your name">
                                </div>
                            </div>

                            <div class="col-3 mb-2">
                                <div class="form-group">
                                    <label>phone</label>
                                    <input class="form-control" type="tel" required minlength="10" maxlength="10" pattern="\d{10}" v-model="agenda.phone" placeholder="Enter yout phone">
                                </div>
                            </div>

                            <div class="col-3 mb-2">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input class="form-control" type="date" min="1900-01-01" max="2100-01-01" required v-model="agenda.date">
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
                            </div>
                            <div class="col-12 mt-2">
                                <router-link :to="{ name:'agendaHome'}" class="btn btn-dark"><i class="fas fa-arrow-left"></i> Back</router-link>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import axios from 'axios'

export default {
    name: "agendaEdit",
    data() {
        return {
            agenda: {
                name: "",
                phone: "",
                date: ""
            }
        }
    },
    mounted() {
        const idAgenda = this.$route.params.id;
        this.agendaEdit(idAgenda);
    },
    methods: {
        agendaEdit(idAgenda) {
            const url = `http://127.0.0.1:8000/api/agenda-edit/${idAgenda}`
            axios.get(url)
                .then(response => {
                    this.agenda = response.data.agenda;
                    console.log('Success get:', response);
                })
                .catch(error => {
                    console.log('Error edit:', error);
                })
        },
        agendaUpdate() {
        const id = this.$route.params.id;
        const url = `http://127.0.0.1:8000/api/agenda-update/${id}`
        axios.post(url, this.agenda)
            .then(response => {
                //this.$router.push({ name: 'agendaHome' });
                console.log('Success update:', response);
            })
            .catch(error => {
                console.log('Error update:', error);
            })
    }
    }
}
</script>