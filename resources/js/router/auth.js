import Login from '../views/Login'
import Register from '../views/Register'
import ForgotPassword from '../views/ForgotPassword'

const meta = {
    auth:false,
    guest:true,
}

const auth = [
    {
        path:'/login',
        component:Login,
        meta:meta
    },
    {
        path:'/join',
        component:Register,
        meta:meta
    },
    {
        path:'/forgot-password',
        component:ForgotPassword,
        meta:meta
    },
];
export default auth;