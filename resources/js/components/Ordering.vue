<template>
    <div>
        <div class="nav-sticky navbar navbar-expand navbar-light bg-white">
            <span class="btn-link" @click="$router.push('/')">
                <svg class="bi bi-chevron-left" width="24" height="24" viewBox="0 0 20 20" fill="currentColor"
                     xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M13.354 3.646a.5.5 0 010 .708L7.707 10l5.647 5.646a.5.5 0 01-.708.708l-6-6a.5.5 0 010-.708l6-6a.5.5 0 01.708 0z"
                          clip-rule="evenodd"></path>
                </svg>
            </span>
            <h4 class="ml-2 py-2 mb-0">Order Food</h4>
        </div>
        <div class="container mt-4">
            <div v-if="successOrder" class="card p-4 text-center">
                <h2>Success Order</h2>
                <p>Thank for your ordering. Our Chef is working for you food soon.</p>
            </div>
            <form v-else class="card p-3">
                <div id="Ordering">
                    <img class="img-fluid" :src="food.picture" :alt="food.name">
                    <h3 class="mt-3">{{food.name}}</h3>
                    <div class="form-group">
                        <label for="qty">Quantity</label>
                        <div class="input-group">
                            <input id="qty" type="number" v-model="qty" class="form-control" placeholder="Qty"
                                   aria-label="Qty" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary" type="button" @click="onCount('minus') "><i
                                    class="fa fa-minus"></i></button>
                                <button class="btn btn-outline-primary" type="button" @click="onCount('plus')"><i
                                    class="fa fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="qty">Payment method</label>
                        <div class="input-group">
                            <select class="form-control" v-model="payment">
                                <option value="1">Cash</option>
                                <!-- <option value="2">Transfer (ABA)</option>-->
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <h3 class="total">Total:&nbsp;<b>${{total}}</b></h3>
                    </div>
                </div>
            </form>
        </div>
        <div class="sticky-footer" v-if="successOrder === false">
            <button class="btn btn-primary btn-block" @click.prevent="onConfirm">Confirm</button>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                food: {},
                qty: 1,
                note: 'abc',
                pack_quantity: 0,
                payment: 1,
                successOrder: false,
            };
        },
        computed: {
            total() {
                return this.food.price * this.qty;
            },
        },
        methods: {
            onConfirm: function() {
                const instance = this;
                axios.post('/api/orders', {
                    amount: this.total,
                    unit_price: this.food.price,
                    note: this.note,
                    payment_type: this.payment,
                    food_id: this.food.id,
                    pack_quantity: this.pack_quantity,
                    quantity: this.qty,
                }).then(res => {
                    if (res.status === 201) {
                        instance.successOrder = true;
                    }
                }).catch(err => console.log(err));
            },
            fetchOrder: function() {
                axios.get(`/api/foods/${this.$route.params.id}`).then(res => {
                    this.food = res.data;
                });
            },
            onCount: function(action) {
                if (action === 'plus') {
                    this.qty = this.qty + 1;
                } else {
                    if (this.qty > 1) {
                        this.qty = this.qty - 1;
                    }
                }
            },
        },
        created() {
            this.fetchOrder();
        },
    };
</script>

<style>

</style>
