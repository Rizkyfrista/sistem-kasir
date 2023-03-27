<template>
    <div class="mt-5">
        <!-- flash message -->
        <div v-if="$page.props.flash.message" class="alert alert-success" role="alert">
            {{ $page.props.flash.message }}
        </div>
        <!-- flash message -->

        <div class="card border-0 rounded shadow-sm">
            <div class="card-body">
                <h4>Details</h4>
                <hr>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Item</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="detail in details" :key="detail.id">
                            <td>{{ detail.item }}</td>
                            <td>{{ detail.quantity }}</td>
                            <td>{{ detail.jumlah }}</td>
                            <td class="text-center">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
//import layout
import LayoutApp from '../../Layouts/App.vue'

//import Link dari inertia
import { Link } from '@inertiajs/inertia-vue3';

import { Inertia } from '@inertiajs/inertia'

export default {

    //layout
    layout: LayoutApp,

    //register Link di component
    components: {
        Link
    },

    //props
    props: {
        details: Array, // <- nama props yang dibuat di controller saat parsing data
    },

    //define Composition Api
    setup() {

        //method deleteDetail
        function deleteDetail(id) {

            Inertia.delete(`/transactions/${id}`)

        }

        return {
            deleteDetail
        }

    },

}
</script>

<style></style>
