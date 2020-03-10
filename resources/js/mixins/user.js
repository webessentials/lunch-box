const User = {
    methods: {
        isAdmin() {
            return localStorage.getItem('is_admin')  === 'true';
        }
    }
};

export default User;
