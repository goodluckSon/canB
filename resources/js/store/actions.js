import Axios from 'axios'

const instance = Axios.create({
    baseURL:"/api",
    headers:{
        "Accept":"application/json"
    }
})

const actions = {
    async Login(context,user){
        return new Promise(async (resolve,reject) =>{
            await Axios.post('oauth/token',{
                grant_type:"password",
                client_id:context.state.api.key,
                client_secret:context.state.api.secret,
                username:user.email,
                password:user.password,
                scope:"*",
            })
            .then(res=>{
                context.commit('SetToken',res.data.access_token);
                resolve(res);
            })
            .catch(error=>{
                reject(error);
            })
        })
    },
    Register(context,user){
        return new Promise(async (resolve,reject) =>{
            await instance.post('register',user)
            .then(res=>{
                resolve(res);
            })
            .catch(error=>{
                reject(error);
            })
        })
    },
    GetUser(context){
        instance.defaults.headers.Authorization = `Bearer ${context.state.token}`;
        return new Promise(async (resolve,reject) =>{
            await instance.get('user')
            .then(res=>{
                resolve(res);
            })
            .catch(error=>{
                reject(error);
            })
        })
    },
    UpdateUser(context,user){
        instance.defaults.headers.Authorization = `Bearer ${context.state.token}`;
        return new Promise(async (resolve,reject) =>{
            await instance.put('user',user)
            .then(res=>{
                resolve(res);
            })
            .catch(error=>{
                reject(error);
            })
        })
    },
    GetLocations(context){
        instance.defaults.headers.Authorization = `Bearer ${context.state.token}`;
        return new Promise(async (resolve,reject) =>{
            await instance.get('locations')
            .then(res=>{
                resolve(res);
            })
            .catch(error=>{
                reject(error);
            })
        })
    },
    AddLocation(context,data){
        instance.defaults.headers.Authorization = `Bearer ${context.state.token}`;
        return new Promise(async (resolve,reject) =>{
            await instance.post('locations',data)
            .then(res=>{
                resolve(res);
            })
            .catch(error=>{
                reject(error);
            })
        })
    },
    GetLocation(context,id){
        instance.defaults.headers.Authorization = `Bearer ${context.state.token}`;
        return new Promise(async (resolve,reject) =>{
            await instance.get('/locations/'+id)
            .then(res=>{
                resolve(res);
            })
            .catch(error=>{
                reject(error);
            })
        })
    },

    UpdateLocation(context,data){
        instance.defaults.headers.Authorization = `Bearer ${context.state.token}`;
        return new Promise(async (resolve,reject) =>{
            await instance.put('/locations/'+data.id,data)
            .then(res=>{
                resolve(res);
            })
            .catch(error=>{
                reject(error);
            })
        })
    },
    Logout(context){
        instance.defaults.headers.Authorization = `Bearer ${context.state.token}`;
        return new Promise(async (resolve,reject) =>{
            await instance.delete('/logout')
            .then(res=>{
                context.commit('RemoveToken');
                resolve(res);
            })
            .catch(error=>{
                reject(error);
            })
        })
    },    
    Images(context){
        instance.defaults.headers.Authorization = `Bearer ${context.state.token}`;
        return new Promise(async (resolve,reject) =>{
            await instance.get('/images')
            .then(res=>{
                resolve(res);
            })
            .catch(error=>{
                reject(error);
            })
        })
    },    
    DeleteImage(context,id){
        instance.defaults.headers.Authorization = `Bearer ${context.state.token}`;
        return new Promise(async (resolve,reject) =>{
            await instance.delete('/images/'+id)
            .then(res=>{
                resolve(res);
            })
            .catch(error=>{
                reject(error);
            })
        })
    },
    MyFlakes(context){
        instance.defaults.headers.Authorization = `Bearer ${context.state.token}`;
        return new Promise(async (resolve,reject) =>{
            await instance.get('/flakes/')
            .then(res=>{
                resolve(res);
            })
            .catch(error=>{
                reject(error);
            })
        })
    },
    GetFlake(context,id){
        instance.defaults.headers.Authorization = `Bearer ${context.state.token}`;
        return new Promise(async (resolve,reject) =>{
            await instance.get('/flakes/'+id)
            .then(res=>{
                resolve(res);
            })
            .catch(error=>{
                reject(error);
            })
        })
    },
    NewFlake(context,data){
        instance.defaults.headers.Authorization = `Bearer ${context.state.token}`;
        return new Promise(async (resolve,reject) =>{
            await instance.post('/flakes',data)
            .then(res=>{
                resolve(res);
            })
            .catch(error=>{
                reject(error);
            })
        })
    },
    UpdateFlake(context,data){
        instance.defaults.headers.Authorization = `Bearer ${context.state.token}`;
        return new Promise(async (resolve,reject) =>{
            await instance.put('/flakes/'+data.id,data)
            .then(res=>{
                resolve(res);
            })
            .catch(error=>{
                reject(error);
            })
        })
    },
    DeleteFlake(context,id){
        instance.defaults.headers.Authorization = `Bearer ${context.state.token}`;
        return new Promise(async (resolve,reject) =>{
            await instance.delete('/flakes/'+id)
            .then(res=>{
                resolve(res);
            })
            .catch(error=>{
                reject(error);
            })
        })
    },
    //Admin 
    GetIcons(context){
        // instance.defaults.headers.Authorization = `Bearer ${context.state.token}`;
        return new Promise(async (resolve,reject) =>{
            await instance.get('/administration/addons/?type=icon')
            .then(res=>{
                resolve(res);
            })
            .catch(error=>{
                reject(error);
            })
        })
    },
    GetFrames(context){
        // instance.defaults.headers.Authorization = `Bearer ${context.state.token}`;
        return new Promise(async (resolve,reject) =>{
            await instance.get('/administration/addons/?type=frame')
            .then(res=>{
                resolve(res);
            })
            .catch(error=>{
                reject(error);
            })
        })
    },
    SaveAddon(context,data){
        // instance.defaults.headers.Authorization = `Bearer ${context.state.token}`;
        instance.defaults.headers['Content-Type'] = `multipart/form-data`;
        return new Promise(async (resolve,reject) =>{
            await instance.post('/administration/addons',data)
            .then(res=>{
                resolve(res);
            })
            .catch(error=>{
                reject(error);
            })
        })
    },
    DeleteIcon(context,id){
        // instance.defaults.headers.Authorization = `Bearer ${context.state.token}`;
        // instance.defaults.headers['Content-Type'] = `multipart/form-data`;
        return new Promise(async (resolve,reject) =>{
            await instance.delete('/administration/addons/'+id)
            .then(res=>{
                resolve(res);
            })
            .catch(error=>{
                reject(error);
            })
        })
    },
    //Get Designs 
    GetDesigns(context){
        // instance.defaults.headers.Authorization = `Bearer ${context.state.token}`;
        return new Promise(async (resolve,reject) =>{
            await instance.get('/administration/designs/')
            .then(res=>{
                resolve(res);
            })
            .catch(error=>{
                reject(error);
            })
        })
    },
    SaveDesign(context,data){
        // instance.defaults.headers.Authorization = `Bearer ${context.state.token}`;
        instance.defaults.headers['Content-Type'] = `multipart/form-data`;
        return new Promise(async (resolve,reject) =>{
            await instance.post('/administration/designs',data)
            .then(res=>{
                resolve(res);
            })
            .catch(error=>{
                reject(error);
            })
        })
    },
    DeleteDesign(context,id){
        // instance.defaults.headers.Authorization = `Bearer ${context.state.token}`;
        // instance.defaults.headers['Content-Type'] = `multipart/form-data`;
        return new Promise(async (resolve,reject) =>{
            await instance.delete('/administration/designs/'+id)
            .then(res=>{
                resolve(res);
            })
            .catch(error=>{
                reject(error);
            })
        })
    },    
}
export default actions;