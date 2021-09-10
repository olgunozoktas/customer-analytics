<template>
    <div class="flex flex-col text-2xl text-gray-800">
        <h1 class="w-full bg-white shadow py-2 px-4 rounded-lg">Müşteriler Listesi</h1>
    </div>
</template>

<script>

export default {
    props: [''],
    data() {
        return {
            customers: []
        }
    },

    methods: {
        loadData() {
            axios.get(window.baseUrl + 'api/customers/data').then(res => {
                console.log(res.data);
            }).catch(e => console.log(e.message))
        }
    },
    mounted() {
        this.loadData();
    }
}
</script>
