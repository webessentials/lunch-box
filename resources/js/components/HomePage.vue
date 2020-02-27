<template>
    <div class="container mt-3">
        <div class="d-flex flex-row-reverse mb-3">
            <button class="btn btn-primary" @click="onLogin">Login</button>
        </div>
        <div class="card mb-3 p-3" v-for="food in foods">
            <div class="row">
                <div class="col-md-4">
                    <img class="img-fluid" src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6d/Good_Food_Display_-_NCI_Visuals_Online.jpg/1200px-Good_Food_Display_-_NCI_Visuals_Online.jpg" alt="Img">
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <h5>{{food.userName}}</h5>
                        <p>{{food.food}}
                            <span class="d-block"><b>${{food.price}}</b></span>
                        </p>
                    </div>
                </div>
                <div class="col-md-2 align-items-center">
                    <button class="btn btn-outline-primary w-100" @click="onOrder">Order</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                foods: [{
                    userName: 'User1',
                    food: 'A',
                    price: 2
                },
                {
                    userName: 'User2',
                    food: 'B',
                    price: 3.5
                }]
            }
        },
        methods: {
            onOrder: function () {
                alert('Order form pop up');
            },
            onLogin: function () {
                alert('Navigate to login');
            }
        }
    }
</script>
