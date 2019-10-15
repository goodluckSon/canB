const getters = {
    isLoggedIn : state=>{
        return state.token?true:false;
    }
}
export default getters;