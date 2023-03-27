<template>
    <div>
        <div class="card border-0 rounded shadow">
            <div class="card-body">
                <h4>TAMBAH KARYAWAN</h4>
                <hr>
                <form @submit.prevent="storeKaryawan">
                    <div class="mb-3">
                        <label class="form-label">Nama Karyawan</label>
                        <input type="text" class="form-control" v-model="karyawan.nama_karyawan"
                            placeholder="Masukkan Nama Karyawan">
                        <div v-if="errors.title" class="mt-2 alert alert-danger">
                            {{ errors.title }}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <input type="text" class="form-control" v-model="karyawan.alamat" placeholder="Masukkan Alamat">
                        <div v-if="errors.title" class="mt-2 alert alert-danger">
                            {{ errors.title }}
                        </div>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary btn-md shadow-sm me-2"
                            v-if="karyawan.id">UPDATE</button>
                        <button type="submit" class="btn btn-primary btn-md shadow-sm me-2" v-else>SIMPAN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
//import layout
import LayoutApp from '../../Layouts/App.vue'

import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'

export default {

    //layout
    layout: LayoutApp,

    //props
    props: {
        errors: Object,
        karyawan: Object
    },

    //define Composition Api
    setup(props) {

        //state karyawan
        const karyawan = reactive({
            id: props.karyawan.id,
            nama_karyawan: props.karyawan.nama_karyawan,
            alamat: props.karyawan.alamat,
        })

        //function storeKaryawan
        function storeKaryawan() {

            //define variable
            let data = {
                nama_karyawan: karyawan.nama_karyawan,
                alamat: karyawan.alamat
            }

            //send data
            const id = props.karyawan.id
            if (id) {
                Inertia.put('/karyawans/' + id, data)
            } else {
                Inertia.post('/karyawans/', data)
            }
        }

        return {
            karyawan,
            storeKaryawan,
        }

    },
}
</script>
