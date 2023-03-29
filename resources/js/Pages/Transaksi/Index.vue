<template>
    <div class="mt-5">
        <!-- flash message -->
        <div v-if="$page.props.flash.message" class="alert alert-success" role="alert">
            {{ $page.props.flash.message }}
        </div>
        <!-- flash message -->
        <div class="mb-3">
            <Link href="/transactions/create" class="btn btn-md btn-primary">TAMBAH
            TRANSAKSI</Link>
        </div>

        <div class="card border-0 rounded shadow-sm">
            <div class="card-body">
                <h4>Daftar Transaksi</h4>
                <hr>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Tanggal Transaksi</th>
                            <th scope="col">ID Karyawan</th>
                            <th scope="col">Total Transaksi</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="transaction, index in transactions" :key="transaction.id">
                            <td>{{ index + 1 }}</td>
                            <td>{{ transaction.tanggal_belanja }}</td>
                            <td>{{ transaction.id_karyawan }}</td>
                            <td>{{ transaction.total_belanja }}</td>
                            <td class="text-center">
                                <Link :href="`/transactions/${transaction.id}`" class="btn btn-sm btn-primary me-2">DETAIL
                                </Link>
                                <!-- <Link :href="`/transactions/${transaction.id}/edit`" class="btn btn-warning btn-sm"
                                    style="margin-right: 5px;">
                                EDIT
                                </Link> -->
                                <button @click.prevent="deleteTransaction(`${transaction.id}`)"
                                    class="btn btn-sm btn-danger">DELETE</button>
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
import { Inertia } from '@inertiajs/inertia';

export default {

    //layout
    layout: LayoutApp,

    //register Link di component
    components: {
        Link
    },

    //props
    props: {
        transactions: Object // <- nama props yang dibuat di controller saat parsing data
    },

    setup() {
        function deleteTransaction(id) {
            Inertia.delete(`/transactions/${id}`)
        }

        return {
            deleteTransaction
        }
    }
}
</script>

<style></style>
