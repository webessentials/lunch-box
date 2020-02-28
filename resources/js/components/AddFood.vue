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
    import axios from 'axios';

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
            },
            onAddFood: function () {
                let formData = new FormData();
                formData.append('name', this.name);
                formData.append('price', this.price);
                formData.append('picture', this.file);
                axios({
                    url: 'api/foods',
                    method: 'post',
                    data: formData,
                    headers: {
                        'content-type':'multipart/form-data'
                    }
                }).then(res => {
                    console.log(res);
                }).catch(err => console.log(err));
            }
        }
    }
</script>
