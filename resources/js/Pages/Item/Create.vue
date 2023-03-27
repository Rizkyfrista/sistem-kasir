<template>
    <div>
        <div class="card border-0 rounded shadow">
            <div class="card-body">
                <h4>TAMBAH ITEM</h4>
                <hr>
                <form @submit.prevent="storeItem">
                    <div class="mb-3">
                        <label class="form-label">Nama Item</label>
                        <input type="text" class="form-control" v-model="item.nama_item" placeholder="Masukkan Nama Item">
                        <div v-if="errors.title" class="mt-2 alert alert-danger">
                            {{ errors.title }}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Harga Item</label>
                        <input type="text" class="form-control" v-model="item.harga_item" placeholder="Masukkan Harga Item">
                        <div v-if="errors.title" class="mt-2 alert alert-danger">
                            {{ errors.title }}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Satuan</label>
                        <input type="text" class="form-control" v-model="item.satuan" placeholder="Masukkan Satuan Item">
                        <div v-if="errors.title" class="mt-2 alert alert-danger">
                            {{ errors.title }}
                        </div>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary btn-md shadow-sm me-2" v-if="item.id">UPDATE</button>
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
        item: Object
    },

    //define Composition Api
    setup(props) {

        //state item
        const item = reactive({
            id: props.item.id,
            nama_item: props.item.nama_item,
            harga_item: props.item.harga_item,
            satuan: props.item.satuan,
        })

        //function storeItem
        function storeItem() {

            //define variable
            let data = {
                nama_item: item.nama_item,
                harga_item: item.harga_item,
                satuan: item.satuan
            }

            //send data
            const id = props.item.id
            if (id) {
                Inertia.put('/items/' + id, data)
            } else {
                Inertia.post('/items/', data)
            }
        }

        return {
            item,
            storeItem,
        }

    },
}
</script>
