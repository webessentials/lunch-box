const Logout = {
    methods: {
        checkToken() {
            return !!localStorage.getItem('user_token');
        },
        logout() {
            if (this.checkToken()) {
                axios.post('/api/logout')
                .then(res => {
                    localStorage.removeItem('user_token');
                    localStorage.removeItem('is_admin');
                    this.$router.push('/login')
                })
                .catch(err => console.log(err));
            }
        }
    }
};

export default Logout;
