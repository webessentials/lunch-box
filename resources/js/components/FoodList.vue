<template>
  <div>
    <div class="nav-sticky navbar navbar-expand navbar-light bg-white">
        <span class="btn-link" @click="$router.push('/dashboard')">
          <svg class="bi bi-chevron-left" width="24" height="24" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M13.354 3.646a.5.5 0 010 .708L7.707 10l5.647 5.646a.5.5 0 01-.708.708l-6-6a.5.5 0 010-.708l6-6a.5.5 0 01.708 0z" clip-rule="evenodd"></path>
            </svg>
        </span>
      <h4 class="ml-1 mb-0">Food List</h4>
        <ul class="navbar-nav mt-2 mt-md-0 ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="javascript:;" @click="$router.push('/')">
                    <svg class="bi bi-house" width="24" height="24" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M9.646 3.146a.5.5 0 01.708 0l6 6a.5.5 0 01.146.354v7a.5.5 0 01-.5.5h-4.5a.5.5 0 01-.5-.5v-4H9v4a.5.5 0 01-.5.5H4a.5.5 0 01-.5-.5v-7a.5.5 0 01.146-.354l6-6zM4.5 9.707V16H8v-4a.5.5 0 01.5-.5h3a.5.5 0 01.5.5v4h3.5V9.707l-5.5-5.5-5.5 5.5z" clip-rule="evenodd"></path>
                        <path fill-rule="evenodd" d="M15 4.5V8l-2-2V4.5a.5.5 0 01.5-.5h1a.5.5 0 01.5.5z" clip-rule="evenodd"></path>
                    </svg>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="javascript:;" @click="logout">
                    <svg class="bi bi-box-arrow-right" width="24" height="24" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M13.646 13.354a.5.5 0 010-.708L16.293 10l-2.647-2.646a.5.5 0 01.708-.708l3 3a.5.5 0 010 .708l-3 3a.5.5 0 01-.708 0z" clip-rule="evenodd"></path>
                        <path fill-rule="evenodd" d="M6.5 10a.5.5 0 01.5-.5h9a.5.5 0 010 1H7a.5.5 0 01-.5-.5z" clip-rule="evenodd"></path>
                        <path fill-rule="evenodd" d="M4 15.5A1.5 1.5 0 012.5 14V6A1.5 1.5 0 014 4.5h7A1.5 1.5 0 0112.5 6v1.5a.5.5 0 01-1 0V6a.5.5 0 00-.5-.5H4a.5.5 0 00-.5.5v8a.5.5 0 00.5.5h7a.5.5 0 00.5-.5v-1.5a.5.5 0 011 0V14a1.5 1.5 0 01-1.5 1.5H4z" clip-rule="evenodd"></path>
                    </svg>
                </a>
            </li>
        </ul>
    </div>
    <div class="container mt-4">
      <ul class="list-group">
        <li v-for="food in foodList" class="list-group-item d-flex justify-content-between align-items-center">
          {{ food.name }}
          <span class="badge badge-pill" :class="{'badge-success': isAdded(food.id), 'badge-info': !isAdded(food.id)}">${{ food.price }}</span>
          <button class="btn btn-outline-info" @click="addToMenu(food.id)" v-if="!isAdded(food.id)">
              <svg class="bi bi-eye-slash" width="24" height="24" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path d="M15.359 13.238C17.06 11.72 18 10 18 10s-3-5.5-8-5.5a7.028 7.028 0 00-2.79.588l.77.771A5.944 5.944 0 0110 5.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0116.828 10c-.058.087-.122.183-.195.288a13.14 13.14 0 01-1.465 1.755c-.165.165-.337.328-.517.486l.708.709z"></path>
                  <path d="M13.297 11.176a3.5 3.5 0 00-4.474-4.474l.823.823a2.5 2.5 0 012.829 2.829l.822.822zm-2.943 1.299l.822.822a3.5 3.5 0 01-4.474-4.474l.823.823a2.5 2.5 0 002.829 2.829z"></path>
                  <path d="M5.35 7.47c-.18.16-.353.322-.518.487A13.134 13.134 0 003.172 10l.195.288c.335.48.83 1.12 1.465 1.755C6.121 13.332 7.881 14.5 10 14.5c.716 0 1.39-.133 2.02-.36l.77.772A7.027 7.027 0 0110 15.5c-5 0-8-5.5-8-5.5s.939-1.721 2.641-3.238l.708.709z"></path>
                  <path fill-rule="evenodd" d="M15.646 16.354l-12-12 .708-.708 12 12-.708.707z" clip-rule="evenodd"></path>
              </svg>
          </button>
          <button class="btn btn-outline-success" @click="removeFromMenu(food.id)" v-else>
              <svg class="bi bi-eye" width="24" height="24" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M18 10s-3-5.5-8-5.5S2 10 2 10s3 5.5 8 5.5 8-5.5 8-5.5zM3.173 10a13.133 13.133 0 001.66 2.043C6.12 13.332 7.88 14.5 10 14.5c2.12 0 3.879-1.168 5.168-2.457A13.133 13.133 0 0016.828 10a13.133 13.133 0 00-1.66-2.043C13.879 6.668 12.119 5.5 10 5.5c-2.12 0-3.879 1.168-5.168 2.457A13.133 13.133 0 003.172 10z" clip-rule="evenodd"></path>
                  <path fill-rule="evenodd" d="M10 7.5a2.5 2.5 0 100 5 2.5 2.5 0 000-5zM6.5 10a3.5 3.5 0 117 0 3.5 3.5 0 01-7 0z" clip-rule="evenodd"></path>
              </svg>
          </button>
        </li>
      </ul>
    </div>
    <div class="sticky-footer">
      <button class="btn btn-primary btn-block" @click="$router.push('/addfood')">Create food</button>
    </div>
  </div>
</template>

<script>
    import Logout from '../mixins/logout.vue';
  export default {
    data() {
      return {
        foodList: [],
        todayMenu: []
      }
    },
      mixins: [Logout],
    mounted() {
      this.fetchFoods()
      this.fetchTodayMenu()
    },
    methods: {
      fetchFoods() {
        axios.get('/api/foods')
        .then(response => {
          this.foodList = response.data
        })
      },
      fetchTodayMenu() {
        this.todayMenu = []
        axios.get('/api/schedule/today')
        .then(response => {
          if (response.data) {
            response.data.forEach(food => {
              this.todayMenu.push(food.food_id)
            })
          }
        })
      },
      addToMenu(id) {
        let date = new Date()
        let currentMonth = parseInt(date.getMonth()) + 1
        let currentDate = date.getFullYear() + '-' + currentMonth + '-' + date.getDate();
        axios.post('api/schedules', {
          date: currentDate,
          food_id: id
        }).then(response => {
          if (response.status === 201) {
              this.todayMenu.push(id)
          }
        })
      },
      removeFromMenu(id) {
          const instance = this;
          let date = new Date()
          let currentMonth = parseInt(date.getMonth()) + 1
          let currentDate = date.getFullYear() + '-' + currentMonth + '-' + date.getDate();
          axios.post('/api/delete/schedules', {
              food_id: id,
              date: currentDate
          }).then(response => {
              let index = instance.todayMenu.indexOf(id);
              if (index !== -1) instance.todayMenu.splice(index, 1);
          })
      },
        isAdded: function(id) {
            return !!this.todayMenu.find(f => parseInt(f) === parseInt(id))
        }
    }
  }
</script>
