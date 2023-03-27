<template>
    <div class="mt-5">
        <!-- flash message -->
        <div v-if="$page.props.flash.message" class="alert alert-success" role="alert">
            {{ $page.props.flash.message }}
        </div>
        <!-- flash message -->
        <div class="mb-3">
            <Link href="/items/create" class="btn btn-md btn-primary">TAMBAH
            ITEM</Link>
        </div>

        <div class="card border-0 rounded shadow-sm">
            <div class="card-body">
                <h4>Daftar Items</h4>
                <hr>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Item</th>
                            <th scope="col">Harga Item</th>
                            <th scope="col">Satuan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item, index in items" :key="item.id">
                            <td>{{ index + 1 }}</td>
                            <td>{{ item.nama_item }}</td>
                            <td>{{ item.harga_item }}</td>
                            <td>{{ item.satuan }}</td>
                            <td class="text-center">
                                <Link :href="`/items/${item.id}/edit`" class="btn btn-warning btn-sm"
                                    style="margin-right: 5px;">
                                EDIT
                                </Link>
                                <button @click.prevent="deleteItem(`${item.id}`)"
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
        items: Object // <- nama props yang dibuat di controller saat parsing data
    },

    setup() {
        function deleteItem(id) {
            Inertia.delete(`/items/${id}`)
        }

        return {
            deleteItem
        }
    }
}
</script>

<style></style>
