<template>
    <div class="container">
        <form>
            <div class="form-group">
                <label for="image">Choose your food's image</label>
                <input type="file" class="form-control-file" id="image" @change="getFile($event)">
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" v-model="name"/>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" step="0.01" class="form-control" id="price" v-model="price"/>
            </div>
            <button class="btn btn-primary btn-block" @click="onAddFood">Add Food</button>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                file: null,
                name: '',
                price: 0
            }
        },
        methods: {
            getFile: function (event) {
                this.file = event.target.files[0];
                console.log(this.file);
            },
            onAddFood: function () {
                console.log(this.name + this.price);
                console.log(this.file);
            }
        }
    }
</script>
