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
          <span class="badge badge-danger badge-pill">${{ food.price }}</span>
          <button class="btn btn-primary" @click="addToMenu(food.id)" v-if="!checkIfInTodayList(food.id)">Add to today menu</button>
          <button class="btn btn-danger" @click="removeFromMenu(food.id)" v-else>Remove from menu</button>
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
          this.foodList = response.data.data
        })
      },
      fetchTodayMenu() {
        this.todayMenu = []
        axios.get('/api/schedule/today')
        .then(response => {
          if (response.data.data.length) {
            response.data.data.forEach(food => {
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
            console.log('OK');
          }
        })
      },
      removeFromMenu(id) {
        console.log('Remove from menu')
      },
      checkIfInTodayList(id) {
        return this.todayMenu.includes(id)
      }
    }
  }
</script>
