<template>
    <div class="mt-5">
        <!-- flash message -->
        <div v-if="$page.props.flash.message" class="alert alert-success" role="alert">
            {{ $page.props.flash.message }}
        </div>
        <!-- flash message -->
        <div class="mb-3">
            <Link href="/karyawans/create" class="btn btn-md btn-primary">TAMBAH
            KARYAWAN</Link>
        </div>

        <div class="card border-0 rounded shadow-sm">
            <div class="card-body">
                <h4>Daftar Karyawan</h4>
                <hr>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Karyawan</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="karyawan, index in karyawans" :key="karyawan.id">
                            <td>{{ index + 1 }}</td>
                            <td>{{ karyawan.nama_karyawan }}</td>
                            <td>{{ karyawan.alamat }}</td>
                            <td class="text-center">
                                <Link :href="`/karyawans/${karyawan.id}/edit`" class="btn btn-warning btn-sm"
                                    style="margin-right: 5px;">
                                EDIT
                                </Link>
                                <button @click.prevent="deleteKaryawan(`${karyawan.id}`)"
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
        karyawans: Object // <- nama props yang dibuat di controller saat parsing data
    },

    setup() {
        function deleteKaryawan(id) {
            Inertia.delete(`/karyawans/${id}`)
        }

        return {
            deleteKaryawan
        }
    }
}
</script>

<style></style>
