<template>
    <div>
      <div class="status-bar align-items-center">
        <span @click="$router.push('/home')">Back</span>
        <h4 class="ml-4 mb-0">Order Food</h4>
      </div>
      <form>
        <div class="container mt-4" id="Ordering">
            <h3 class="text-center">You're ordering <b>{{foodName}}</b></h3>
            <div class="form-group">
                <label for="qty">Qty</label>
                <div class="input-group">
                    <input id="qty" type="number" v-model="qty" class="form-control" placeholder="Qty" aria-label="Qty" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="button" @click="onCount('minus') "><i class="fa fa-minus"></i></button>
                        <button class="btn btn-outline-primary" type="button" @click="onCount('plus')"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="qty">Payment method</label>
                <div class="input-group">
                    <select class="form-control">
                      <option value="1">Cash</option>
                      <option value="2">Transfer (ABA)</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <p class="total">Total:&nbsp;<b>${{total}}</b></p>
            </div>
        </div>
        <div class="sticky-footer">
          <button class="btn btn-primary btn-block">Create food</button>
        </div>
      </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                foodName: 'Rice',
                qty: 1,
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
                    if(this.qty > 1) {
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
