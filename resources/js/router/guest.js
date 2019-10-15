import Home from '../views/Home'
import AdminLogin from '../views/Admin/Login'
import Create from '../views/Create'
import Templates from '../views/Templates'
import StepOne from '../views/StepOne'
import FNF from '../views/FNF'

const meta = {
    auth:false,
    guest:false,
}

const guest = [
    {
        path:'/',
        name:"Home",
        component:Home,
        meta:meta
    },
    {
        path:'/admin/login',
        name:"AdminLogin",
        component:AdminLogin,
        meta:meta
    },    
    {
        path:'/create',
        name:"Step One",
        component:StepOne,
        meta:meta
    },
    {
        path:'/create/:model/:size',
        name:"Create",
        component:Create,
        meta:meta
    },
    {
        path:'/templates/:model/:size',
        name:"Template",
        component:Templates,
        meta:meta
    },
    {
        path:'*',
        name:"404",
        component:FNF,
        meta:meta
    },
];
export default guest;