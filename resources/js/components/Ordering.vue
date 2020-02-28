<template>
    <div>
      <div class="status-bar align-items-center">
        <span @click="$router.push('/home')">Back</span>
        <h4 class="ml-4 mb-0">Order Food</h4>
      </div>
      <form>
        <div class="container mt-4" id="Ordering">
            <h3 class="text-center">You're ordering <b>{{food.name}}</b></h3>
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
                    <select class="form-control" v-model="payment">
                      <option value="1">Cash</option>
                      <option value="2">Transfer (ABA)</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <h3 class="total">Total:&nbsp;<b>${{total}}</b></h3>
            </div>
        </div>
        <div class="sticky-footer">
          <button class="btn btn-primary btn-block" @click="onConfirm">Confirm</button>
        </div>
      </form>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                food: {},
                qty: 1,
                note: 'abc',
                pack_quantity: 0,
                payment: 0
            }
        },
        computed: {
          total() {
              return this.food.price * this.qty;
          }
        },
        methods: {
            onConfirm: function() {
                axios.post('api/orders', {
                    amount: this.total,
                    unit_price: this.food.price,
                    note: this.note,
                    payment_type: this.payment,
                    food_id: this.food.id,
                    pack_quantity: this.pack_quantity,
                    quantity: this.qty
                }).then(res => {
                    console.log(res);
                    if(res === 201) {
                        this.$router.push('/home');
                    }
                }).catch(err => console.log(err));
            },
            fetchOrder: function () {
                axios.get(`api/foods/${this.$route.params.id}`)
                .then(res => {
                    this.food = res.data;
                })
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
