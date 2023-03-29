<template>
    <div>
        <div class="card border-0 rounded shadow">
            <div class="card-body">
                <h4>TAMBAH TRANSAKSI</h4>
                <hr>
                <form @submit.prevent="storeTransaction">
                    <!-- <div class="mb-3">
                        <label class="form-label">Tanggal Transaksi</label>
                        <input name="tgl_transaksi" type="datetime-local" class="form-control"
                            v-model="transaction.tanggal_belanja">
                        <div v-if="errors.title" class="mt-2 alert alert-danger">
                            {{ errors.title }}
                        </div>
                    </div> -->

                    <!-- KARYAWAN DROP DOWN -->
                    <div class="mb-3">
                        <label class="form-label">Karyawan</label>
                        <select id="karyawan" name="karyawan" class="form-control" v-model="transaction.id_karyawan">
                            <option v-for="karyawan in karyawans" :value="karyawan.id">
                                {{ karyawan.nama_karyawan }}
                            </option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Total Transaksi</label>
                        <input name="total_transaksi" type="number" class="form-control" v-model="transaction.total_belanja"
                            readonly>
                        <div v-if="errors.title" class="mt-2 alert alert-danger">
                            {{ errors.title }}
                        </div>
                    </div>


                    <!-- <form @submit.prevent="storeDetail"> -->
                    <div class="mb-3">
                        <h4>Detail Belanja</h4>
                        <hr>

                        <!-- ITEM DROP DOWN -->
                        <label class="form-label">Item</label>
                        <select id="item" name="item" class="form-control" v-model="transaction.store_detail_form.item">
                            <option v-for="item in items" :value="item.id">
                                {{ item.nama_item }} | Rp. {{ item.harga_item }}
                            </option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Quantity</label>
                        <input name="quantity" type="number" class="form-control"
                            v-model="transaction.store_detail_form.quantity">
                        <div v-if="errors.title" class="mt-2 alert alert-danger">
                            {{ errors.title }}
                        </div>
                    </div>

                    <div class="mb-3">
                        <button type="button" class="btn btn-primary btn-md shadow-sm me-2" @click="storeDetail">TAMBAH DATA
                            DETAIL</button>
                    </div>
                    <!-- </form> -->

                    <div class="card border-0 rounded shadow-sm">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Item</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="detail in transaction.store_detail_data" :key="detail.nama_item">
                                        <td>{{ detail.nama_item }}</td>
                                        <td>{{ detail.quantity }}</td>
                                        <td>{{ detail.jumlah }}</td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-primary me-2"
                                                v-on:click.prevent="editDetail(`${detail.nama_item}`)">Edit</button>
                                            <button class="btn btn-sm btn-danger"
                                                v-on:click.prevent="deleteDetail(`${detail.nama_item}`)">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary btn-md shadow-sm me-2"
                            v-if="transaction.id">UPDATE</button>
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
        transaction: Object,
        karyawans: Object,
        items: Object
    },

    //define Composition Api
    setup(props) {

        //state transaction
        const transaction = reactive({
            id: props.transaction.id,
            tanggal_belanja: props.transaction.tanggal_belanja,
            id_karyawan: props.transaction.id_karyawan,
            total_belanja: props.transaction.total_belanja ?? 0,
            store_detail_form: {},
            store_detail_data: []
        })

        //function storeTransaction
        function storeTransaction() {

            //define variable
            let data = {
                tanggal_belanja: transaction.tanggal_belanja,
                id_karyawan: transaction.id_karyawan,
                total_belanja: transaction.total_belanja,
                detail: transaction.store_detail_data
            }

            //send data
            const id = props.transaction.id
            if (id) {
                Inertia.put('/transactions/' + id, data)
            } else {
                Inertia.post('/transactions/', data)
            }
        }

        //function storeDetail
        function storeDetail() {
            let oitem = props.items.filter(item => { return item.id == transaction.store_detail_form.item })[0];
            let jumlah = transaction.store_detail_form.quantity * oitem.harga_item
            transaction.total_belanja += jumlah
            transaction.store_detail_form['jumlah'] = jumlah
            transaction.store_detail_form['nama_item'] = oitem.nama_item
            console.log(oitem, transaction.store_detail_form.item);
            console.log(transaction.store_detail_form);
            transaction.store_detail_data.push(transaction.store_detail_form);
            transaction.store_detail_form = {}
        }

        function editDetail(id) {
            for (var i = 0; i < transaction.store_detail_data.length; i++) {

                if (Object.values(transaction.store_detail_data[i]).indexOf(id) !== -1) {
                    transaction.store_detail_form.item = transaction.store_detail_data[i].item
                    transaction.store_detail_form.quantity = transaction.store_detail_data[i].quantity
                    transaction.store_detail_form.jumlah = transaction.store_detail_data[i].jumlah
                    console.log('data ditemukan')
                    transaction.store_detail_data.splice(i, 1);
                } else {
                    console.log('data tidak ditemukan')
                }
            }
        }

        function deleteDetail(id) {
            for (var i = 0; i < transaction.store_detail_data.length; i++) {

                if (Object.values(transaction.store_detail_data[i]).indexOf(id) !== -1) {
                    console.log('data ditemukan')
                    transaction.store_detail_data.splice(i, 1);
                } else {
                    console.log('data tidak ditemukan')
                }
            }
        }

        return {
            transaction,
            storeTransaction,
            storeDetail,
            editDetail,
            deleteDetail
        }

    },
}
</script>
