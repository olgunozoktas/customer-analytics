<template>
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-4 mx-auto bg-white">
            <div class="flex flex-row justify-end mb-4">

            </div>
            <form @submit.prevent="saveCustomerData" class="flex flex-col gap-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2 gap-y-4">
                    <div class="w-full flex flex-col gap-1">
                        <label for="name" class="text-lg font-bold text-gray-600">Müşterinin Tam Adı:</label>
                        <input type="text" id="name" name="name" v-model="form.name"
                               class="flex-1 bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        <div class="text-red-500" v-if="form.errors.has('name')" v-html="form.errors.get('name')"/>
                    </div>
                    <div class="w-full flex flex-col gap-1">
                        <label for="email" class="text-lg font-bold text-gray-600">Müşterinin Email Adresi:</label>
                        <input type="text" id="email" name="email" v-model="form.email"
                               class="flex-1 bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        <div class="text-red-500" v-if="form.errors.has('email')" v-html="form.errors.get('email')"/>
                    </div>
                    <div class="w-full flex flex-col gap-1">
                        <label for="gsm_no" class="text-lg font-bold text-gray-600">Müşterinin GSM Numarası:</label>
                        <input type="text" id="gsm_no" name="gsm_no" v-model="form.gsm_no"
                               class="flex-1 bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        <div class="text-red-500" v-if="form.errors.has('gsm_no')" v-html="form.errors.get('gsm_no')"/>
                    </div>
                    <div class="w-full flex flex-col gap-1">
                        <label for="birthday" class="text-lg font-bold text-gray-600">Müşterinin Doğum Tarihi:</label>
                        <input type="date" id="birthday" name="birthday" v-model="form.birthday"
                               class="flex-1 bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        <div class="text-red-500" v-if="form.errors.has('birthday')"
                             v-html="form.errors.get('birthday')"/>
                    </div>
                    <div class="w-full flex flex-col gap-1">
                        <label for="department_id" class="text-lg font-bold text-gray-600">Müşterinin Birimi:</label>
                        <select id="department_id" name="department_id" v-model="form.department_id"
                                class="flex-1 bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            <option :value="department.id" v-for="department in departments">{{
                                    department.name
                                }}
                            </option>
                        </select>
                        <div class="text-red-500" v-if="form.errors.has('department_id')"
                             v-html="form.errors.get('department_id')"/>
                    </div>
                </div>
                <div class="flex flex-col flex-col-reverse md:flex-row gap-2 justify-between border-t border-gray-200 pt-4">
                    <button @click="cancel"
                            class="flex flex-row gap-2 justify-center md:justify-start items-center py-2 px-8 h-12 bg-primary-button hover:bg-primary hover:text-white transition duration-150 ease-in-out text-black font-bold rounded-full font-sans">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Mevcut Kayıtlar
                    </button>
                    <div class="flex flex-col md:flex-row gap-2">
                        <div class="flex flex-row items-center gap-2">
                            <p class="bg-primary text-white py-2 px-4 rounded-lg">{{ this.captcha }}</p>
                            <div class="w-full flex flex-col gap-1">
                                <input type="text" id="captcha" name="date" v-model="form.captcha"
                                       placeholder="Doğrulama Kodunu Giriniz"
                                       class="flex-1 bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                        </div>
                        <button
                            class="flex flex-row gap-2 justify-center md:justify-start items-center py-2 px-8 h-12 bg-primary-button hover:bg-primary hover:text-white transition duration-150 ease-in-out text-black font-bold rounded-full font-sans">
                            Kaydet
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</template>

<script>

import {Form} from 'vform'

const success = 'success';
const error = 'error';
const warning = 'warning';

const warningMessage = 'Lütfen Gönderdiğiniz Verileri Kontrol Ediniz.';
const missingCaptchaCode = 'Doğrulama Kodunu Girmelisiniz.';

const unprocessableEntity = 422;

export default {
    props: ['captcha'],
    data() {
        return {
            departments: [],
            form: new Form({
                id: '',
                name: '',
                email: '',
                gsm_no: '',
                birthday: '',
                department_id: '',
                captcha: '',
            }),
        }
    },

    methods: {
        getDepartments() {
            axios.get(window.baseUrl + 'departments').then(res => {
                this.departments = res.data;

                // Default Select First Deparment If Department Is Not Set Before -> Mostly For Editing Purposes
                this.form.department_id = (this.form.department_id === '' && res.data.length) > 0 ? res.data[0].id : '';
            }).catch(e => console.log(e.message))
        },

        saveCustomerData() {
            if (this.form.captcha === '') {
                toast.fire({
                    position: "top",
                    icon: warning,
                    title: missingCaptchaCode
                });

                return;
            }

            this.form.post(window.baseUrl + "customer/store").then(res => {
                toast.fire({
                    position: "top",
                    icon: res.data.response,
                    title: res.data.message
                });

                if (res.data.response === success) {
                    this.form.clear();
                    Fire.$emit('create-success');
                }
            }).catch((e) => {
                let errors = e.response.data.errors;

                if (e.response.status === unprocessableEntity) {
                    toast.fire({
                        position: "top",
                        icon: warning,
                        title: (errors.captcha !== undefined && errors.length === 0) ? e.response.data.errors.captcha : warningMessage
                    });
                }
            });
        },

        cancel() {
            Fire.$emit('cancel');
        }
    },
    mounted() {
        this.getDepartments();
    }
}
</script>
