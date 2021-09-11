<template>
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-4 mx-auto bg-white flex flex-col">
            <div class="flex flex-row justify-end">
                <button @click="create"
                        class="flex flex-row gap-2 items-center py-2 px-8 bg-primary-button hover:bg-primary hover:text-white transition duration-150 ease-in-out text-black font-bold rounded-full mb-4 font-sans">
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
                            Doğum Tarihi
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
            <div v-if="current_page_url !== next_page_url || current_page_url !== previous_page_url" class="w-full flex flex-row justify-end gap-2 border-t border-gray-400 pt-4">
                <button :disabled="current_page_url === previous_page_url" @click="loadData(false)"
                    :class="current_page_url === previous_page_url ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : 'bg-primary-button hover:bg-primary hover:text-white cursor-hover'" class="flex flex-row gap-2 items-center py-2 px-8 transition duration-150 ease-in-out text-black font-bold rounded-full font-sans">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Önceki Veriler
                </button>
                <button :disabled="current_page_url === next_page_url" @click="loadData"
                        :class="current_page_url === next_page_url ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : 'bg-primary-button hover:bg-primary hover:text-white cursor-hover'" class="flex flex-row gap-2 items-center py-2 px-8 transition duration-150 ease-in-out text-black font-bold rounded-full font-sans">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    Sonraki Veriler
                </button>
            </div>
        </div>
    </section>
</template>

<script>

export default {
    props: [''],
    data() {
        return {
            current_page: '',
            customers: [],
            current_page_url: '',
            next_page_url: window.baseUrl + 'api/customers/data',
            previous_page_url: '',
        }
    },

    methods: {
        loadData(is_next = true) {
            let url = is_next ? this.next_page_url : this.previous_page_url;
            axios.get(url).then(res => {
                this.customers = res.data.data;
                this.current_page = res.data.current_page;
                this.current_page_url = res.data.path + '?page=' + res.data.current_page;
                this.next_page_url = res.data.next_page_url != null ? res.data.next_page_url : this.current_page_url;
                this.previous_page_url = res.data.current_page > 1 ? res.data.path + `?page=${res.data.current_page - 1}` : res.data.path + `?page=${res.data.current_page}`;
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
