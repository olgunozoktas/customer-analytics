<template>
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-4 mx-auto bg-white">
            <div v-if="!create && !edit">
                <customer-data-component/>
            </div>
            <div v-if="create">
                <create-customer-component/>
            </div>
        </div>
    </section>
</template>

<script>

import CustomerDataComponent from "./CustomerDataComponent";
import CreateCustomerComponent from "./CreateCustomerComponent";

export default {
    components: {
        'customer-data-component': CustomerDataComponent,
        'create-customer-component': CreateCustomerComponent,
    },
    props: [''],
    data() {
        return {
            edit: false,
            create: true,
        }
    },

    methods: {
        createNew() {
            this.create = !this.create;
        }
    },
    mounted() {
        Fire.$on(['cancel', 'create', 'create-success'], (e) => {
            this.createNew();
        });
    }
}
</script>
