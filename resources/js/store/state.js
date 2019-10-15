const state = {
    app:{},
    api:{
        endpoint:"/",
        key:2,
        secret:"PEJOFffsVDE0ngfznEMGm7lRU832hm4WksqYWz8W",
    },
    notification:null,
    token:localStorage.getItem('_token')||null,
}
export default state;