<template>
    <div class="container" id="Ordering">
        <h3 class="text-center">You're ordering <b>{{foodName}}</b></h3>
        <div class="row justify-content-center mb-5">
            <div class="col-12 col-md-6">
                <label for="qty">Qty</label>
                <div class="input-group">
                    <input id="qty" type="text" v-model="qty" class="form-control" placeholder="Qty" aria-label="Qty" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="button" @click="onCount('minus') "><i class="fa fa-minus"></i></button>
                        <button class="btn btn-outline-primary" type="button" @click="onCount('plus')"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <p class="total">Total:&nbsp;<b>${{total}}</b></p>
            </div>
        </div>
        <div class="row justify-content-center footer">
            <div class="col-12 col-md-6 d-block d-md-flex flex-row-reverse">
                <button class="btn btn-primary ml-md-3 ml-0">Confirm</button>
                <button class="btn btn-outline-primary mt-3 mt-md-0">Back</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                foodName: 'Rice',
                qty: null,
                total: 5
            }
        },
        methods: {
            fetchOrder: function () {
                alert('Fetch order from user ordered.');
            },
            onCount: function (action) {
                if(action === 'plus') {
                    this.qty = this.qty + 1;
                } else {
                    if(this.qty > 0) {
                        this.qty = this.qty - 1;
                    }
                }
            }
        },
        created() {
            this.fetchOrder();
        }
    }
</script>

<style>

</style>
