<template>
  <section class="text-gray-600 body-font">
    <div class="container px-5 py-4 mx-auto bg-white">
      <div class="flex flex-row justify-end">
        <button @click="cancel"
                class="flex flex-row gap-2 items-center py-2 px-8 bg-primary-button transition duration-150 ease-in-out text-black font-bold rounded-full mb-4 font-sans">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
          </svg>
          Mevcut Kayıtlar
        </button>
      </div>
      <form @submit.prevent="saveCustomerData" class="flex flex-col gap-y-4">
        <div class="grid grid-cols-2 gap-2 gap-y-4">
          <div class="w-full flex flex-col gap-1">
            <label for="name" class="text-lg font-bold text-gray-600">Müşterinin Tam Adı:</label>
            <input type="text" id="name" name="name" v-model="form.name"
                   class="flex-1 bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
            <div class="text-red-500" v-if="form.errors.has('name')" v-html="form.errors.get('name')" />
          </div>
          <div class="w-full flex flex-col gap-1">
            <label for="email" class="text-lg font-bold text-gray-600">Müşterinin Email Adresi:</label>
            <input type="text" id="email" name="email" v-model="form.email"
                   class="flex-1 bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
            <div class="text-red-500" v-if="form.errors.has('email')" v-html="form.errors.get('email')" />
          </div>
          <div class="w-full flex flex-col gap-1">
            <label for="gsm" class="text-lg font-bold text-gray-600">Müşterinin GSM Numarası:</label>
            <input type="text" id="gsm" name="gsm" v-model="form.gsm"
                   class="flex-1 bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
            <div class="text-red-500" v-if="form.errors.has('gsm')" v-html="form.errors.get('gsm')" />
          </div>
          <div class="w-full flex flex-col gap-1">
            <label for="birthday" class="text-lg font-bold text-gray-600">Müşterinin Doğum Tarihi:</label>
            <input type="date" id="birthday" name="date" v-model="form.birthday"
                   class="flex-1 bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
            <div class="text-red-500" v-if="form.errors.has('birthday')" v-html="form.errors.get('birthday')" />
          </div>
          <div class="w-full flex flex-col gap-1">
            <label for="department" class="text-lg font-bold text-gray-600">Müşterinin Birimi:</label>
            <select id="department" name="department" v-model="form.department"
                    class="flex-1 bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
              <option :value="department.id" v-for="department in departments">{{ department.name }}</option>
            </select>
            <div class="text-red-500" v-if="form.errors.has('department')" v-html="form.errors.get('department')" />
          </div>
        </div>
        <div class="flex justify-end border-t border-gray-200 pt-4">
          <button class="flex flex-row gap-2 items-center py-2 px-8 bg-primary-button transition duration-150 ease-in-out text-black font-bold rounded-full font-sans">
            Kaydet
          </button>
        </div>
      </form>
    </div>
  </section>
</template>

<script>

import {Form, HasError, AlertError} from 'vform'

export default {
  props: [''],
  data() {
    return {
      departments: [],
      form: new Form({
        id: '',
        name: '',
        email: '',
        gsm: '',
        birthday: '',
        department: '',
      }),
    }
  },

  methods: {
    getDepartments() {
      axios.get(window.baseUrl + 'api/departments').then(res => {
        this.departments = res.data;

        // Default Select First Deparment If Department Is Not Set Before -> Mostly For Editing Purposes
        this.form.department = (this.form.department === '' && res.data.length) > 0 ? res.data[0].id : '';
      }).catch(e => console.log(e.message))
    },

    saveCustomerData() {
      this.form.post(window.baseUrl + "api/customer/store").then(res => {
        console.log(res.data);
      }).catch(() => {
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
