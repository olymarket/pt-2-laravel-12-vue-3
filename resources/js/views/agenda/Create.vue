<template>
    <div class="container mt-5">
        <div class="row">
            <div v-if="success" class="alert alert-success">
                {{ success }}
            </div>
            <div v-if="error" class="alert alert-danger">
                {{ error }}
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Create Agenda</h4>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="agendaCreate">
                            <div class="row">
                                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-3">
                                    <div class="form-group">
                                        <label>Name *</label>
                                        <!--<input class="form-control" type="text" minlength="3" maxlength="30" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ ]+" required v-model="agenda.name" placeholder="Enter your name">-->
                                        <input v-model="agenda.name" class="form-control" type="text" placeholder="...">
                                        <small v-if="errors.name" class="text-danger">{{ errors.name[0] }}</small>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-3">
                                    <div class="form-group">
                                        <label>Phone *</label>
                                        <!--<input class="form-control" type="tel" required minlength="10" maxlength="10" pattern="\d{10}" v-model="agenda.phone" placeholder="Enter yout phone">-->
                                        <input v-model="agenda.phone" class="form-control" type="tel" placeholder="...">
                                        <small v-if="errors.phone" class="text-danger">{{ errors.phone[0] }}</small>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-3">
                                    <div class="form-group">
                                        <label>Date *</label>
                                        <!--<input class="form-control" type="date" min="1900-01-01" max="2100-01-01" required v-model="agenda.date">-->
                                        <input v-model="agenda.date" class="form-control" type="date">
                                        <small v-if="errors.date" class="text-danger">{{ errors.date[0] }}</small>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-success me-3"><i class="fas fa-save"></i>
                                        Save</button>
                                    <router-link :to="{ name: 'admin.agenda.index' }" class="btn btn-dark"><i
                                            class="fas fa-arrow-left"></i> Back</router-link>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: "agenda-created",
    data() {
        return {
            agenda: {
                name: "",
                phone: "",
                date: ""
            },
            success: "",
            error: "",
            errors: {},
        };
    },
    methods: {
        agendaCreate() {
            const url = 'http://127.0.0.1:8000/api/v1/agenda-store';
            axios.post(url, this.agenda)
            .then(response => {
                if (response.data.statu === '4') {
                    this.success = response.data.message;
                    setTimeout(() => {
                        this.success = "";
                    }, 4000);
                    this.resetForm();
                    console.log('Success: Data found', response);
                }
            })
            .catch(error => {
                if (error.response.data.statu === '-1') {
                    this.error = error.response.data.message;
                    setTimeout(() => {
                        this.error = "";
                    }, 4000);
                    this.errors = error.response.data.errors;
                    console.log('Error: Validation:', error);
                }
            })
        },
        resetForm() {
            this.agenda = {
                name: "",
                phone: "",
                date: ""
            };
            this.errors = {};
        }
    }
};
</script>