<template>
    <div class="container" id="OrderList">
        <div class="card mb-3 p-3">
            <div class="row">
                <div class="col-md-4">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6d/Good_Food_Display_-_NCI_Visuals_Online.jpg/1200px-Good_Food_Display_-_NCI_Visuals_Online.jpg" alt="" class="img-fluid">
                </div>
                <div class="col-md-4">
                    <div class="card-body pt-md-0">
                        <h5>{{food.foodName}}&nbsp;(<b class="text-danger">$1.25</b>)</h5>
                        <p>Qty:&nbsp;{{food.qty}}
                            <span class="d-block">Price:&nbsp;${{food.price}}</span>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary btn-block">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                food: {
                    foodName: 'Food A',
                    qty: 2,
                    price: 2.5
                }
            }
        }
    }
</script>
