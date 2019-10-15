const mutations = {
    SetToken(state,token) {
        localStorage.setItem("_token",token)
        state.token  = token;
    },
    RemoveToken(state) {
        localStorage.removeItem("_token")
        state.token  = null;
    },
    Error(state,message) {
        state.notification = message;
        setTimeout(() => {
            state.notification = null;            
        }, 7000);
    },
    NotificationClose(state) {
        state.notification = null;            
    },
}
export default mutations;