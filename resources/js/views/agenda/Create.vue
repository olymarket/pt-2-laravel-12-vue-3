<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Create Agenda</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="agendacreate">
                        <div class="row">
                            <div class="col-6 mb-2">
                                <div class="form-group">
                                    <label>name</label>
                                    <!--<input class="form-control" type="text" minlength="3" maxlength="30" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ ]+" required v-model="agenda.name" placeholder="Enter your name">-->
                                    <input class="form-control" type="text" v-model="agenda.name"
                                        placeholder="Enter your name">
                                    <small v-if="errors.name" class="text-danger">{{ errors.name[0] }}</small>
                                </div>
                            </div>

                            <div class="col-3 mb-2">
                                <div class="form-group">
                                    <label>phone</label>
                                    <!--<input class="form-control" type="tel" required minlength="10" maxlength="10" pattern="\d{10}" v-model="agenda.phone" placeholder="Enter yout phone">-->
                                    <input class="form-control" type="tel" v-model="agenda.phone"
                                        placeholder="Enter yout phone">
                                    <small v-if="errors.phone" class="text-danger">{{ errors.phone[0] }}</small>
                                </div>
                            </div>
                            <div class="col-3 mb-2">
                                <div class="form-group">
                                    <label>Date</label>
                                    <!--<input class="form-control" type="date" min="1900-01-01" max="2100-01-01" required v-model="agenda.date">-->
                                    <input class="form-control" type="date" v-model="agenda.date">
                                    <small v-if="errors.date" class="text-danger">{{ errors.date[0] }}</small>
                                </div>
                            </div>
                            <div v-if="create" class="alert alert-success">
                                {{ create }}
                            </div>
                            <div v-if="validation" class="alert alert-danger">
                                {{ validation }}
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
                            </div>
                            <div class="col-12 mt-2">
                                <router-link :to="{ name: 'agendaHome' }" class="btn btn-dark"><i
                                        class="fas fa-arrow-left"></i> Back</router-link>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: "agendaCreate",
    data() {
        return {
            agenda: {
                name: "",
                phone: "",
                date: ""
            },
            errors: {}, 
            create: "",
            validation: ""
        };
    },
    methods: {
        agendacreate() {
            const url = 'http://127.0.0.1:8000/api/v1/agenda-store';
            axios.post(url, this.agenda)
                .then(response => {
                    if(response.data.statu === '3'){
                        this.create = error.response.data.message;
                        setTimeout(() => {
                            this.create = "";
                        }, 3000);
                        this.agenda = response.data.agenda;
                        this.resetForm();
                        console.log('Success: Data found', response);
                    }
                })
                .catch(error => {
                    if (error.response.data.statu === '2') {
                        this.validation = error.response.data.message;
                        setTimeout(() => {
                            this.validation = "";
                        }, 3000);
                        this.errors = error.response.data.errors;
                        console.log('Error: Validation:', error);
                    }
                });
        },
        resetForm() {
            this.agenda = {
                name: "",
                phone: "",
                date: ""
            };
        }
    }
};
</script>