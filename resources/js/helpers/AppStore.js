class AppStore{

    storeToken(token){
        localStorage.setItem('token', token);
    }

    storeUserId(userid){
        localStorage.setItem('userid', userid);
    }

    storeAuthUser(token, userid){
        this.storeToken(token);
        this.storeUserId(userid);
    }

    clearAuthUser(){
        localStorage.removeItem('token');
        localStorage.removeItem('userid');
    }

    getToken(){
        localStorage.getItem('token');
    }
    getUserId(){
        localStorage.getItem('userid');
    }

    // Authenticate(){
    //     if (sessionStorage.getItem('token') !== null && sessionStorage.getItem('userid') !== null){
    //         return true;
    //     }
    // }


}
export default AppStore = new AppStore()