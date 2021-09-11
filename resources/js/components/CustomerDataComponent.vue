<template>
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-4 mx-auto bg-white">
            <div class="flex flex-row justify-end">
                <button @click="create"
                        class="flex flex-row gap-2 items-center py-2 px-8 bg-primary-button transition duration-150 ease-in-out text-black font-bold rounded-full mb-4 font-sans">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Yeni Kayıt
                </button>
            </div>
            <div class="w-full mx-auto overflow-auto">
                <table class="table-auto w-full text-left whitespace-no-wrap">
                    <thead>
                    <tr>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">
                            Tam Adı
                        </th>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                            Email Adresi
                        </th>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                            GSM Numarası
                        </th>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                            Birimi
                        </th>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                            Doğum Günü
                        </th>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                            Kayıt Tarihi
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="customer in customers">
                        <td class="px-4 py-3">{{ customer.name }}</td>
                        <td class="px-4 py-3">{{ customer.email }}</td>
                        <td class="px-4 py-3">{{ customer.gsm_no }}</td>
                        <td class="px-4 py-3">{{ customer.department.name }}</td>
                        <td class="px-4 py-3">{{ customer.birthday }}</td>
                        <td class="px-4 py-3">{{ customer.created_at }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</template>

<script>

export default {
    props: [''],
    data() {
        return {
            customers: [],
        }
    },

    methods: {
        loadData() {
            axios.get(window.baseUrl + 'api/customers/data').then(res => {
                this.customers = res.data;
            }).catch(e => console.log(e.message))
        },
        create() {
            Fire.$emit('create');
        }
    },
    mounted() {
        this.loadData();

        Fire.$on('create-success', () => {
            this.loadData();
        })
    }
}
</script>
