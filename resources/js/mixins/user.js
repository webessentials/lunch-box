const User = {
    methods: {
        isAdmin() {
            return localStorage.getItem('is_admin')
        }
    }
};

export default User;
